$('.delete__action').click(function (e) { 
    e.preventDefault();
    const action = e.target.href;
    const nameUser = $(e.target).attr('data-name');
    const isConfirm = confirm('Bạn có muốn xóa "' + nameUser + '" không');
    if (isConfirm) {
       $('.delete__form').attr('action', action);
       $('form.delete__form').submit();
   }
});

function ChangeToSlug(selectorname, selectorSlug)
{
    var title, slug;
    const inputName = document.querySelector(selectorname);
    const inputSlug = document.querySelector(selectorSlug);
    inputName.addEventListener('change', (e) => {
        //Lấy text từ thẻ input title 
        title = e.target.value;
     
        //Đổi chữ hoa thành chữ thường
        slug = title.toLowerCase();
     
        //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        //Xóa các ký tự đặt biệt
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        //Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, "-");
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        //In slug ra textbox có id “slug”
        inputSlug.value = slug;

    })
}

function lfm(id, type, options) {
    let button = document.getElementById(id);
  
    button.addEventListener('click', function () {
      var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
      var target_input = document.getElementById(button.getAttribute('data-input'));
      var target_preview = document.getElementById(button.getAttribute('data-preview'));
  
      window.open(route_prefix + '?type=' + type || 'file', 'FileManager', 'width=900,height=600');
      window.SetUrl = function (items) {
        var file_path = items.map(function (item) {
          return item.url;
        }).join(',');
  
        // set the value of the desired input to image url
        target_input.value = file_path;
        target_input.dispatchEvent(new Event('change'));
  
        // clear previous preview
        target_preview.innerHTML = '';
  
        // set or change the preview image src
        items.forEach(function (item) {
          let img = document.createElement('img')
          img.setAttribute('style', 'height: auto')
          img.setAttribute('src', item.thumb_url)
          // img.classList.add('col-2');
          target_preview.appendChild(img);
        });
  
        // trigger change event
        target_preview.dispatchEvent(new Event('change'));
      };
    });
  };

  /**
   * Hiển thị các hình ảnh có sẵn
   */
  function showBoxImage(boxImageSelector, nameInput) {
    let boxImage = document.querySelector(boxImageSelector);
    let dataImageArr = null;
    if (boxImage.getAttribute('data-image')) {
      dataImageArr = JSON.parse(boxImage.getAttribute('data-image'));
    }
    if (dataImageArr) {
      dataImageArr.forEach((value, index) => {
        formInputImage(boxImageSelector, nameInput, value, index);
      });
    }
    // Thêm btn add (Thêm ô input mới)
    let idAddBtn = 'add_input_image_' + (new Date()).getTime();
    let addHTML = `<button id="${idAddBtn}" type="button" title="Thêm ảnh" class="btn btn-success mt-2">
                    <i class="fas fa-plus"></i>
                </button>`;
    boxImage.insertAdjacentHTML('afterend', addHTML);
    addInputImage('#'+idAddBtn, boxImageSelector, nameInput);
  }

  /**
   * Chức năng thêm input mới
   */
function addInputImage(btnSelector, formInputSelector, nameInput) {
  const btn = document.querySelector(btnSelector);
  btn.addEventListener('click', () => {
    let time = (new Date()).getTime();
    formInputImage(formInputSelector, nameInput, '', time);
  });
}
/**
 * Form thẻ input thêm ảnh
 */
function formInputImage(formInputSelector, nameInput, value, index) {
  let thumbnail = 'thumbnail_' + index;
      let holder = 'holder_' + index;
      let lfmUnique = 'lfm_' + index;
      let remove = 'remove_input_image_' + index;

      let inputHTML = `<div class="row mt-2">
                            <div class="col-5">
                              <input id="${thumbnail}" type="text" name="${nameInput}[]" class="form-control" placeholder="Hình ảnh liên quan..." value="${value}" />
                          </div>
                          <div class="col-2">
                              <button id="${lfmUnique}"  data-input="${thumbnail}" data-preview="${holder}" type="button" class="btn btn-primary">Chọn Ảnh</button>
                          </div>
                          <div class="col-1">
                              <button id="${remove}" type="button" class="btn btn-danger">
                                  <i class="fas fa-times"></i>
                              </button>
                          </div>
                          <div id="${holder}" class="col-4 custom__thumbnail">`;
            if (value) {
              inputHTML += `<img style="height: auto" src="${value}">`
            }
          inputHTML +=  `</div></div>`;

      let formInput = document.querySelector(formInputSelector);
      formInput.insertAdjacentHTML('beforeend', inputHTML);
      lfm(lfmUnique, 'image', {});
      removeInputImage('#'+remove, 'row');
}

  /**
   * Xóa thẻ input
   */
  function removeInputImage(btnSelector, classHtmlRemove) {
    const btn = document.querySelector(btnSelector);
    btn.addEventListener('click', () => {
      let elementRemove = findParent(btn, classHtmlRemove);
      elementRemove.remove();
    })
  }

  /**
   * Timf element cha theo class
   */
  function findParent(child, parentClass) {
    let parent = child.parentElement;
    while (parent) {
        if (parent.classList.contains(parentClass)) 
        {
            break;
        }
        parent = parent.parentElement;
    }
    return parent;
}