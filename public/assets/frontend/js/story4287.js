var STORY = (function () {
    var initViewFullContent = function () {
        $(document).on("click", ".story-description .view-full", function (e) {
            var parentItem = $(this).closest(".story-description");
            parentItem.toggleClass("active");
            if (parentItem.hasClass("active")) {
                $(this).html(`<span>Thu gọn</span>
                <i class="fa-solid fa-angles-up ms-1"></i>`);
            } else {
                $(this).html(`<span>Xem đầy đủ</span>
                <i class="fa-solid fa-angles-down ms-1"></i>`);
            }
        });
    };
    var initAddStoryFavorite = function () {
        $(document).on("click", ".btn-favorite-story", function () {
            var _this = $(this);
            if (_this.hasClass("not-login")) {
                NOTIFICATION.showNotify(
                    100,
                    "Vui lòng đăng nhập để thêm truyện vào tủ truyện!"
                );
                return;
            }
            $.ajax({
                url: _this.data("action"),
                data: { item: _this.data("item") },
                method: "GET",
                dataType: "json",
            }).done(function (data) {
                NOTIFICATION.toastrMessage(data);
                if (data.text) {
                    _this.find(".save-story-text").html(data.text);
                }
            });
        });
    };
    var initListRating = function () {
        if ($("#list-rating-story").length > 0) {
            var targetLoadBox = $("#list-rating-story");
            if (targetLoadBox.hasClass("inited")) {
                return;
            }
            targetLoadBox.addClass("inited");
            $.ajax({
                url: targetLoadBox.data("action"),
                method: "get",
                global: false,
            }).done(function (data) {
                targetLoadBox.html(data);
                var infiniteLoad = new infiniteLoadBox(targetLoadBox);
            });
        }
    };
    var unlockAllChapter = function () {
        var confimOpenFullbox = null;
        $(document).on("click", ".btn-unlock-all-chapter", function (event) {
            event.preventDefault();
            var currentButton = $(this);
            if (confimOpenFullbox) {
                confimOpenFullbox.close();
            }
            confimOpenFullbox = $.confirm({
                closeIcon: true,
                columnClass: "open-full-combo-box",
                typeAnimated: true,
                title: `<p class="title-open-full-combo">Mở Khóa Combo Giá Ưu Đãi</p>`,
                content: `<div class="in-loading text-center">
                    <div class="loader-dot">
                        <div class="loader-item"></div>
                        <div class="loader-item"></div>
                        <div class="loader-item"></div>
                        <div class="loader-item"></div>
                    </div>
                </div>`,
                buttons: {
                    close: {
                        text: "Hủy",
                        btnClass: "btn-default",
                        action: function () {},
                    },
                },
                onContentReady: function () {
                    $.ajax({
                        url: "load-content-open-chapter",
                        type: "GET",
                        dataType: "html",
                        global: false,
                        data: { story: currentButton.data("item") },
                    }).done(function (data) {
                        confimOpenFullbox.$content.html(data);
                    });
                },
            });
        });
        $(document).on(
            "submit",
            ".show-form-unlock-chapter-combo",
            function (e) {
                e.preventDefault();
                var buttons = $(this).find('button[type="submit"]');
                if (buttons.length > 0) {
                    buttons.each(function (idx, elm) {
                        BASE_GUI.disableButton(elm);
                    });
                }
                $.ajax({
                    url: $(this).attr("action"),
                    type: "POST",
                    dataType: "html",
                    global: false,
                    data: $(this).serialize(),
                }).done(function (data) {
                    $(".show-form-unlock-chapter-combo-result").html(data);
                    FORM_VALIDATION.refresh();
                });
            }
        );
    };

    // ---------
    // nhymxu modify migrate part

    var _render_pagination = function (current_page, total_page) {
        current_page = parseInt(current_page);
        total_page = parseInt(total_page);

        let _html = '<div class="pagination">';

        if (current_page > 1) {
            const prev_page = current_page - 1;
            _html += `<a class="!px-4" data-page-num="${prev_page}" title="Trước">Trước</a>`;
        }

        // some previous page
        if (current_page - 6 > 0 ) {
            _html += `
            <a href="#" data-page-num="1">1</a></li>
            <a href="#" data-page-num="2">2</a></li>
            <a style="pointer-events: none"> ... </a>
            <a href="#" data-page-num="${current_page - 2}">${current_page - 2}</a></li>
            <a href="#" data-page-num="${current_page - 1}">${current_page - 1}</a></li>
            `;
        } else {
            for (let i = 1; i < current_page; i++) {
                _html += `<a href="#" data-page-num="${i}">${i}</a></li>`;
            }
        }

        _html += `<strong>${current_page}</strong>`;

        // some next page
        if (current_page + 6 < total_page) {
            _html += `
            <a href="#" data-page-num="${current_page + 1}">${current_page + 1}</a></li>
            <a href="#" data-page-num="${current_page + 2}">${current_page + 2}</a></li>
            <a style="pointer-events: none"> ... </a>
            <a href="#" data-page-num="${total_page - 1}">${total_page - 1}</a></li>
            <a href="#" data-page-num="${total_page}">${total_page}</a></li>
            `;
        } else {
            // show current page -> total page
            for (let i = current_page + 1; i <= total_page; i++) {
                _html += `<a href="#" data-page-num="${i}">${i}</a></li>`;
            }
        }

        if (current_page !== total_page) {
            const next_page = current_page + 1;
            _html += `<a class="next-page !px-4" data-page-num="${next_page}" title="Sau">Sau</a>`;
        }

        _html += `
            <div class="jump-box" data-current-page="${current_page}" data-last-page="${total_page}">
                <input type="text" placeholder="Số trang">
                <button type="button">Go</button>
            </div>`;

        _html += '</div>';

        return _html;
    }

    var _parseDate = function (str) {
        const [year, month, date, hours, minutes, seconds] = str
            .match(/(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})/)
            .slice(1)
            .map((n) => parseInt(n));

        return new Date(year, month - 1, date, hours, minutes, seconds);
    }

    var _get_relative_date = function (target_date) {
        // fix wrong UTC time
        target_date = target_date.replace("+0000 UTC", "GMT+0700");

        // fix parse ISO 8601 format on safari
        //const dateObject = new Date(target_date);
        const dateObject = _parseDate(target_date);

        // const timeMs = typeof date === "number" ? date : date.getTime();
        const secondsDiff = Math.round((dateObject - Date.now()) / 1000);

        const unitsInSec = [60, 3600, 86400, 86400 * 7, 86400 * 30, 86400 * 365, Infinity];

        const unitStrings = ["second", "minute", "hour", "day", "week", "month", "year"];

        const unitIndex = unitsInSec.findIndex((cutoff) => cutoff > Math.abs(secondsDiff));

        const divisor = unitIndex ? unitsInSec[unitIndex - 1] : 1;

        const rtf = new Intl.RelativeTimeFormat("vi", { numeric: "auto" });

        return rtf.format(Math.floor(secondsDiff / divisor), unitStrings[unitIndex]);
    }

    var _render_chapter_list_table = function (data) {
        var _html = '<table class="table-list__chapter w-full">';
        _html += `<thead>
            <tr class="text-white bg-[#212529]">
                <td class="font-bold p-3 text-center w-[10%]">STT</td>
                <td class="font-bold p-3">Tựa chương</td>
                <td class="font-bold p-3 text-center w-[25%]"><i class="fa-solid fa-clock"></i></td>
            </tr>
        </thead>`;
        _html += '<tbody>';

        data.forEach(function (r) {
            var _lock_icon = '';
            if (r.is_vip) {
                _lock_icon = '<i class="fa-solid fa-lock mr-1"></i> ';
            }

            let _relative_date = _get_relative_date(r.created_at);
            _html += `
                <tr class="border-t-[1px] border-solid border-[#dee2e6] hover:bg-[rgba(0,0,0,.09)]">
                    <td class="py-2 px-3 text-center w-[10%]">${r.ord}</td>
                    <td class="py-2 px-3">
                        <a href="${r.url}" title="${r.name}" class="text line-clamp-1 hover:text-[#252525]">
                            ${_lock_icon} ${r.name}
                        </a>
                    </td>
                    <td class="py-2 px-3 text-center w-[25%]">${_relative_date}</td>
                </tr>`;
        });

        _html += '</tbody></table>';

        return _html;
    }

    var _load_chapter_list = function(page_num) {
        var elm_result_box = $("#list-chapter-result");
        elm_result_box.html(`<div class="in-loading text-center">
            <div class="loader-dot">
                <div class="loader-item"></div>
                <div class="loader-item"></div>
                <div class="loader-item"></div>
                <div class="loader-item"></div>
            </div>
        </div>`);

        $.ajax({
            url: BACKEND_API + '/v1/chapter_list/' + _NX_STORY_ID,
            method: "get",
            global: false,
            data: {
                page: page_num ?? 1,
                new: $("#sort_new_chapter").is(":checked") ? 1 : 0,
            },
        }).done(function (resp) {
            if (!resp.success) {
                // TODO(78): handle error here
                alert('Fail to get chapter list');
            }
            let _html = _render_chapter_list_table(resp.data) + _render_pagination(page_num, resp.total_page)
            elm_result_box.html(_html);
            $('html, body').scrollTop(elm_result_box.offset().top);
        });
    }

    var nxInitChapterList = function (checkInit) {
        var listChapterResultBox = $("#list-chapter-result");
        if (listChapterResultBox.length == 0) return;
        if (checkInit) {
            if (listChapterResultBox.hasClass("inited")) {
                return;
            }
        }
        listChapterResultBox.addClass("inited");

        _load_chapter_list(1);
    };

    var _nxSupportChapterList = function () {
        $(document).on("click", "#list-chapter-result .pagination a",
            function (e) {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
                var _this = $(this);
                _load_chapter_list(_this.data('page-num'));
            }
        );

        $(document).on("click", ".jump-box button", function () {
            var jumpBox = $(this).closest(".jump-box");
            var inputPage = jumpBox.find("input");
            if (!inputPage) {
                return;
            }

            var pageJump = parseInt(inputPage.val());
            var lastPage = jumpBox.data("last-page");
            var currentPage = jumpBox.data('current-page');

            if (isNaN(pageJump) || pageJump <= 0 || pageJump > lastPage || pageJump == currentPage) {
                return;
            }

            _load_chapter_list(pageJump);
        });
    };

    return {
        _: function () {
            initViewFullContent();
            initAddStoryFavorite();
            unlockAllChapter();
            _nxSupportChapterList();
        },
        initListRating() {
            initListRating();
        },
        showChapterList(checkInit) {
            nxInitChapterList(checkInit);
        }
    };
})();
$(document).ready(function () {
    STORY._();
});
