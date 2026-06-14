import sys
import requests
import os
from tinytag import TinyTag
import json

def get_audio_info(url):
    temp_filename = "temp_meta.mp3"
    try:
        # 1. Lấy dung lượng file qua Header trước (Không tốn tài nguyên)
        response_header = requests.head(url, allow_redirects=True)
        file_size = response_header.headers.get('content-length', 0)

        # 2. Tải TOÀN BỘ file MP3 về để đảm bảo tính toán chính xác thời lượng VBR
        # Loại bỏ cấu hình Range bytes cũ
        response_file = requests.get(url, timeout=30) 
        
        # 3. Ghi vào file tạm vật lý
        with open(temp_filename, "wb") as f:
            f.write(response_file.content)
        
        # 4. TinyTag phân tích toàn bộ file để trả về số giây chính xác
        tag = TinyTag.get(temp_filename)
        duration = tag.duration # Sẽ ra chuẩn ~840 giây cho file 14 phút của bạn

        # 5. Xóa file tạm để giải phóng ổ cứng
        if os.path.exists(temp_filename):
            os.remove(temp_filename)

        return {
            "success": True,
            "size": int(file_size),
            "duration": int(duration)
        }
    except Exception as e:
        if os.path.exists(temp_filename):
            os.remove(temp_filename)
        return {
            "success": False,
            "error": str(e)
        }

if __name__ == "__main__":
    if len(sys.argv) > 1:
        audio_url = sys.argv[1]
        result = get_audio_info(audio_url)
        print(json.dumps(result))
    else:
        print(json.dumps({"success": False, "error": "No URL provided"}))