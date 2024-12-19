var CLICK = {
    fixedMenu: function () {
        /* CĂ i Ä‘áº·t cháº¿ Ä‘á»™ menu */
        optionMenu = {
            hideOnScrollDown: false,
            delayShowOnScrollTop: 0 /* Delay hiá»ƒn thá»‹ khi scroll top. Ăp dá»¥ng khi hideOnScrollDown = true */,
        };

        hideOnScrollDown = optionMenu.hideOnScrollDown || false;
        delayShowOnScrollTop = optionMenu.delayShowOnScrollTop || 0;

        /* Khai bĂ¡o header */
        var header = Tech.$(".header");
        var headerHeight = header.outerHeight();
        var headerTopHeight = Tech.$(".header-top").outerHeight();
        var bodyPage = Tech.$("body");
        var width_ = window.innerWidth;

        /* Function phá»¥ trá»£ */

        /* áº¨n hiá»‡n menu khi scroll */
        var lastScrollTop = 0;
        window.addEventListener("scroll", function () {
            var st = window.pageYOffset || document.documentElement.scrollTop;
            if (st > lastScrollTop) {
                if (lastScrollTop > headerHeight) {
                    header.css("top", `-` + headerTopHeight + `px`);
                }
            } else {
                header.css("top", "0px");
            }
            if (st > headerHeight) {
                header.addClass("scroll");
            } else {
                header.removeClass("scroll");
            }

            lastScrollTop = st <= 0 ? 0 : st;
        });
    },
    showMenu: function () {
        var buttonShowMenu = Tech.$(".show-menu-mobile");
        if (!Tech.$(".box-menu-on-mobile")) {
            return;
        }
        if (typeof buttonShowMenu != "undefined") {
            buttonShowMenu.onClick(function () {
                Tech.$(".box-menu-on-mobile").toggleClass("hidden");
            });
            document.addEventListener("click", function (event) {
                var insideBtn = event.target.closest(".show-menu-mobile");
                var insideForm = event.target.closest(".box-menu-on-mobile");
                if (!insideBtn && !insideForm) {
                    Tech.$(".box-menu-on-mobile").addClass("hidden");
                }
            });
        }
    },

    showUser: function () {
        var btn = Tech.$(".show-info-user");
        if (typeof btn !== "undefined") {
            btn.onClick(function () {
                Tech.$(".box-option").toggleClass("active");
                NOTIFICATION_USER.loadInfoUserHeader();
            });
        }
        document.addEventListener("click", function (event) {
            var insideBtn = event.target.closest(".show-info-user");
            var insideForm = event.target.closest(".box-option");
            if (!insideBtn && !insideForm) {
                if (Tech.$(".box-option")) {
                    Tech.$(".box-option").removeClass("active");
                }
            }
        });
    },
    likeComment: function () {
        var btnLike = Tech.$(".btn-like");
        if (typeof btnLike !== "undefined" && btnLike != null) {
            btnLike.onClick(function () {
                Tech.$(this).toggleClass("like");
            });
        }
    },
    showStory: function () {
        var btnShow = Tech.$("a[show-story]");
        var overlay = Tech.$(".overlay-board");
        var btnClose = Tech.$(".btn-close-board");
        if (typeof btnShow !== "undefined") {
            btnShow.onClick(function () {
                Tech.$(".box-storyboard").addClass("active");
                Tech.$(".overlay-board").addClass("show");
                if ($(".box-storyboard .active").length == 0) {
                    $(".main-item-storyboard").click();
                }
            });
        }
        if (typeof overlay !== "undefined" && btnClose !== "undefined") {
            overlay.onClick(function () {
                Tech.$(".box-storyboard").removeClass("active");
                Tech.$(".overlay-board").removeClass("show");
            });
            btnClose.onClick(function () {
                Tech.$(".box-storyboard").removeClass("active");
                Tech.$(".overlay-board").removeClass("show");
            });
        }
    },
    init: function () {
        CLICK.showMenu();
        CLICK.showUser();
        CLICK.likeComment();
        CLICK.showStory();
    },
};
Tech.Query.ready(function () {
    setTimeout(function () {
        CLICK.init();
    }, 100);
    // BackToTop.create('.back-to-top', {
    //     threshold: 300,
    // })
});
