import asyncio
import edge_tts
import sys
import os
import re

async def download_chunk(semaphore, text, voice, output_file):
    if not text or len(text.strip()) <= 1:
        return
    
    async with semaphore:
        # Thử tải lại tối đa 3 lần nếu gặp sự cố mạng đột xuất trước khi chấp nhận bỏ qua
        for attempt in range(3):
            try:
                communicate = edge_tts.Communicate(text, voice)
                await communicate.save(output_file)
                return  # Tải thành công thì thoát hàm luôn
            except Exception as e:
                if attempt == 2:  # Nếu đã thử đến lần thứ 3 vẫn thất bại
                    print(f"Warning: Thu lai 3 lan deu that bai o doan: [{text[:30]}...] - Loi: {e}")
                    with open(output_file, 'wb') as f:
                        pass
                else:
                    await asyncio.sleep(1)  # Đợi 1 giây rồi thử lại

async def main():
    text_file_path = sys.argv[1]
    final_output_file = sys.argv[2]
    voice = "vi-VN-NamMinhNeural"
    
    if not os.path.exists(text_file_path):
        print(f"Error: File text khong ton tai tai {text_file_path}")
        return
        
    with open(text_file_path, 'r', encoding='utf-8') as f:
        raw_text = f.read()

    output_dir = os.path.dirname(final_output_file)
    if not os.path.exists(output_dir):
        os.makedirs(output_dir, exist_ok=True)

    # 1. Làm sạch văn bản chuẩn văn học (Giữ lại các dấu câu cốt lõi)
    clean_text = raw_text.replace("!LF!", " ").replace("\n", " ").replace("\r", " ")
    clean_text = clean_text.replace("“", ' " ').replace("”", ' " ').replace('"', ' " ')
    clean_text = clean_text.replace("‘", " ' ").replace("’", " ' ")
    
    # Chuẩn hóa khoảng trắng thừa và rút gọn chuỗi dấu chấm dài (...... -> ...)
    clean_text = re.sub(r'\s+', ' ', clean_text)
    clean_text = re.sub(r'\.{2,}', '...', clean_text)
    
    # 2. Tách thành các câu nhỏ dựa trên các dấu ngắt câu thực tế (. ! ? ; hoặc dấu đóng ngoặc)
    raw_sentences = re.split(r'(?<=[.!?;\r\n])\s+', clean_text)
    
    # 3. THUẬT TOÁN GOM CÂU TÍCH LŨY (Tránh đứt gãy ngữ cảnh)
    chunks = []
    current_chunk = ""
    max_chars = 400  # Độ dài ký tự lý tưởng cho 1 request của Edge TTS

    for sentence in raw_sentences:
        sentence = sentence.strip()
        if not sentence:
            continue
            
        # Nếu cộng thêm câu mới vào mà vẫn chưa vượt quá giới hạn ký tự
        if len(current_chunk) + len(sentence) < max_chars:
            current_chunk += " " + sentence if current_chunk else sentence
        else:
            # Nếu vượt quá, đóng gói đoạn cũ lại và mở đoạn mới
            if current_chunk:
                chunks.append(current_chunk.strip())
            current_chunk = sentence

    # Thêm đoạn cuối cùng còn sót lại vào danh sách
    if current_chunk:
        chunks.append(current_chunk.strip())

    # Chốt chặn lọc bỏ các đoạn rác không chứa chữ cái nào
    chunks = [c for c in chunks if re.search(r'[\w\d]', c)]

    if not chunks:
        print("Error: Khong co noi dung hop le de doc")
        return

    temp_files = [f"{final_output_file}.part_{i}.mp3" for i in range(len(chunks))]
    tasks = []
    sem = asyncio.Semaphore(10)  # Cố định tối đa 10 tiến trình song song

    # 4. Tiến trình xử lý tải bất đồng bộ
    try:
        for i, chunk in enumerate(chunks):
            tasks.append(download_chunk(sem, chunk, voice, temp_files[i]))
        
        await asyncio.gather(*tasks)

        # 5. Gộp tất cả các file nhỏ thành file mp3 cuối cùng
        with open(final_output_file, 'wb') as outfile:
            for temp_file in temp_files:
                if os.path.exists(temp_file) and os.path.getsize(temp_file) > 0:
                    with open(temp_file, 'rb') as infile:
                        outfile.write(infile.read())

    except Exception as global_error:
        print(f"Loi nghiem trong: {global_error}")
        
    finally:
        # Dọn dẹp sạch sẽ toàn bộ file tạm
        for temp_file in temp_files:
            try:
                if os.path.exists(temp_file):
                    os.remove(temp_file)
            except Exception as e:
                print(f"Khong the xoa file tam {temp_file}: {e}")

if __name__ == "__main__":
    asyncio.run(main())