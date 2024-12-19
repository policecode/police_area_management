function _defineProperty(obj, key, value) {
    if (key in obj) {
        Object.defineProperty(obj, key, {
            value: value,
            enumerable: true,
            configurable: true,
            writable: true,
        });
    } else {
        obj[key] = value;
    }
    return obj;
}
class infiniteLoadBox {
    constructor(element) {
        _defineProperty(this, "element", void 0);
        _defineProperty(this, "io", void 0);
        this.element = element;
        this.initLoadAction();
        return this;
    }
    initLoadAction() {
        var _this = this;
        this.element.after(
            `<div id="continue-load-point" style="height:1px"></div>`
        );
        this.io = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) {
                    return;
                }
                _this.loadItem();
            });
        });
        this.io.observe($("#continue-load-point")[0]);
    }
    loadItem() {
        var _this = this;
        var pagenigationBox = _this.element.find(".pagination-hidden-box");
        if (pagenigationBox.length == 0) {
            return;
        }
        var nextPage = pagenigationBox.find(".next-page");
        if (nextPage.length == 0) {
            return;
        }
        _this.startLoad();
        pagenigationBox.remove();
        $.ajax({
            url: nextPage.attr("href") + "&type=load_item",
            method: "GET",
            global: false,
        }).done(function (data) {
            _this.endLoad();
            _this.element.append(data);
        });
    }
    startLoad() {
        this.element.append(`<div class="in-loading text-center">
            <div class="loader-dot">
                <div class="loader-item"></div>
                <div class="loader-item"></div>
                <div class="loader-item"></div>
                <div class="loader-item"></div>
            </div>
        </div>`);
    }
    endLoad() {
        this.element.find(".in-loading").remove();
    }
}
$(document).ready(function () {
    $(".infinite-load-item-module").each(function (index, element) {
        var infiniteLoad = new infiniteLoadBox($(element));
    });
});
