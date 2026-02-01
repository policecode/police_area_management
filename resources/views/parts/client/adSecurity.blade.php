<script>
    // Đợi trang tải xong
    window.addEventListener('load', function() {
        let isOverIframe = false;

        // Kiểm tra xem chuột có đang nằm trên vùng quảng cáo không
        document.querySelectorAll('.adsbygoogle').forEach(function(el) {
            el.addEventListener('mouseover', function() { isOverIframe = true; });
            el.addEventListener('mouseout', function() { isOverIframe = false; });
        });

        // Lắng nghe sự kiện mất tiêu điểm của cửa sổ (xảy ra khi click vào iframe)
        window.addEventListener('blur', function() {
            if (isOverIframe) {
                // Gửi request về server Laravel
                fetch('{{ route("ads.log") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                });
                
                // Tùy chọn: Ẩn ngay quảng cáo trên giao diện sau khi click quá giới hạn
                // (Người dùng load lại trang sẽ mất hẳn nhờ logic ở Bước 4)
            }
        });
    });
</script>