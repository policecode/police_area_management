var CHAPTER_MANAGE = (function () {
    var baseSetting = {
        fontSize: 18,
        lineHeight: 24,
        fontFamily: "Roboto",
        background: "#ffffff",
        color: "#292e33",
        siteBgApply: false,
    };
    var ipFontSize = $("#fontsize");
    var ipLineHeight = $("#lineheight");
    var fontFamily = $("#fontfamily");
    var ipColor = $("#color");
    var ipBackround = $("#bg");
    var ipSiteBgApply = $("#site_bg_apply");

    var chapterContent = $("#chapter-content");

    var initThemeSetting = function () {
        $(document).on("input", ".setting-frontend input", function () {
            buildCurrentThemeInfo(false);
        });
        $(".setting-frontend select").change(function () {
            buildCurrentThemeInfo(false);
        });
    };
    var buildCurrentThemeInfo = function (isDefault) {
        var themeSetting = localStorage.getItem("themeSetting");
        if (isDefault) {
            if (themeSetting) {
                themeSetting = JSON.parse(themeSetting);
            } else {
                themeSetting = baseSetting;
            }
        } else {
            themeSetting = {};
            themeSetting.fontSize = ipFontSize.val();
            themeSetting.lineHeight = ipLineHeight.val();
            themeSetting.fontFamily = fontFamily.val();
            themeSetting.color = ipColor.val();
            themeSetting.background = ipBackround.val();
            themeSetting.siteBgApply = ipSiteBgApply.is(":checked");
        }
        applyTheme(themeSetting);
    };
    var applyTheme = function (themeSetting) {
        ipFontSize.parent().find(".preview-value").html(themeSetting.fontSize);
        ipLineHeight
            .parent()
            .find(".preview-value")
            .html(themeSetting.lineHeight);
        chapterContent.css("font-size", themeSetting.fontSize + "px");
        chapterContent.css("line-height", themeSetting.lineHeight + "px");
        chapterContent.css("font-family", themeSetting.fontFamily);
        chapterContent.css("color", themeSetting.color);
        chapterContent.css("background", themeSetting.background);
        ipFontSize.val(themeSetting.fontSize);
        ipLineHeight.val(themeSetting.lineHeight);
        fontFamily.val(themeSetting.fontFamily);
        ipColor.val(themeSetting.color);
        ipBackround.val(themeSetting.background);
        if (themeSetting.siteBgApply) {
            $("body").css("background", themeSetting.background);
            $(".chapter-page-apply").each(function () {
                $(this).css("color", themeSetting.color);
            });
            ipSiteBgApply.prop("checked", true);
        } else {
            $("body").css("background", "#ffffff");
            $(".chapter-page-apply").each(function () {
                $(this).css("color", "");
            });
            ipSiteBgApply.prop("checked", false);
        }
        localStorage.setItem("themeSetting", JSON.stringify(themeSetting));
        var date = new Date();
        date.setTime(date.getTime() + 30 * 24 * 60 * 60 * 1000);
        var expires = "expires=" + date.toUTCString();
        document.cookie = `themeSetting=${JSON.stringify(
            themeSetting
        )};expires=${expires};`;
    };
    var goToByScroll = function (id) {
        $("html,body").animate(
            {
                scrollTop: $("#" + id).offset().top,
            },
            "slow"
        );
    };
    var unlockChapter = function () {
        $(document).on("click", ".unlock-chapter-btn", function (event) {
            event.preventDefault();
            var _this = $(this);
            BASE_GUI.disableButton(_this[0]);
            $.ajax({
                url: "unlock-chapter",
                method: "post",
                data: { chapter: _this.data("chapter") },
                dataType: "json",
            }).done(function (data) {
                BASE_GUI.enableButton(_this[0]);
                if (data.code == 200) {
                    window.location.reload();
                } else {
                    NOTIFICATION.toastrMessage(data);
                }
            });
        });
    };
    var initChapterAction = function () {
        $(".scroll-to-commnet-box").click(function (e) {
            goToByScroll("comment-chapter-box");
        });
    };
    var logChapterPosition = function () {
        document.addEventListener("scroll", function (e) {
            var currentScroll = window.scrollY;
            var scrollLog = localStorage.getItem("chapterScrollLog");
            scrollLog = scrollLog ? JSON.parse(scrollLog) : {};
            scrollLog[storyMap] = {};
            scrollLog[storyMap][chapterMap] = currentScroll;
            localStorage.setItem("chapterScrollLog", JSON.stringify(scrollLog));
        });
    };
    var initBaseScrollChapter = function () {
        var scrollLog = localStorage.getItem("chapterScrollLog");
        if (scrollLog) {
            scrollLog = JSON.parse(scrollLog);
            if (scrollLog[storyMap]) {
                if (scrollLog[storyMap][chapterMap]) {
                    const params = new Proxy(
                        new URLSearchParams(window.location.search),
                        {
                            get: (searchParams, prop) => searchParams.get(prop),
                        }
                    );
                    let commentActive = params.cmt;
                    if (!commentActive) {
                        window.scrollTo(0, scrollLog[storyMap][chapterMap]);
                    }
                } else {
                    scrollLog[storyMap] = {};
                    scrollLog[storyMap][chapterMap] = 0;
                    localStorage.setItem(
                        "chapterScrollLog",
                        JSON.stringify(scrollLog)
                    );
                }
            }
        } else {
            scrollLog = {};
            scrollLog[storyMap] = {};
            scrollLog[storyMap][chapterMap] = 0;
            localStorage.setItem("chapterScrollLog", JSON.stringify(scrollLog));
        }
    };
    var resetBaseTheme = function () {
        applyTheme(baseSetting);
    };
    var initBtnSelectDefaultTheme = function () {
        $(".item-def-theme").click(function () {
            ipColor.val($(this).data("color"));
            ipBackround.val($(this).data("bg"));
            buildCurrentThemeInfo(false);
        });
    };
    var initBoxThemeSetting = function () {
        $(".show-chapter-theme-setting").click(function () {
            $(".setting-frontend").toggleClass("active");
        });
        $(window).click(function (e) {
            if (
                $(".show-chapter-theme-setting").has(e.target).length == 0 &&
                !$(".show-chapter-theme-setting").is(e.target) &&
                $(".setting-frontend").has(e.target).length == 0 &&
                !$(".setting-frontend").is(e.target)
            ) {
                $(".setting-frontend").removeClass("active");
            }
        });
    };
    var registerAutoUnlockChapter = function () {
        $("#register-auto-unlock-chapter").change(function (e) {
            var _this = $(this);
            $.ajax({
                url: "register-auto-unlock-chapter",
                type: "POST",
                dataType: "json",
                data: {
                    chapter: _this.val(),
                    status: _this.is(":checked") ? 1 : 0,
                },
            }).done(function (data) {
                if (data.code == 200) {
                    window.location.reload();
                } else {
                    NOTIFICATION.toastrMessage(data);
                    _this.prop("checked", _this.is(":checked") ? false : true);
                }
            });
        });
    };
    var showListChapter = function () {
        $(".btn-show-list-chapter-page").click(function () {
            var htmlBase = `
            <div class="list-chapter-page-wrapper">
            <div class="chapters-table__operations flex items-center justify-between flex-wrap">
                <label class="flex items-center shrink-0">
                    <input type="checkbox" id="sort_new_chapter" onchange="STORY.showChapterList(false)">
                    <span class="fon t-bold ml-2 shrink-0">Mới nhất</span>
                </label>
            </div>
            <div id="list-chapter-result"></div>
            </div>`;
            $(".list-chapter-page").html("");
            if ($(this).hasClass("active")) {
                $(".btn-show-list-chapter-page").removeClass("active");
            } else {
                $(".btn-show-list-chapter-page").removeClass("active");
                $(this).addClass("active");
                $(this)
                    .closest(".box-control")
                    .find(".list-chapter-page")
                    .html(htmlBase);
                STORY.showChapterList(false);
            }
        });
    };
    var registerAutoUnlockChapter = function () {
        $("#register-auto-unlock-chapter").change(function (e) {
            var _this = $(this);
            _this.prop("disabled", true);
            $.ajax({
                url: "register-auto-unlock-chapter",
                type: "POST",
                dataType: "json",
                data: {
                    chapter: _this.val(),
                    status: _this.is(":checked") ? 1 : 0,
                },
            }).done(function (data) {
                if (data.code == 200) {
                    window.location.reload();
                } else {
                    NOTIFICATION.toastrMessage(data);
                    _this.prop("disabled", false);
                    _this.prop("checked", _this.is(":checked") ? false : true);
                }
            });
        });
    };
    var registerAutoUnlockUseGiftcodeChapter = function () {
        $("#register-auto-unlock-use-giftcode-chapter").change(function (e) {
            var _this = $(this);
            _this.prop("disabled", true);
            $.ajax({
                url: "register-auto-unlock-use-giftcode-chapter",
                type: "POST",
                dataType: "json",
                data: {
                    chapter: _this.val(),
                    status: _this.is(":checked") ? 1 : 0,
                },
            }).done(function (data) {
                if (data.code == 200) {
                    window.location.reload();
                } else {
                    NOTIFICATION.toastrMessage(data);
                    _this.prop("disabled", false);
                    _this.prop("checked", _this.is(":checked") ? false : true);
                }
            });
        });
    };
    var useGiftcodeForChapter = function () {
        $("#use-giftcode-for-chapter").change(function (e) {
            var _this = $(this);
            _this.prop("disabled", true);
            $.ajax({
                url: "use-giftcode-for-chapter",
                type: "POST",
                dataType: "json",
                data: {
                    chapter: _this.val(),
                    status: _this.is(":checked") ? 1 : 0,
                },
            }).done(function (data) {
                if (data.code == 200) {
                    window.location.reload();
                } else {
                    NOTIFICATION.toastrMessage(data);
                    _this.prop("disabled", false);
                    _this.prop("checked", _this.is(":checked") ? false : true);
                }
            });
        });
    };
    var logStoryReaded = function () {
        if (!dataChapter) return;
        var chapterInfo = JSON.parse(dataChapter);
        var storyReaded = localStorage.getItem("storyReaded");
        if (!storyReaded) {
            storyReaded = {};
        } else {
            storyReaded = JSON.parse(storyReaded);
        }
        storyReaded[chapterInfo["story_id"]] = chapterInfo;
        localStorage.setItem("storyReaded", JSON.stringify(storyReaded));
    };
    return {
        _: function () {
            unlockChapter();
            initChapterAction();
            logChapterPosition();
            initBaseScrollChapter();
            initThemeSetting();
            buildCurrentThemeInfo(true);
            initBtnSelectDefaultTheme();
            initBoxThemeSetting();
            showListChapter();
            registerAutoUnlockChapter();
            registerAutoUnlockUseGiftcodeChapter();
            useGiftcodeForChapter();
            logStoryReaded();
        },
        resetBaseTheme: function (val) {
            resetBaseTheme(val);
        },
    };
})();

