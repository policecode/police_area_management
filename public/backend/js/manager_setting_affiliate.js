var vue_data = {
    loading: false,
    currentAction: '',
    getItemUrl: '',
    items: [],
    screen: 'list',
    itemDetail: options,
    files: {},
    images: {
        fvn_shortcut_icon: "",
        fvn_logo: ""
    },
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
    apiUrl: FVN_LARAVEL_HOME + '/admin/settings',
    pointInTime: null
};
// Vue.component('autocomplete', VueBootstrapTypeahead);
// Vue.component('datepicker', vuejsDatepicker);
// Vue.component('multiselect', window.VueMultiselect.default);
// Vue.component('star-rating', VueStarRating.default);
var app = new Vue({
    el: '#app',
    data: vue_data,
    mounted: function () {
    },
    computed: {
    },
    methods: {
        async testUpload() {
            var data = new FormData();
            // this.itemDetail.wp_meta.birthday = this.dateFormatCurrent(this.itemDetail.wp_meta.birthday);
            // for (let i in this.itemDetail) {
            //     if ((Array.isArray(this.itemDetail[i]) || (typeof this.itemDetail[i] == 'object')) &&
            //         (i != 'avatar') && (i != 'resume_file')) {
            //         let arrayGrade_1 = this.itemDetail[i];
            //         for (const key in arrayGrade_1) {
            //             if (Array.isArray(arrayGrade_1[key]) || (typeof arrayGrade_1[key] == 'object')) {
            //                 let arrayGrade_2 = arrayGrade_1[key];
            //                 for (const key_1 in arrayGrade_2) {
            //                     data.append(i + '[' + key + '][' + key_1 + ']', arrayGrade_2[key_1]);
            //                 }
            //             } else {
            //                 data.append(i + '[' + key + ']', arrayGrade_1[key]);
            //             }
            //         }
            //     } else {
            //         if (this.itemDetail[i]) {
            //             data.append(i, this.itemDetail[i]);
            //         }
            //     }
            // }
            
            data.append('thumbnail', this.files.thumbnail);
            let jsonData = await new RouteApi().post(`${FVN_LARAVEL_HOME}/api/manager/stories/tool-upload-story`,data, 'form' );
            console.log(jsonData);
            
        },

        changeScreen(scr) {
            this.screen = scr;
        },

        async uploadFile(e, name) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length) return;
            
            let reader = new FileReader();
            if (name == 'fvn_shortcut_icon') {
                this.files.fvn_shortcut_icon = files[0];
                
                await reader.readAsDataURL(files[0]);
                reader.onload = function() {
                    // console.log(reader.result);
                    app.images.fvn_shortcut_icon = reader.result;

                }
                
            }
            if (name == 'fvn_logo') {
                this.files.fvn_logo = files[0];
                
                await reader.readAsDataURL(files[0]);
                reader.onload = function() {
                    // console.log(reader.result);
                    app.images.fvn_logo = reader.result;
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
        async save(e, router) {
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
            for (let key in this.files) {
                data.append(key, this.files[key]);
            }
     
            this.loading = true;
            let jsonData;
        
            jsonData = await new RouteApi().post(`${this.apiUrl}/${router}`,data, 'form' );
            this.loading = false;
            
            if (jsonData.status) {
                jnotice(jsonData.message);
             
            } else {
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


        formatMoney(value) {
            return formatMoney(value);
        },
        getUrlUmages(path) {
            return `${FVN_LARAVEL_HOME}/${path}`;
        }
    },
    watch: {

   
    },
});