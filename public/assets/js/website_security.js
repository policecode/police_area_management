
// $(document).keydown(function(e){ 
//     // cấm hành vi nhấn F12
//     if(e.which === 123){ 
//         return false; 
//     } 
//     // cấm hành vi nhấn ctrl
//     if(e.which === 17){ 
//         return false; 
//     } 
//     console.log(e.which);
    
// }); 
// $(document).bind("contextmenu",function(e) { 
//     // Sự kiện nhấn chuột phải
// 	e.preventDefault(); 
// }); 
// $(document).bind("mousedown",function(e) { 
//     // Sự kiện nhấn chuột trái
// 	e.preventDefault(); 
// }); 
// window.onresize = function () {
//     // if ((window.outerHeight - window.innerHeight) > 100) {
//     //   alert('Docked inspector was opened');
//     // }
//     console.log(window.outerHeight, window.innerHeight);
    
// }

window.addEventListener('devtoolschange', function (e) {
    console.log('is DevTools open?', e.detail.open);
    console.log('and DevTools orientation?', e.detail.orientation);
});