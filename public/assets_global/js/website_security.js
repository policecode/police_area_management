$(document).keydown(function(e){
    // cấm hành vi nhấn F12
    if(e.which === 123){
        return false;
    }
    // cấm hành vi nhấn ctrl
    if(e.which === 17){
        return false;
    }
    // console.log(e.which);

});
$(document).bind("contextmenu",function(e) {
	e.preventDefault();
});
// $(document).bind("mousedown",function(e) {
// 	e.preventDefault();
// });
// window.onresize = function () {
//     // if ((window.outerHeight - window.innerHeight) > 100) {
//     //   alert('Docked inspector was opened');
//     // }
//     console.log(window.outerHeight, window.innerHeight);

// }

document.addEventListener('copy', function(event) {
    // Ngăn chặn hành vi sao chép mặc định của trình duyệt
    event.preventDefault();
    
    // Ghi đè dữ liệu vào clipboard
    event.clipboardData.setData('text/plain', 'Đọc thì đọc thôi, ai lại nỡ đi coppy công sức của dịch giả');
});

console.log(
    Object.defineProperties(new Error(), {
        toString: {
            value() {
                 if (new Error().stack && new Error().stack.includes("toString@")) {
                    alert("Safari devtools detected!");
                }
                return "[object Error]"; // Trả về giá trị mặc định để tránh lỗi
            },
        },
        message: {
            get() {
                if (typeof redirectToStory != 'undefined') {
                    window.location = redirectToStory;
                } else {
                    window.location = '/';
                }
                return "You've been redirected!"; // Trả về một thông báo
            },
        },
    })
);

// (function() {
//   function checkDevToolsLoop() {
//     // Luôn luôn tạo một điểm dừng
//     debugger;
//     // Chạy lại sau một khoảng thời gian nhỏ
//     setTimeout(checkDevToolsLoop, 100);
//   }
//   // Kích hoạt vòng lặp
//   checkDevToolsLoop();
// })();