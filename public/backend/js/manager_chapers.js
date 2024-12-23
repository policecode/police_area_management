var vue_data = {
    loaded: false,
    loading: false,
    currentAction: '',
    getItemUrl: '',
    items: [],
    screen: 'list',
    itemDetail: { 
        content: ""
    },
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
        order_by: 'position',
        order_type: 'DESC',
        story_id: story.id
    },
    apiUrl: FVN_LARAVEL_HOME + '/admin/chapers',
    story: story,
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
    },
    computed: {
        countContent() {
            str1 = this.itemDetail.content.replace(/(^\s*)|(\s*$)/gi,"");
            //convert 2 or more spaces to 1  
            str1 = str1.replace(/[ ]{2,}/gi," ");
            // exclude newline with a start spacing  
            str1 = str1.replace(/\n /,"\n");
		    return str1.split(' ').length;
        }
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
            this.itemDetail = item;
            this.screen = 'detail';
        },
        closeItem() {
            this.itemDetail = {
                content: ""
            };
            this.errors = {};
            this.screen = 'list';
        },
        async deleteItem(item) {
            if (confirm(`Do you want to delete the Chapter: ${item.name}`)) {
                let jsonData = await new RouteApi().delete(`${this.apiUrl}/${this.story.id}/${item.id}`, {});
                jnotice(jsonData.message);
                this.getItems();
            }
        },
        async deleteAllItem() {
            if (confirm(`Do you want to delete All Chapter`)) {
                let jsonData = await new RouteApi().delete(`${this.apiUrl}/${this.story.id}`, {});
                jnotice(jsonData.message);
                this.getItems();
            }
        },
        searchItem() {
            this.getItems();
            this.getPaging();
        },
        async getItems() {
            this.loading = true;
            this.buildQueryItem();
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
            this.loading = true;
            let jsonData;
            if (this.itemDetail.id) {
                jsonData = await new RouteApi().put(`${this.apiUrl}/${this.story.id}/${this.itemDetail.id}`,this.itemDetail )
            } else {
                jsonData = await new RouteApi().post(`${this.apiUrl}/${this.story.id}`,this.itemDetail );
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

    },
    watch: {
        'itemDetail.name' (newVal) {
            if (newVal) {
                this.itemDetail.slug = fvnChangeToSlug(newVal);
            }
        },
      
    },
});