var nx_scrollToTop = (function () {
    let scrollBtn = document.getElementById("scroll-to-top-btn");
    var scrollToTopFunc = function () {

        if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
            scrollBtn.style.display = "block";
        } else {
            scrollBtn.style.display = "none";
        }
    };

    var goToTopFunc = function () {
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
    }

    return {
        _: function () {
            window.onscroll = function() {scrollToTopFunc()};
            scrollBtn.addEventListener("click", goToTopFunc);
        },
    };
})();

$(document).ready(function () {
    CHAPTER_MANAGE._();
    nx_scrollToTop._();

    $('#report_chapter_error_btn').on( "click", function() {
        var form_data = $("#report_chapter_error_form :input").serializeArray();
        var payload = {};
        $.each(form_data, function (k, v) {
            if (v['value'] != "") {
                payload[v['name']] = v['value']
            }
        });

        $.ajax({
            type: 'POST',
            contentType: 'application/json; charset=utf-8',
            dataType: 'json',
            url: BACKEND_API + '/v1/report_chapter_error',
            data: JSON.stringify(payload),
            success: function (resp) {
                var notify_code = 100;
                if (resp.success) {
                    notify_code = 200;
                }
                // NOTIFICATION from base.js
                NOTIFICATION.showNotify(notify_code, resp.message);
            },
            error: function(xhr, status, error) {
                NOTIFICATION.showNotify(100, "Có lỗi xử lý. Báo lỗi thất bại.");
                // console.log(xhr.responseText);
            },
        });

        jQuery('.close-modal').trigger('click');
    });
});
