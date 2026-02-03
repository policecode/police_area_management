var vue_data = {
    loaded: false,
    loading: false,
    currentAction: '',
    getItemUrl: '',
    items: [],
    screen: 'list',
    itemDetail: { },
    files: {},
    listId: [],
    errors: {},
    queryToDate: '',
    queryFromDate: '',
    querySearch: {
        total: 0,
        page: 1,
        per_page: 20,
        keyword: '',
        parent_id: '0',
        story: '',
        user: '',
        order_by: 'id',
        order_type: 'DESC'
    },
    apiUrl: FVN_LARAVEL_HOME + '/admin/star-ratings',
    stories: [],
    users: [],
    multiselect: {
        story: null,
        user: null,
    },
    pointInTime: null,

};
// Vue.component('autocomplete', VueBootstrapTypeahead);
// Vue.component('datepicker', vuejsDatepicker);
Vue.component('multiselect', window.VueMultiselect.default);
// Vue.component('star-rating', VueStarRating.default);
var app = new Vue({
    el: '#app',
    data: vue_data,
    mounted: function () {
        this.loaded = true;
        this.updateQueryFromUrl();
        this.searchItem();
    },
    computed: {
    },
    methods: {
        convertStringAfterTime(after_minutes) {
                 return getStringAfterTime(after_minutes, 'vi');
             },
        updateQueryFromUrl() {
            if (window.location.hash) {
                let querySearch = queryToObject(window.location.hash.substring(1));
                console.log(window.location.hash.substring(1), querySearch);
                for (key in querySearch) {
                    this.querySearch[key] = querySearch[key];
                }
            }
        },
        changeScreen(scr) {
            this.screen = scr;
        },
        showItem(item) {
            this.itemDetail = item;
            this.screen = 'comment_childs';
        },
        closeItem() {
            this.itemDetail = { };
            this.errors = {};
            this.screen = 'list';
        },
        async deleteItem(item) {
            if (confirm(`Do you want to delete the Star Rating: ${item.name}`)) {
                let jsonData = await new RouteApi().delete(`${this.apiUrl}/${item.id}`, {});
                if (jsonData.status) {
                    jnotice(jsonData.message);
                    this.getItems();
                } else {
                    jAlert(jsonData.message);
                }
            }
        },
        searchItem() {
            this.getItems();
            this.getPaging();
        },
        async getItems() {
            this.loading = true;
            this.buildQueryItem();
            const jsonData = await new RouteApi().get(this.getItemUrl)
            this.loading = false;
            // console.log(jsonData);
            
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
            this.screen = 'Item_detail';
            this.itemDetail = item;
        },
        doAction() {
            if (!this.currentAction) {
                return jAlert('Please choose an action');
            }
            return this[this.currentAction]();
        },
        async save(e) {
            this.loading = true;
            let jsonData;
            if (this.itemDetail.id) {
                jsonData = await new RouteApi().put(`${this.apiUrl}/${this.itemDetail.id}`,this.itemDetail )
            } else {
                jsonData = await new RouteApi().post(`${this.apiUrl}`,this.itemDetail );
            }
            this.loading = false;
            
            if (jsonData.status) {
                jnotice(jsonData.message);
                this.itemDetail = jsonData.data;
                let flag = true;
                for (i in this.items) {
                    if (this.items[i].id == this.itemDetail.id) {
                        flag = false;
                        this.items[i] = this.itemDetail;
                        break;
                    }
                }
                if (flag) {
                    this.items.unshift(jsonData.data)
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
                    return format_date(date, 'Y-m-d h:i:s', true)
                } else {
                    return format_date(date)
                }
            }
        },
        updateOrdering(key) {
            if (this.querySearch.order_by != key) {
                this.querySearch.order_type = 'DESC';
            } else {
                if (this.querySearch.order_type == 'ASC') {
                    this.querySearch.order_type = 'DESC';
                } else {
                    this.querySearch.order_type = 'ASC';
                }
            }
            this.querySearch.order_by = key;
            this.getItems();
        },
        displayOrdering(key) {
            if (this.querySearch.order_by == key) {
                if (this.querySearch.order_type == 'ASC') {
                    return `<span class="ml-1">&#8593;</span>`;
                } else {
                    return `<span class="ml-1">&#8595;</span>`;
                }
            }
            return '';
        },
        buildQueryItem(task, changeUrl) {
            if (changeUrl == undefined) {
                changeUrl = true;
            }
            if (task == 'export') {
                this.getItemUrl = this.apiUrl + '.export';
            } else if (task) {
                this.getItemUrl = this.apiUrl + '/get-items?is_paginate=1';
            } else {
                this.getItemUrl = this.apiUrl + '/get-items?is_paginate=';
            }
            let paramSearch = {};
            for (const i in this.querySearch) {
                let value = this.querySearch[i];
                if (i == 'book_date_min' || i == 'book_date_max') {
                    value = format_date(value);
                }
                if (value) {
                    paramSearch[i] = value
                    this.getItemUrl += '&' + i + '=' + value;
                }
            }

            paramSearch['order_by'] = this.querySearch.order_by
            paramSearch['order_type'] = this.querySearch.order_type
            paramSearch['per_page'] = this.querySearch.per_page;
            paramSearch['page'] = this.querySearch.page;
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
                keyword: '',
                parent_id: '0',
                story: '',
                user: '',
                order_by: 'id',
                order_type: 'DESC'
            };
            this.searchItem();
        },
        async getStories(newKey) {
            if (this.pointInTime) {
                clearTimeout(this.pointInTime);
            }
            this.pointInTime = setTimeout(async () => {
                let jsonData = await new RouteApi().get(
                    `${FVN_LARAVEL_HOME}/admin/stories/get-items?keyword=${newKey}&per_page=5`
                );
                this.stories = jsonData.data;
                // console.log(this.stories);
                
            }, 300);
        },
        async getUsers(newKey) {
            if (this.pointInTime) {
                clearTimeout(this.pointInTime);
            }
            this.pointInTime = setTimeout(async () => {
                let jsonData = await new RouteApi().get(
                    `${FVN_LARAVEL_HOME}/admin/users/get-items?keyword=${newKey}&per_page=5`
                );
                this.users = jsonData.data;
                // console.log(this.users);
                
            }, 300);
        },

    },
    watch: {
        'multiselect.story': function (newVal) {
            if (newVal) {
                this.querySearch.story = newVal.id;
            } else {
                this.querySearch.story = '';
            }
        },
        'multiselect.user': function (newVal) {
            if (newVal) {
                this.querySearch.user = newVal.id;
            } else {
                this.querySearch.user = '';
            }
        },
    }
});