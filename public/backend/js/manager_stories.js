var vue_data = {
    loaded: false,
    loading: false,
    currentAction: '',
    getItemUrl: '',
    items: [],
    screen: 'list',
    itemDetail: {
        thumbnail: "",
        status: "",
        category: []
    },
    selectedCat: [],
    selectedAuthor: null,
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
        order_by: 'id',
        order_type: 'DESC'
    },
    apiUrl: FVN_LARAVEL_HOME + '/admin/stories',
    statusStory: statusStory,
    categories: [],
    authors: [],
    pointInTime: null
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
        this.getCategories();
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
        async showItem(item) {
            // console.log(item);
            
            // Selected Author
            let jsonData = await new RouteApi().get(`${FVN_LARAVEL_HOME}/admin/author/${item.author_id}`);
            console.log(jsonData);
            
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
            this.screen = 'detail';
        },
        closeItem() {
            this.itemDetail = {
                thumbnail: "",
                status: "",
                category: []
            };
            this.selectedCat = [];
            this.errors = {};
            this.screen = 'list';
        },
        async deleteItem(item) {
            if (confirm(`Do you want to delete the Story: ${item.title}`)) {
                let jsonData = await new RouteApi().delete(`${this.apiUrl}/${item.id}`, {});
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
                if (this.querySearch.order_type == 'DESC') {
                    this.querySearch.order_type = 'ASC';
                } else {
                    this.querySearch.order_type = 'DESC';
                }
            } else {
                this.querySearch.order_by = name;
                this.querySearch.order_type = 'DESC';
            }
            this.searchItem();
        },
        isOrder(name, type) {
            if (this.querySearch.order_by == name && this.querySearch.order_type == type) {
                return true;
            } 
            return false;
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
            let jsonData = await new RouteApi().get(`${FVN_LARAVEL_HOME}/admin/category/get-items?per_page=0`);
            this.categories = jsonData.data;
        },
        async getAuthors(newKey) {
            if (this.pointInTime) {
                clearTimeout(this.pointInTime);
            }
            this.pointInTime = setTimeout(async () => {
                let jsonData = await new RouteApi().get(`${FVN_LARAVEL_HOME}/admin/author/get-items?keyword=${newKey}&per_page=5`);
                this.authors = jsonData.data;
            }, 300)
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
        async uploadFile(e, name) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length) return;
            
            let reader = new FileReader();
            if (name == 'thumbnail') {
                this.files.thumbnail = files[0];
                
                await reader.readAsDataURL(files[0]);
                reader.onload = function() {
                    // console.log(reader.result);
                    app.itemDetail.thumbnail = reader.result;
                }
                
            }
            // if (name == 'resume') {
            //     if (!(files[0].size < 5 * 1024 * 1024)) {
            //         e.target.value = '';
            //         return jAlert('File size less than 5MB');
            //     }
            //     appCandidateList.itemDetail.resume_file = files[0];
            // }
        },
        async save(e) {
            e.preventDefault()
            var data = new FormData();
            
            for (let i in this.itemDetail) {
                if ((Array.isArray(this.itemDetail[i]) || (typeof this.itemDetail[i] == 'object'))) {
                    let valueObj = this.itemDetail[i];
                    for (const key in valueObj) {
                        data.append(i + '[' + key + ']', valueObj[key]);
                    }
                } else {
                    if (this.itemDetail[i]) {
                        data.append(i, this.itemDetail[i]);
                    }
                }
            }
            if (this.files.thumbnail) {
                data.append('thumbnail', this.files.thumbnail);
            }
            this.loading = true;
            let jsonData;
            if (this.itemDetail.id) {
                jsonData = await new RouteApi().post(`${this.apiUrl}/update/${this.itemDetail.id}`,data, 'form' )
            } else {
                jsonData = await new RouteApi().post(`${this.apiUrl}`,data, 'form' );
            }
            this.loading = false;
            
            if (jsonData.status) {
                jnotice(jsonData.message);
                if (this.itemDetail.id) {
                    this.itemDetail = jsonData.data;
                } else {
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
        clearFilter() {
            this.querySearch = {
                total: 0,
                page: 1,
                per_page: 20,
                keyword: '',
                order_by: 'id',
                order_type: 'DESC'
            };
            this.searchItem();
        },
        formatMoney(value) {
            return formatMoney(value);
        },
        linkChapers(story_id) {
            return `${FVN_LARAVEL_HOME}/admin/chapers/${story_id}`;
        }
    },
    watch: {
        'itemDetail.title' (newVal) {
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
        }
    },
});