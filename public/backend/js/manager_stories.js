var vue_data = {
    loaded: false,
    loading: false,
    currentAction: "",
    getItemUrl: "",
    items: [],
    screen: "list",
    itemDetail: {
        thumbnail: "",
        status: "",
        category: [],
    },
    actionList: "",
    selectedCat: [],
    selectedAuthor: null,
    files: {},
    listId: [],
    checkAll: false,
    errors: {},
    queryToDate: "",
    queryFromDate: "",
    querySearch: {
        total: 0,
        page: 1,
        per_page: 20,
        keyword: "",
        category_id: "",
        is_lock: "",
        order_by: "id",
        order_type: "DESC",
    },
    apiUrl: FVN_LARAVEL_HOME + "/admin/stories",
    statusStory: statusStory,
    categories: [],
    authors: [],
    pointInTime: null,
    // Chức năng thêm người dùng được đọc bộ truyện
    lockStories: lockStories,
    loadingSearchUser: false,
    keySearhUser: "",
    searchUserItems: [],
    userItems: [],
    querySearchUser: {
        total: 0,
        page: 1,
        per_page: 20,
        story_id: '',
        order_by: "updated_at",
        order_type: "DESC",
    },
};
// Vue.component('autocomplete', VueBootstrapTypeahead);
// Vue.component('datepicker', vuejsDatepicker);
Vue.component("multiselect", window.VueMultiselect.default);
// Vue.component('star-rating', VueStarRating.default);
var app = new Vue({
    el: "#app",
    data: vue_data,
    mounted: function () {
        this.loaded = true;
        this.updateQueryFromUrl();
        this.searchItem();
        this.getCategories();
    },
    computed: {},
    methods: {
        updateQueryFromUrl() {
            if (window.location.hash) {
                let querySearch = queryToObject(
                    window.location.hash.substring(1)
                );
                console.log(window.location.hash.substring(1), querySearch);
                for (key in querySearch) {
                    this.querySearch[key] = querySearch[key];
                }
            }
        },
        changeScreen(scr) {
            this.screen = scr;
        },
        async showItem(item) {
            // Selected Author
            let jsonData = await new RouteApi().get(
                `${FVN_LARAVEL_HOME}/admin/author/${item.author_id}`
            );
            // console.log(jsonData);

            this.selectedAuthor = jsonData.data;
            // Selected Catefory
            for (let i = 0; i < item.category.length; i++) {
                for (let j = 0; j < this.categories.length; j++) {
                    if (item.category[i] == this.categories[j].id) {
                        this.selectedCat.push(this.categories[j]);
                        break;
                    }
                }
            }
            this.itemDetail = item;
            this.screen = "detail";
        },

        closeItem() {
            this.itemDetail = {
                thumbnail: "",
                status: "",
                category: [],
            };
            this.selectedCat = [];
            this.errors = {};
            this.screen = "list";
        },
        async deleteItem(item) {
            if (confirm(`Do you want to delete the Story: ${item.title}`)) {
                let jsonData = await new RouteApi().delete(
                    `${this.apiUrl}/${item.id}`,
                    {}
                );
                jnotice(jsonData.message);
                this.getItems();
            }
        },
        searchItem() {
            this.getItems();
            this.getPaging();
        },
        orderBy(name) {
            if (this.querySearch.order_by == name) {
                if (this.querySearch.order_type == "DESC") {
                    this.querySearch.order_type = "ASC";
                } else {
                    this.querySearch.order_type = "DESC";
                }
            } else {
                this.querySearch.order_by = name;
                this.querySearch.order_type = "DESC";
            }
            this.searchItem();
        },
        isOrder(name, type) {
            if (
                this.querySearch.order_by == name &&
                this.querySearch.order_type == type
            ) {
                return true;
            }
            return false;
        },
        async getItems() {
            this.loading = true;
            this.buildQueryItem();
            // Lưu trạng thái url cuối cùng trước khi chuyển trang
            LocalStorageHelper.set(
                "fvn_current_url_story",
                window.location.href
            );
            const jsonData = await new RouteApi().get(this.getItemUrl);
            this.loading = false;
            if (jsonData.result) {
                this.items = jsonData.data;
                if (this.itemDetail.id) {
                    for (i in this.items) {
                        if (this.items[i].id == this.itemDetail.id) {
                            this.itemDetail = this.items[i];
                            break;
                        }
                    }
                }
            } else {
                this.items = [];
                // jAlert(jsonData.message);
            }
        },
        async getPaging() {
            this.buildQueryItem(true);
            let jsonData = await new RouteApi().get(this.getItemUrl);
            this.querySearch.total = jsonData.total;
        },
        async getCategories() {
            let jsonData = await new RouteApi().get(
                `${FVN_LARAVEL_HOME}/admin/category/get-items?per_page=0`
            );
            this.categories = jsonData.data;
        },
        async getAuthors(newKey) {
            if (this.pointInTime) {
                clearTimeout(this.pointInTime);
            }
            this.pointInTime = setTimeout(async () => {
                let jsonData = await new RouteApi().get(
                    `${FVN_LARAVEL_HOME}/admin/author/get-items?keyword=${newKey}&per_page=5`
                );
                this.authors = jsonData.data;
                console.log(this.authors);
                
            }, 300);
        },
        nextPage(page) {
            this.querySearch.page = page;
            this.getItems();
        },
        changeLimit(per_page) {
            this.querySearch.per_page = parseInt(per_page);
            this.querySearch.page = 1;
            this.getItems();
            this.getPaging();
        },
        selectItem(item) {
            this.screen = "Item_detail";
            this.itemDetail = item;
        },
        doAction() {
            if (!this.currentAction) {
                return jAlert("Please choose an action");
            }
            return this[this.currentAction]();
        },
        async uploadFile(e, name) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length) return;

            let reader = new FileReader();
            if (name == "thumbnail") {
                this.files.thumbnail = files[0];

                await reader.readAsDataURL(files[0]);
                reader.onload = function () {
                    // console.log(reader.result);
                    app.itemDetail.thumbnail = reader.result;
                };
            }
        },
        async handleActionList() {
            if (!this.actionList) {
                return jAlert("Chọn hành động trước khi thực hiện");
            }
            this.loading = true;
            let jsonData = await new RouteApi().post(
                `${this.apiUrl}/handle-list-stories`,
                {
                    list_id: this.listId,
                    action: this.actionList,
                }
            );
            this.loading = false;
            if (jsonData.status) {
                this.checkAll = false;
                this.listId = [];
                jnotice(jsonData.message);
                this.searchItem();
            } else {
                jAlert(jsonData.message);
            }
        },
        
        async save(e) {
            e.preventDefault();
            var data = new FormData();

            for (let i in this.itemDetail) {
                if (
                    Array.isArray(this.itemDetail[i]) ||
                    typeof this.itemDetail[i] == "object"
                ) {
                    let valueObj = this.itemDetail[i];
                    for (const key in valueObj) {
                        data.append(i + "[" + key + "]", valueObj[key]);
                    }
                } else {
                    if (this.itemDetail[i]) {
                        data.append(i, this.itemDetail[i]);
                    }
                }
            }
            if (this.files.thumbnail) {
                data.append("thumbnail", this.files.thumbnail);
            }
            this.loading = true;
            let jsonData;
            if (this.itemDetail.id) {
                jsonData = await new RouteApi().post(
                    `${this.apiUrl}/update/${this.itemDetail.id}`,
                    data,
                    "form"
                );
            } else {
                jsonData = await new RouteApi().post(
                    `${this.apiUrl}`,
                    data,
                    "form"
                );
            }
            this.loading = false;

            if (jsonData.status) {
                jnotice(jsonData.message);
                if (this.itemDetail.id) {
                    this.itemDetail = jsonData.data;
                } else {
                    this.items.unshift(jsonData.data);
                }
                this.closeItem();
            } else {
                if (jsonData.errors) {
                    this.errors = jsonData.errors;
                }
                jAlert(jsonData.message);
            }
        },
        displayDate(date, timezone) {
            if (date) {
                if (timezone) {
                    return format_date(date, "Y-m-d h:i:s", true);
                } else {
                    return format_date(date);
                }
            }
        },
        updateOrdering(key) {
            if (this.querySearch.order_by != key) {
                this.querySearch.order_type = "DESC";
            } else {
                if (this.querySearch.order_type == "ASC") {
                    this.querySearch.order_type = "DESC";
                } else {
                    this.querySearch.order_type = "ASC";
                }
            }
            this.querySearch.order_by = key;
            this.getItems();
        },
        displayOrdering(key) {
            if (this.querySearch.order_by == key) {
                if (this.querySearch.order_type == "ASC") {
                    return `<span class="ml-1">&#8593;</span>`;
                } else {
                    return `<span class="ml-1">&#8595;</span>`;
                }
            }
            return "";
        },
        buildQueryItem(task, changeUrl) {
            if (changeUrl == undefined) {
                changeUrl = true;
            }
            if (task == "export") {
                this.getItemUrl = this.apiUrl + ".export";
            } else if (task) {
                this.getItemUrl = this.apiUrl + "/get-items?is_paginate=1";
            } else {
                this.getItemUrl = this.apiUrl + "/get-items?is_paginate=";
            }
            let paramSearch = {};
            for (const i in this.querySearch) {
                let value = this.querySearch[i];
                if (value) {
                    if (i == "book_date_min" || i == "book_date_max") {
                        value = format_date(value);
                    }
                    paramSearch[i] = value;
                    this.getItemUrl += "&" + i + "=" + value;
                }
            }

            paramSearch["order_by"] = this.querySearch.order_by;
            paramSearch["order_type"] = this.querySearch.order_type;
            paramSearch["per_page"] = this.querySearch.per_page;
            paramSearch["page"] = this.querySearch.page;
            if (changeUrl) {
                // console.log(objectToQuery(paramSearch));
                parent.location.hash = objectToQuery(paramSearch);
            }
        },
        clearFilter() {
            this.querySearch = {
                total: 0,
                page: 1,
                per_page: 20,
                keyword: "",
                category_id: "",
                order_by: "id",
                order_type: "DESC",
                is_lock: "",
            };
            this.searchItem();
        },
        formatMoney(value) {
            return formatMoney(value);
        },
        linkChapers(story_id) {
            return `${FVN_LARAVEL_HOME}/admin/chapers/${story_id}`;
        },
        capitalizeFirstLetter(string) {
            const words = string.split(" ");
            for (let i = 0; i < words.length; i++) {
                words[i] = words[i][0].toUpperCase() + words[i].substr(1);
            }
            string = words.join(" ");
            return string;
        },
        // ===========================Chức năng thêm người dùng được đọc bộ truyện================================
        async toggleLockStory(e, item) {
            this.itemDetail = item;
            if (this.itemDetail.is_lock == 1) {
                this.itemDetail.is_lock = 2;
            } else {
                this.itemDetail.is_lock = 1;
            }
            await this.save(e);
        },
        async showCoppyrightUser(item) {
            this.querySearchUser.story_id = item.id
            this.itemDetail = item;
            await this.getCoppyrightItems();
            await this.getCoppyrightPaging();
            this.screen = "role";
        },
        async searchUser(newKey) {
            if (newKey.length >= 3) {
                this.loadingSearchUser = true;
                this.searchUserItems = [];
                if (this.pointInTime) {
                    clearTimeout(this.pointInTime);
                }
                this.pointInTime = setTimeout(async () => {
                    let jsonData = await new RouteApi().get(
                        `${FVN_LARAVEL_HOME}/admin/users/get-items?keyword=${newKey}&per_page=5`
                    );
                    this.searchUserItems = jsonData.data;
                    this.loadingSearchUser = false;
                }, 300);
            }
        },
        async handleCoppyrightUser(user, action) {
            this.loading = true;
            let jsonData = await new RouteApi().post(
                `${this.apiUrl}/handle-coppyright-stories`,
                {
                    user_id: user.id,
                    story_id: this.itemDetail.id,
                    action: action,
                }
            );
            this.loading = false;
            if (jsonData.status) {
                jnotice(jsonData.message);
                if (action == 'add') {
                    this.userItems.unshift(user);
                }
                if (action == 'remove') {
                    await this.getCoppyrightItems();
                }
           
            } else {
                jAlert(jsonData.message);
            }
        },
        async getCoppyrightItems() {
            this.loading = true;
            this.buildQueryCoppyrightItem();
            // Lưu trạng thái url cuối cùng trước khi chuyển trang
          
            const jsonData = await new RouteApi().get(this.getItemUrl);
            this.loading = false;
            if (jsonData.result) {
                this.userItems = jsonData.data;
                
            } else {
                this.userItems = [];
                // jAlert(jsonData.message);
            }
        },
        async getCoppyrightPaging() {
            this.buildQueryCoppyrightItem(true);
            let jsonData = await new RouteApi().get(this.getItemUrl);
            this.querySearchUser.total = jsonData.total;
        },
        buildQueryCoppyrightItem(task) {
           
            if (task == "export") {
                this.getItemUrl = this.apiUrl + ".export";
            } else if (task) {
                this.getItemUrl = this.apiUrl + "/get-coppyright-story-items?is_paginate=1";
            } else {
                this.getItemUrl = this.apiUrl + "/get-coppyright-story-items?is_paginate=";
            }
            for (const i in this.querySearchUser) {
                let value = this.querySearchUser[i];
                if (value) {
                    if (i == "book_date_min" || i == "book_date_max") {
                        value = format_date(value);
                    }
                    this.getItemUrl += "&" + i + "=" + value;
                }
            }
        },
         nextCoppyrightPage(page) {
            this.querySearchUser.page = page;
            this.getCoppyrightItems();
        },
        changeCoppyrightLimit(per_page) {
            this.querySearchUser.per_page = parseInt(per_page);
            this.querySearchUser.page = 1;
            this.getCoppyrightItems();
            this.getCoppyrightPaging();
        },
    },
    watch: {
        "itemDetail.title"(newVal) {
            if (newVal) {
                this.itemDetail.slug = fvnChangeToSlug(newVal);
            }
        },
        selectedCat(newVal) {
            this.itemDetail.category = [];
            for (let i = 0; i < newVal.length; i++) {
                this.itemDetail.category.push(newVal[i].id);
            }
        },
        selectedAuthor(newVal) {
            this.itemDetail.author_id = newVal.id;
        },
        checkAll(newVal) {
            if (newVal) {
                this.listId = this.items.map((item) => item.id);
            } else {
                this.listId = [];
            }
        },
        keySearhUser(newVal) {
            this.searchUser(newVal);
        },
    },
});
