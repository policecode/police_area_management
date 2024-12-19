var hidden, visibilityChange;
var isHidden = false;
if (typeof document.hidden !== "undefined") {
    hidden = "hidden";
    visibilityChange = "visibilitychange";
} else if (typeof document.msHidden !== "undefined") {
    hidden = "msHidden";
    visibilityChange = "msvisibilitychange";
} else if (typeof document.webkitHidden !== "undefined") {
    hidden = "webkitHidden";
    visibilityChange = "webkitvisibilitychange";
}
function handleVisibilityChange() {
    if (document[hidden]) {
        isHidden = true;
    } else {
        isHidden = false;
    }
}
if (typeof document.addEventListener === "undefined" || hidden === undefined) {
} else {
    document.addEventListener(visibilityChange, handleVisibilityChange, false);
}
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});
var BASE_GUI = {
    init: function () {
        BASE_GUI.initButtonCopy();
        BASE_GUI.initButtonScrollToTarget();
        BASE_GUI.initJumbox();
        if ($(".select2-module").length > 0) {
            $(".select2-module").select2();
        }
    },
    initJumbox: function () {
        $(document).on("click", ".jum-box button", function () {
            var paginationBox = $(this).closest(".pagination");
            var jumBox = $(this).closest(".jum-box");
            var inputPage = jumBox.find("input");
            if (!inputPage) return;
            var pageJum = parseInt(inputPage.val());
            var lastPage = jumBox.data("lastpage");
            if (isNaN(pageJum) || pageJum <= 0 || pageJum > lastPage) {
                return;
            }
            var isAjax = jumBox.data("ajax");
            var urlBase = jumBox.data("url");
            var tagANew = `<div style="max-width:1px;max-height:1px;overflow:hidden;visibility:hidden;"><a class="tpm-link" href="${
                urlBase + "&page=" + pageJum
            }"></a></div>`;
            paginationBox.append(tagANew);
            var itemClick = paginationBox.find(".tpm-link");
            itemClick.click();
            if (isAjax != 1) {
                itemClick.get(0).click();
            }
            itemClick.trigger("click");
        });
    },
    initButtonCopy: function () {
        $(document).on("click", ".btn-copy-text-info", function () {
            BASE_GUI.copyTextToClipboard($(this).data("content"));
        });
    },
    disableButton: function (element) {
        let innerDimensions = BASE_GUI.innerDimensions(element);
        let imgLoading = `<span style="display: flex;text-align:center;width: ${
            innerDimensions.width - 2
        }px;height: ${
            innerDimensions.height
        }px;justify-content: center;"><img style="height: ${
            innerDimensions.height - 2
        }px;" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiBzdHlsZT0ibWFyZ2luOiBhdXRvOyBiYWNrZ3JvdW5kOiBub25lOyBkaXNwbGF5OiBibG9jazsgc2hhcGUtcmVuZGVyaW5nOiBhdXRvOyIgd2lkdGg9IjY0cHgiIGhlaWdodD0iNjRweCIgdmlld0JveD0iMCAwIDEwMCAxMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89InhNaWRZTWlkIj4KPGNpcmNsZSBjeD0iNTAiIGN5PSI1MCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjZmZmZmZmIiBzdHJva2Utd2lkdGg9IjciIHI9IjQ0IiBzdHJva2UtZGFzaGFycmF5PSIyMDcuMzQ1MTE1MTM2OTI2MzIgNzEuMTE1MDM4Mzc4OTc1NDQiPgogIDxhbmltYXRlVHJhbnNmb3JtIGF0dHJpYnV0ZU5hbWU9InRyYW5zZm9ybSIgdHlwZT0icm90YXRlIiByZXBlYXRDb3VudD0iaW5kZWZpbml0ZSIgZHVyPSIwLjU1ODY1OTIxNzg3NzA5NDlzIiB2YWx1ZXM9IjAgNTAgNTA7MzYwIDUwIDUwIiBrZXlUaW1lcz0iMDsxIj48L2FuaW1hdGVUcmFuc2Zvcm0+CjwvY2lyY2xlPgo8IS0tIFtsZGlvXSBnZW5lcmF0ZWQgYnkgaHR0cHM6Ly9sb2FkaW5nLmlvLyAtLT48L3N2Zz4=" />`;
        element.setAttribute("data-old-text", element.innerHTML);
        element.innerHTML = imgLoading;
        element.style.pointerEvents = "none";
    },
    innerDimensions: function (element) {
        var computedStyle = getComputedStyle(element);
        let width = element.clientWidth;
        let height = element.clientHeight;
        height -=
            parseFloat(computedStyle.paddingTop) +
            parseFloat(computedStyle.paddingBottom);
        width -=
            parseFloat(computedStyle.paddingLeft) +
            parseFloat(computedStyle.paddingRight);
        return { height, width };
    },
    enableButton: function (element) {
        element.innerHTML = element.getAttribute("data-old-text");
        element.removeAttribute("data-old-text");
        element.style.pointerEvents = "all";
    },
    copyTextToClipboard: function (text) {
        var textArea = document.createElement("textarea");
        textArea.style.position = "fixed";
        textArea.style.top = 0;
        textArea.style.left = 0;
        textArea.style.width = "2em";
        textArea.style.height = "2em";
        textArea.style.padding = 0;
        textArea.style.border = "none";
        textArea.style.outline = "none";
        textArea.style.boxShadow = "none";
        textArea.style.background = "transparent";
        textArea.value = text;
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        try {
            var successful = document.execCommand("copy");
            document.body.removeChild(textArea);
            NOTIFICATION.showNotify(200, "Copy thành công.");
            return true;
        } catch (err) {
            document.body.removeChild(textArea);
            NOTIFICATION.showNotify(
                100,
                "Copy không thành công. Vui lòng tự copy :>"
            );
            return false;
        }
    },
    initButtonScrollToTarget: function () {
        $(".scroll-to-target").click(function () {
            var _this = $(this);
            $("html, body").animate(
                {
                    scrollTop: $(_this.data("target")).offset().top,
                },
                300
            );
        });
    },
};
var LOADING = (function () {
    if (document.getElementById("loader") != null) return;
    var _initHTML = function () {
        var div = document.createElement("div");
        div.setAttribute("id", "loader");
        div.innerHTML = `<div class="sk-cube-grid"><div class="sk-cube sk-cube1"></div><div class="sk-cube sk-cube2"></div><div class="sk-cube sk-cube3"></div><div class="sk-cube sk-cube4"></div><div class="sk-cube sk-cube5"></div><div class="sk-cube sk-cube6"></div><div class="sk-cube sk-cube7"></div><div class="sk-cube sk-cube8"></div><div class="sk-cube sk-cube9"></div></div>`;
        document.body.appendChild(div);
    };
    var _initCss = function () {
        var styles = `#loader{display:none;position:fixed;z-index:9999;top:0;width:100vw;height:100vh;background:#0000008a;text-align:center}#loader .sk-cube-grid{width:80px;height:80px;margin-top:-40px;top:50%;position:fixed;left:50%;margin-left:-40px}#loader .sk-cube-grid .sk-cube{width:33%;height:33%;background-color:#fff;float:left;-webkit-animation:sk-cubeGridScaleDelay 1.3s infinite ease-in-out;animation:sk-cubeGridScaleDelay 1.3s infinite ease-in-out}#loader .sk-cube-grid .sk-cube1{-webkit-animation-delay:.2s;animation-delay:.2s}#loader .sk-cube-grid .sk-cube2{-webkit-animation-delay:.3s;animation-delay:.3s}#loader .sk-cube-grid .sk-cube3{-webkit-animation-delay:.4s;animation-delay:.4s}#loader .sk-cube-grid .sk-cube4{-webkit-animation-delay:.1s;animation-delay:.1s}#loader .sk-cube-grid .sk-cube5{-webkit-animation-delay:.2s;animation-delay:.2s}#loader .sk-cube-grid .sk-cube6{-webkit-animation-delay:.3s;animation-delay:.3s}#loader .sk-cube-grid .sk-cube7{-webkit-animation-delay:0s;animation-delay:0s}#loader .sk-cube-grid .sk-cube8{-webkit-animation-delay:.1s;animation-delay:.1s}#loader .sk-cube-grid .sk-cube9{-webkit-animation-delay:.2s;animation-delay:.2s}@-webkit-keyframes sk-cubeGridScaleDelay{0%,100%,70%{-webkit-transform:scale3D(1,1,1);transform:scale3D(1,1,1)}35%{-webkit-transform:scale3D(0,0,1);transform:scale3D(0,0,1)}}@keyframes sk-cubeGridScaleDelay{0%,100%,70%{-webkit-transform:scale3D(1,1,1);transform:scale3D(1,1,1)}35%{-webkit-transform:scale3D(0,0,1);transform:scale3D(0,0,1)}}`;
        var styleSheet = document.createElement("style");
        styleSheet.type = "text/css";
        styleSheet.innerText = styles;
        document.head.appendChild(styleSheet);
    };
    var _initAjax = function () {
        $(document).ajaxStart(function () {
            $("#loader").fadeIn(100);
        });
        $(document).ajaxComplete(function (event, xhr, settings) {
            $("#loader").delay(300).fadeOut(500);
        });
    };
    return {
        _: function () {
            _initHTML();
            _initCss();
            _initAjax();
        },
    };
})();
var NOTIFICATION = {
    toastrMessage: function (data) {
        NOTIFICATION.showNotify(data.code, data.message);
    },
    toastrMessageReload: function (data) {
        if (data.code == 200) {
            window.location.reload();
        } else {
            NOTIFICATION.showNotify(data.code, data.message);
            if (typeof grecaptcha === "object") {
                grecaptcha.reset();
            }
        }
    },
    redirect: function (data) {
        if (data.code == 200) {
            window.location.href = data.redirect_url;
        } else {
            NOTIFICATION.showNotify(data.code, data.message);
        }
    },
    toastrMessageRedirect: function (data) {
        if (data.code == 200) {
            if (data.redirect_url) {
                window.location.href = data.redirect_url;
            }
        } else {
            NOTIFICATION.showNotify(data.code, data.message);
            if (
                typeof grecaptcha === "object" &&
                $(".g-recaptcha").length > 0
            ) {
                grecaptcha.reset();
            }
        }
    },
    showNotifyWhenLoadPage() {
        if (
            typeNotify != "undefined" &&
            typeNotify != undefined &&
            typeNotify != "" &&
            messageNotify != "undefined" &&
            messageNotify != undefined &&
            messageNotify != ""
        ) {
            var code = typeNotify;
            this.showNotify(code, messageNotify);
        }
    },
    showNotify(code, message) {
        for (const toastr of document.querySelectorAll(".toastify")) {
            toastr.remove();
        }
        Toastify({
            text: message,
            close: true,
            style: {
                background:
                    code == 200
                        ? "linear-gradient(to right, rgb(0, 176, 155), rgb(150, 201, 61))"
                        : "linear-gradient(to right, rgb(255, 95, 109), rgb(255, 195, 113))",
            },
        }).showToast();
    },
};
NOTIFICATION.showNotifyWhenLoadPage();
$(document).ready(function () {
    BASE_GUI.init();
    LOADING._();
});
