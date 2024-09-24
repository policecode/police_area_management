var vue_data = {
    loaded: false,
    loading: false,
    currentAction: '',
    getItemUrl: '',
    items: [],
    screen: 'detail',
    itemDetail: {},
    queryToDate: '',
    queryFromDate: '',
    querySearch: {
        total: 0,
        page: 1,
        per_page: 20,
        keyword: '',
        order_by: 'id',
        order_type: 'DESC'
    },
    queryUser: {
        id: '',
        name: ''
    },
    token: '',
    searchUserList: [],
    searchUserQuery: '',
    apiUrl: FVN_LARAVEL_HOME + '/admin/users',
    listId: [],
    dialogSelectSeat: false,
    setting: {
        fields: {}
    },
    itemSeats: [],
    itemDetailTime: [],
    dialogSelectSeat: false
};
// Vue.component('autocomplete', VueBootstrapTypeahead);
// Vue.component('datepicker', vuejsDatepicker);
// Vue.component('multiselect', window.VueMultiselect.default);
// Vue.component('star-rating', VueStarRating.default);
var app = new Vue({
    el: '#app',
    data: vue_data,
    mounted: function () {
        // this.loaded = true;
        this.updateQueryFromUrl();
        this.searchItem();
    },
    computed: {
    },
    methods: {
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
            this.screen = 'detail';
        },
        deleteItem(item) {
            if (confirm('Do you want to delete the Item')) {
                new RouteApi().post(this.apiUrl + '?task=delete', { id: this.listId }).then(function (jsonData) {
                    jAlert(jsonData.message);
                    app.getItems();
                });
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
            
            if (jsonData.result) {
                this.items = jsonData.data;
                if (this.itemDetail.id) {
                    for (i in this.items) {
                        if (this.items[i].id == this.itemDetail.id) {
                            this.itemDetail = this.items[i];
                            break;
                        }
                    }
                } else {
                    if (this.items.length > 0) {
                        this.itemDetail = this.items[0];
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
        async save() {
            const jsonData = await new RouteApi().post(this.apiUrl + '.save', { data: this.itemDetail })
            if (jsonData.result) {
                jnotice(jsonData.message);
                for (const i in this.items) {
                    if (this.items[i].id == this.itemDetail.id) {
                        this.items[i] = this.itemDetail;
                    }
                }
            } else {
                let msg = '';
                if (jsonData.hasOwnProperty('errors')) {
                    for (key in jsonData.errors) {
                        msg += jsonData.errors[key][0] + '<br>';
                    }
                } else {
                    msg = jsonData.message;
                }
                jAlert(msg);
            }
        },

  
        removeSlot(index) {
            if (confirm('Xóa slot?')) {
                this.loading = true;
                new RouteApi().post(this.apiUrl + '.delete', { id: this.itemDetail.seats[index].id }).then(function (jsonData) {
                    app.loading = false;
                    if (jsonData.result) {
                        app.itemDetail.seats.splice(index, 1);
                    } else {
                        jAlert(jsonData.message);
                    }
                });
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
                paramSearch[i] = value
                this.getItemUrl += '&' + i + '=' + value;
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
        selectUser(item) {
            this.queryUser.id = item.ID;
            this.queryUser.name = item.user_nicename + ' ' + item.user_email;
        },
        clearFilter() {
            this.querySearch = {
                total: 0,
                page: 1,
                per_page: 20,
                keyword: '',
                book_date_min: '',
                book_date_max: '',
                book_time: '',
                order_by: 'id',
                order_type: 'DESC'
            };
            this.searchItem();
        },
        formatMoney(value) {
            return formatMoney(value);
        },
        async allowDisplayLevel(item, flg) {
            const jsonData = await new RouteApi().post(this.apiUrl + '.save', {
                data: {
                    id: item.id,
                    is_show_player_level: flg
                }
            })
            if (jsonData.result) {
                jnotice(jsonData.message);
                for (const i in this.items) {
                    if (this.items[i].id == item.id) {
                        this.items[i].is_show_player_level = flg;
                    }
                }
            } else {
                jAlert(jsonData.message);
            }
        },
        async updateOrderStatus(item) {
            const jsonData = await new RouteApi().post(this.apiUrl + '.save', {
                data: {
                    id: item.id,
                    order_status: item.order_status
                }
            })
            if (jsonData.result) {
                jnotice(jsonData.message);
            } else {
                this.searchItem();
                jnotice(msg);
            }
        },
        async updatePaymentStatus(item) {
            const jsonData = await new RouteApi().post(this.apiUrl + '.save', {
                data: {
                    id: item.id,
                    pay_status: item.pay_status
                }
            })
            if (jsonData.result) {
                jnotice(jsonData.message);
            } else {
                app.searchItem();
                jnotice(msg);
            }
        },
    },
    watch: {
        searchUserQuery(newQuery) {
            console.log(newQuery);

            if (newQuery == '') {
                this.queryUser.id = '';
                this.queryUser.name = '';
                return;
            }
            // fetch(fvnUrl + 'includes/admin/user/action.php?task=getUserByName&keyword=' + newQuery, {
            // 	method: 'get'
            // })
            new RouteApi().get(FVN_PLUGIN_URL + 'ajax.php?task=account.account.index',
                { keyword: newQuery }
            ).then((response) => {
                return response.json()
            })
                .then((jsonData) => {
                    this.searchUserList = jsonData.data;
                });
        },
        selectedStatus(value) {
            if (value) {
                this.querySearch.filter_order_status = value.value;
            } else {
                this.querySearch.filter_order_status = '';
            }
        },

    },
});