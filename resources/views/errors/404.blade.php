    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Trang web không tồn tại</title>
        <style>
            :root {
                /* Màu nền tối rất sâu */
                --bg-color: #0a0a0a;
                /* Màu chữ sáng (trắng hơi xám) */
                --text-color: #e0e0e0;
                /* Màu chữ tối hơn cho mô tả */
                --text-muted: #a0a0a0;
                /* Màu xanh dương nổi bật (Accent color) lấy từ các nút/link của trang gốc */
                --accent-color: #3498db;
                /* Font chữ hiện đại, không chân */
                --main-font: 'Roboto', -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif;
            }

            /* --- THIẾT LẬP CHUNG --- */
            body {
                margin: 0;
                padding: 0;
                font-family: var(--main-font);
                background-color: var(--bg-color);
                color: var(--text-color);
                /* Căn giữa nội dung theo cả chiều dọc và ngang */
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                text-align: center;
                overflow: hidden;
                /* Ngăn thanh cuộn nếu hiệu ứng bị tràn */
            }

            /* Khối chứa nội dung chính */
            .error-container {
                padding: 2rem;
                max-width: 600px;
            }

            /* --- HIỆU ỨNG SỐ 404 --- */
            /* Tạo hiệu ứng nhịp đập phát sáng neon */
            @keyframes neonPulse {
                0% {
                    text-shadow: 0 0 10px rgba(52, 152, 219, 0.4);
                }

                50% {
                    text-shadow: 0 0 30px rgba(52, 152, 219, 0.8), 0 0 50px rgba(52, 152, 219, 0.2);
                }

                100% {
                    text-shadow: 0 0 10px rgba(52, 152, 219, 0.4);
                }
            }

            .error-code {
                font-size: 180px;
                font-weight: 900;
                /* Chữ cực đậm */
                margin: 0;
                color: var(--accent-color);
                letter-spacing: -5px;
                /* Áp dụng hiệu ứng animation đã định nghĩa ở trên */
                animation: neonPulse 3s infinite alternate ease-in-out;
            }

            /* --- TIÊU ĐỀ VÀ MÔ TẢ --- */
            .error-title {
                font-size: 2rem;
                margin-top: 1rem;
                margin-bottom: 1rem;
                text-transform: uppercase;
                letter-spacing: 1px;
            }

            .error-description {
                font-size: 1.1rem;
                color: var(--text-muted);
                margin-bottom: 2.5rem;
                line-height: 1.6;
            }

            /* --- NÚT BẤM --- */
            .btn-home {
                display: inline-block;
                padding: 15px 35px;
                background-color: var(--accent-color);
                color: #ffffff;
                text-decoration: none;
                font-weight: bold;
                border-radius: 4px;
                /* Bo góc nhẹ giống các nút trên trang gốc */
                text-transform: uppercase;
                letter-spacing: 1px;
                transition: all 0.3s ease;
                /* Hiệu ứng mượt mà khi di chuột */
                box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
            }

            /* Hiệu ứng khi di chuột vào nút */
            .btn-home:hover {
                background-color: #2980b9;
                /* Màu xanh tối hơn một chút */
                transform: translateY(-3px);
                /* Nút nổi lên nhẹ */
                box-shadow: 0 6px 20px rgba(52, 152, 219, 0.5);
            }

            /* --- RESPONSIVE (Thiết bị di động) --- */
            @media (max-width: 768px) {
                .error-code {
                    font-size: 120px;
                    /* Giảm kích thước số trên màn hình nhỏ */
                }

                .error-title {
                    font-size: 1.5rem;
                }

                .error-description {
                    font-size: 1rem;
                    padding: 0 20px;
                }
            }
        </style>
    </head>

    <body>
        <div class="error-container">
            <h1 class="error-code">404</h1>

            <h2 class="error-title">Opps! Lạc đường rồi.</h2>

            <p class="error-description">
                Trang bạn đang tìm kiếm có vẻ như không tồn tại trong vũ trụ này.
                Có thể nó đã bị xóa hoặc đường dẫn bị sai.
            </p>

            <a href="{{ route('index') }}" class="btn-home">Quay lại Trang Chủ</a>
        </div>
    </body>

    </html>
