jQuery.fn.highlight = function (pat) {
    function innerHighlight(node, pat) {
        var skip = 0;
        if (node.nodeType == 3) {
            var pos = node.data.toUpperCase().indexOf(pat);
            pos -=
                node.data.substr(0, pos).toUpperCase().length -
                node.data.substr(0, pos).length;
            if (pos >= 0) {
                var spannode = document.createElement("span");
                spannode.className = "highlight";
                var middlebit = node.splitText(pos);
                var endbit = middlebit.splitText(pat.length);
                var middleclone = middlebit.cloneNode(true);
                spannode.appendChild(middleclone);
                middlebit.parentNode.replaceChild(spannode, middlebit);
                skip = 1;
            }
        } else if (
            node.nodeType == 1 &&
            node.childNodes &&
            !/(script|style)/i.test(node.tagName)
        ) {
            for (var i = 0; i < node.childNodes.length; ++i) {
                i += innerHighlight(node.childNodes[i], pat);
            }
        }
        return skip;
    }
    return this.length && pat && pat.length
        ? this.each(function () {
              innerHighlight(this, pat.toUpperCase());
          })
        : this;
};
jQuery.fn.removeHighlight = function () {
    return this.find("span.highlight")
        .each(function () {
            this.parentNode.firstChild.nodeName;
            with (this.parentNode) {
                replaceChild(this.firstChild, this);
                normalize();
            }
        })
        .end();
};
var SEARCH = (function () {
    var autoclose = function () {
        $(window).click(function (e) {
            if (
                $(".form-search-autocomplete").has(e.target).length == 0 &&
                $(".auto-complete-result").has(e.target).length == 0 &&
                !$(".auto-complete-result").is(e.target)
            ) {
                $(".auto-complete-result").css({ display: "none" });
                $(".form-search-autocomplete input").val("");
            }
        });
    };
    var autoComplete = function () {
        var getAuto = null;
        $(document).on("input", ".form-search-autocomplete input", function () {
            var _this = $(this);
            var boxSearch = _this.closest(".form-search-autocomplete");
            var loaddingBox = boxSearch.find(".in-loading");
            var boxResult = boxSearch.find(".auto-complete-result");
            var textResult = boxSearch.find(
                ".auto-complete-result .text-result"
            );
            var val = _this.val();
            clearTimeout(getAuto);
            var emptyHtml = "";
            textResult.html(emptyHtml);
            if (val != "") {
                loaddingBox.css("display", "block");
                boxResult.css("display", "block");
            }
            getAuto = setTimeout(function () {
                if (val == "") {
                    boxResult.css({ display: "none" });
                } else {
                    if (val.length < 3) {
                        loaddingBox.css("display", "none");
                        textResult.html(
                            '<p class="text-center py-2">Vui lòng nhập từ khóa it nhất 3 kí tự</p>'
                        );
                    } else {
                        $.ajax({
                            url: _this
                                .closest(".form-search-autocomplete")
                                .attr("action"),
                            type: "POST",
                            global: false,
                            data: { q: val },
                        }).done(function (data) {
                            loaddingBox.css("display", "none");
                            textResult.html(data);
                            if (val.trim().length > 1) {
                                var arrKeys = val.split(" ");
                                for (var i = arrKeys.length - 1; i >= 0; i--) {
                                    textResult
                                        .find(".name")
                                        .highlight(arrKeys[i]);
                                }
                            }
                        });
                    }
                }
            }, 300);
        });
    };
    return {
        _: function () {
            autoclose();
            autoComplete();
        },
    };
})();
var NOTIFICATION_USER = (() => {
    var markNotification = () => {
        const notificationItem =
            document.querySelectorAll(".notification-item");
        notificationItem.forEach((item) => {
            item.onclick = (e) => {
                if (item.classList.contains("no-read")) {
                    e.preventDefault();
                    $.ajax({
                        url: "danh-dau-da-doc",
                        method: "POST",
                        global: false,
                        dataType: "json",
                        data: {
                            id: item.dataset.id,
                        },
                    }).done(function (data) {
                        item.classList.remove("no-read");
                        if (data.code == 200) {
                            $(".count-new-notifice").html(data.count_no_read);
                        }
                        window.location.href = $(item).attr("href");
                    });
                }
            };
        });
    };
    var markAllNotification = () => {
        $.ajax({
            url: "danh-dau-da-doc",
            method: "POST",
            global: false,
            data: {
                type: "all",
            },
        }).done(function (data) {
            window.location.reload();
        });
    };
    var initSystemMessage = () => {
        $(".item-system-message").each(function (idx, elm) {
            var mainBox = $(elm);
            var contentBox = mainBox.find(".item-content");
            var mainTitle = mainBox.find(".main-title");
            mainTitle.click(function () {
                mainBox.toggleClass("active");
                if (mainBox.hasClass("active")) {
                    contentBox.slideDown(600);
                } else {
                    contentBox.slideUp(600);
                }
            });
        });
    };
    var initStoryboard = () => {
        $(".storyboard-box a").click(function () {
            var _this = $(this);
            $(".storyboard-box a").removeClass("active");
            _this.addClass("active");
            if (_this.hasClass("not-login")) {
                var htmlContent = "";
                if (_this.data("type") == 1) {
                    var storyReaded = localStorage.getItem("storyReaded");
                    if (!storyReaded) {
                        storyReaded = {};
                    } else {
                        storyReaded = JSON.parse(storyReaded);
                    }
                    Object.keys(storyReaded).forEach(function (key) {
                        var chapterInfo = storyReaded[key].chapter;
                        var storyInfo = storyReaded[key].story_info;
                        if (chapterInfo && storyInfo) {
                            htmlContent += `<div class="card-readed p-4 relative">
                                <a href="javascript:void(0)" data-item="${key}" title="Xóa" class="delete-item delete-item-storyboard-lc"><i class="fa-solid fa-xmark"></i></a>
                                <div class="flex items-center justify-between mb-3">
                                    <a href="${storyInfo.slug}" title="${storyInfo.name}" class="name line-camp-1 2xl:text-[1.25rem] mr-4">
                                        <span style="color:${storyInfo.category_color};">[${storyInfo.category}]</span>
                                        ${storyInfo.name}
                                    </a>
                                    <a href="${storyInfo.author_slug}" class="author text-[#999] text-[0.875rem] shrink-0 line-camp-1">${storyInfo.author}</a>
                                </div>
                                <a href="${chapterInfo.slug}" class="cate-items text-[#999] text-[0.875rem]">
                                    ${chapterInfo.name}
                                </a>
                            </div>`;
                        }
                    });
                }
                if (htmlContent == "") {
                    htmlContent = `<p class="p-3 text-center">Bạn chưa có truyện nào</p>`;
                }
                $(".board-content-result").html(htmlContent);
            } else {
                $(".board-content-result").html(`
                <div class="in-loading text-center">
                    <div class="loader-dot">
                        <div class="loader-item"></div>
                        <div class="loader-item"></div>
                        <div class="loader-item"></div>
                        <div class="loader-item"></div>
                    </div>
                </div>`);
                $.ajax({
                    url: _this.data("action"),
                    type: "GET",
                    global: false,
                    dataType: "html",
                    data: { type: _this.data("type") },
                }).done(function (html) {
                    $(".board-content-result").html(html);
                });
            }
        });
        $(document).on("click", ".delete-item-storyboard-lc", function () {
            var storyId = $(this).data("item");
            var storyReaded = localStorage.getItem("storyReaded");
            if (!storyReaded) {
                storyReaded = {};
            } else {
                storyReaded = JSON.parse(storyReaded);
            }
            if (storyReaded.hasOwnProperty(storyId)) {
                delete storyReaded[storyId];
                localStorage.setItem(
                    "storyReaded",
                    JSON.stringify(storyReaded)
                );
            }
            $(this).closest(".card-readed").remove();
            if ($(".board-content-result .card-readed").length == 0) {
                $(".board-content-result").html(
                    '<p class="p-3 text-center">Bạn chưa có truyện nào</p>'
                );
            }
        });
        $(document).on("click", ".delete-item-storyboard", function () {
            var _this = $(this);
            _this.closest(".card-readed").remove();
            if ($(".board-content-result .card-readed").length == 0) {
                $(".board-content-result").html(
                    '<p class="p-3 text-center">Bạn chưa có truyện nào</p>'
                );
            }
            $.ajax({
                url: _this.data("action"),
                data: { item: _this.data("item") },
                method: "GET",
                global: false,
                dataType: "json",
            });
        });
    };
    var loadInfoUserHeader = function () {
        var infoHeaderResult = $("#info-header-result:not(.inited)");
        if (infoHeaderResult.length == 0) return;
        infoHeaderResult.addClass("inited");
        $.ajax({
            url: infoHeaderResult.data("action"),
            type: "GET",
            dataType: "html",
            global: false,
        }).done(function (html) {
            infoHeaderResult.html(html);
        });
    };
    return {
        _: () => {
            markNotification();
            initSystemMessage();
            initStoryboard();
        },
        markAllNotification: () => {
            markAllNotification();
        },
        loadInfoUserHeader: () => {
            loadInfoUserHeader();
        },
    };
})();

$(document).ready(function () {
    SEARCH._();
    NOTIFICATION_USER._();
});
