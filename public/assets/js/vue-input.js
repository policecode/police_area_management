Vue.component('fvn-select', {
    props: ['options', 'blankLabel', 'value', 'keyValue', 'keyLabel', 'error', 'multiple', 'radio', 'name'],
    data: function () {
        let valueCom = this.value;

        if (!valueCom) {
            if (this.multiple) {
                valueCom = [];
            } else {
                valueCom = '';
            }
        }
        return {
            valueCom: valueCom
        }
    },
    mounted: function () {
        // console.log(this.value);
    },
    computed: {
        comKeyValue() {
            if (!this.keyValue) {
                return 'value';
            }
            return this.keyValue;
        },
        comKeyLabel() {
            if (!this.keyLabel) {
                return 'display';
            }
            return this.keyLabel;
        }
    },
    methods: {
        __(text) {
            return __(text)
        },
        handleChange(e) {
            this.$emit('input', this.valueCom)
        },
    },
    template: `<div class="fvn-input">
    <template v-if="radio">
        <span v-for="item in options" class="fvn-input-radio">
        <input type="radio" v-model="valueCom" :name="name" :value="item[comKeyValue]" @change="handleChange"/> {{__(item[comKeyLabel])}}
        </span>
    </template>
    <template v-else>
        <select v-model="valueCom" @change="handleChange" :multiple="multiple">
            <option v-if="blankLabel" value="">{{blankLabel}}</option>
            <option v-for="item in options" :value="item[comKeyValue]">{{__(item[comKeyLabel])}}</option>
        </select>
    </template>
    <div v-if="error" class="text-danger input-error">
            <p v-for="err in error">{{err}}</p>
    </div>
    </div>`
});

Vue.component('fvn-input', {
    props: ['value', 'type', 'error', 'name', 'download', 'multiple', 'remote', 'dir'],
    data: function () {
        let valueCom = this.value;
        if (!valueCom) {
            if (this.multiple) {
                valueCom = [];
            } else {
                valueCom = '';
            }
        }
        return {
            valueCom: valueCom,
            uploadFile: this.multiple ? [] : false,
            deleteConfirm: false,
            loading: false
        }
    },
    mounted: function () {

    },
    computed: {
    },
    methods: {
        handleChange(e) {
            this.$emit('input', this.valueCom)
        },
        async newFile(e) {
            let files = e.target.files || e.dataTransfer.files;

            if (!files.length)
                return;
            let file = '';
            if (this.multiple) {
                for (file of files) {
                    if (this.remote) {
                        file = await this.uploadFileRemote(file);
                        if (!file) {
                            return;
                        }
                    }
                    this.valueCom.push(file);
                    this.uploadFile.push(file);
                }
            } else {
                if (this.remote) {
                    file = await this.uploadFileRemote(files[0]);
                    if (file) {
                        this.valueCom = file;
                    }
                } else {
                    this.valueCom = files[0];
                    this.uploadFile = files[0];
                }
            }
            if (this.remote) {
                return this.$emit('input', this.valueCom);
            }
            this.$emit('input', this.uploadFile);
        },
        async uploadFileRemote(file) {
            this.loading = true;
            var data = new FormData();
            data.append('file', file);
            if (this.dir) {
                data.append['dir', this.dir];
            }

            let jsonData = await new RouteApi().post(FVN_PLUGIN_URL + 'ajax.php?task=core.file.upload', data, 'form');
            this.loading = false;
            if (jsonData.status) {
                return jsonData.data;
            } else {
                jAlert(jsonData.message);
            }
        },
        async handleDelete(index) {
            if (this.remote) {
                if (confirm(__('Do you want to delete this file?'))) {
                    let deleteFile = this.valueCom;
                    if (this.multiple) {
                        deleteFile = this.valueCom[index];
                    }
                    let jsonData = await new RouteApi().post(FVN_PLUGIN_URL + 'ajax.php?task=core.file.delete', { file: deleteFile });

                    if (jsonData.status) {
                        if (this.multiple) {
                            this.valueCom.splice(index, 1);
                        } else {
                            this.valueCom = '';
                        }

                        return this.$emit('input', this.valueCom);
                    } else {
                        jAlert(jsonData.message);
                    }
                }
            } else {
                if (this.multiple) {
                    this.valueCom.splice(index, 1);
                } else {
                    this.valueCom = '';
                }

                return this.$emit('input', this.valueCom);
            }

        }
    },
    template: `<div class="fvn-input">
    <div v-if="loading" class="loading"></div>
    <div v-if="type=='note'">{{value}}</div>
    <div v-if="type=='upload'" class="upload-file">
        <div class="d-flex justify-content-between align-items-start">
            <div v-if="multiple" class="w-100">
                <div v-for="(item,index) in valueCom" class="d-flex justify-content-between w-100">
                    <fvn-document :src="item" class="mr-2" :download="download"></fvn-document>
                    <a href="javascript:void(0)" @click="handleDelete(index)">X</a>
                </div>
            </div>
            <div v-else class="w-100 d-flex justify-content-between">
                <fvn-document :src="valueCom" class="mr-2" :download="download"></fvn-document>
				<a v-if="valueCom" href="javascript:void(0)" @click="handleDelete()">X</a>
            </div>
        </div>
        <div><input type="file" @change="newFile" :multiple="multiple"/></div>
    </div>
    <input v-if="type!='note' && type!='upload' && type!='textarea'" :type="type?type:'text'" :name="name" v-model="valueCom" @change="handleChange" />
	<textarea v-if="type=='textarea'" :name="name" v-model="valueCom" @change="handleChange" class="w-100" rows="5"></textarea>
    <div v-if="error" class="text-danger input-error">
        <p v-for="err in error">{{err}}</p>
    </div>
    </div>`
});

Vue.component('fvn-input-layout', {
    props: ['label'],
    data: function () {
        return {
        }
    },
    mounted: function () {
    },
    computed: {
    },
    methods: {
    },
    template: `<div class="fvn-input-layout row row-small">
        <div class="label col medium-3 strong">{{label}}</div>
        <div class="input col medium-9"><slot></slot></div>
    </div>`
});

Vue.component('fvn-input-group', {
    props: ['value', 'type', 'error', 'label', 'download', 'multiple', 'remote', 'dir'],
    data: function () {
        return {
            valueCom: this.value
        }
    },
    mounted: function () {
    },
    computed: {
    },
    methods: {
    },
    watch: {
        valueCom() {
            this.$emit('input', this.valueCom)
        }
    },
    template: `<fvn-input-layout :label="label">
    <fvn-input v-model="valueCom" :remote="remote" :dir="dir" :error="error" :type="type" :download="download" :multiple="multiple" @delete="(item) => $emit('delete',item)"></fvn-input>
    </fvn-input-layout>`
});

Vue.component('fvn-select-group', {
    props: ['value', 'error', 'label', 'options', 'blankLabel', 'keyValue', 'keyLabel', 'multiple', 'type', 'radio', 'name'],
    data: function () {
        return {
            valueCom: this.value
        }
    },
    mounted: function () {
    },
    computed: {
    },
    methods: {
        handleChange(e) {
            this.$emit('input', this.valueCom)
        }
    },
    template: `<fvn-input-layout :label="label">
    <fvn-enum v-if="type=='note'" :selected="value" :options="options"></fvn-enum>
    <fvn-select v-if="type!='note'" v-model="valueCom" @change.native="handleChange" :error="error" :options="options" :blank-label="blankLabel" :key-value="keyValue" :key-label="keyLabel" :multiple="multiple" :radio="radio" :name="name"></fvn-select>
    </fvn-input-layout>`
});

Vue.component('fvn-enum', {
    props: ['options', 'selected'],
    data: function () {
        return {
        }
    },
    computed: {
        display() {
            for (item of this.options) {
                if (item.value == this.selected) {
                    return __(item.display);
                }
            }
        },
    },
    template: `<span>{{display}}</span>`
});

Vue.component('fvn-date', {
    props: ['date', 'format'],
    data: function () {
        return {
        }
    },
    computed: {
        display() {
            if (!this.date) { return ''; }
            let format = this.format;
            if (!format) {
                format = 'Y-m-d';
            }
            return format_date(this.date, format, true)
        },
    },
    template: `<span>{{display}}</span>`
});

Vue.component('fvn-money', {
    props: ['amount', 'currency'],
    data: function () {
        return {
        }
    },
    computed: {
        display() {
            if (!this.amount) { return ''; }
            let currency = this.currency;
            if (!currency) {
                currency = '$';
            }
            return currency + this.amount;
        },
    },
    template: `<span>{{display}}</span>`
});

Vue.component('fvn-avatar', {
    props: ['src'],
    data: function () {
        return {
        }
    },
    computed: {
        display() {
            if (!this.src) { return '<svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8 8C10.21 8 12 6.21 12 4C12 1.79 10.21 0 8 0C5.79 0 4 1.79 4 4C4 6.21 5.79 8 8 8ZM8 10C5.33 10 0 11.34 0 14V16H16V14C16 11.34 10.67 10 8 10Z" fill="#1B1D1F"></path></svg>'; }
            return siteUrl + this.src;
        },
    },
    template: `<span class="fvn-avatar">
    <img v-if="src" :src="display"/>
    <span v-else v-html="display" class="none-avatar w-100"></span>
    </span>`
});

Vue.component('fvn-document', {
    props: ['src', 'download'],
    data: function () {
        return {
            pluginUrl: FVN_PLUGIN_URL
        }
    },
    computed: {
        isFile() {
            if (typeof this.src == 'object') {
                return true;
            }
            return false;
        },
        isImage() {
            if (typeof this.src == 'object') {
                return false;
            }
            if (this.src) {
                return this.src.match(/\.(jpg|jpeg|png|gif|webp|svg)$/i);
            }
            return false;
        },
        url() {
            if (this.src && !this.isFile) {
                if (this.src.includes('http://') || this.src.includes('https://')) {
                    return this.src;
                }
                return siteUrl + '/' + this.src;
            }
            return false;
        },
        display() {
            if (this.url) {
                if (this.url.includes("https://docs.google.com")) {
                    return this.url;
                }
                if (this.isImage) {
                    return this.url;
                } else {
                    return "https://docs.google.com/viewerng/viewer?embedded=true&url=" + this.url;
                }
            }
            return "";
        },
    },
    template: `<span v-if="src" class="fvn-document position-relative">
    <img v-if="isImage" :src="display" style="width:100%"/>
    <span v-if="isFile" style="width:100%">{{src.name}}</span>
    <iframe v-if="!isImage && !isFile" :src="display" title="document" style="width:100%"></iframe>
    <div v-if="!isFile" class="position-absolute bottom-0 right-0 d-flex">
        <a :href="display" title="open in new tab"><img :src="pluginUrl+'assets/images/eye.svg'" class="icon-size-s" /></a>
        <a v-if="download" target="_blank" :href="url" title="download"><img :src="pluginUrl+'assets/images/download.svg'" class="icon-size-s"/></a>
    </div>
    </span>`
});

Vue.component('fvn-popup', {
    props: ['title', 'type', 'fullScreen'],
    data: function () {
        return {
        }
    },
    template: `<div class="fvn-overlay" :class="{'full-screen':fullScreen}">
    <div class="fvn-popup position-relative">
      <h2>{{title}}</h2>
      <div class="content " style="">
        <div class="container">
            <slot name="content"></slot>
        </div>        
      </div>
      <div class="control-button d-flex justify-content-center gap-s">
          <slot name="footer"></slot>
        </div>
    </div>
  </div>`
});

Vue.component('fvn-paging', {
    props: ['page', 'total', 'per_page', 'show_page'],
    data: function () {
        return {
            comPerPage: this.per_page,
            limitLabel: __('Rows per page'),
            showPage: this.show_page ? this.show_page : 2
        }
    },
    computed: {
        currentPage() {
            return this.per_page * this.page < this.total ? this.per_page * this.page : this.total
        },
        totalPage() {
            return Math.ceil(this.total / this.per_page)
        },
        isPrevBtn() {
            return this.page > 1;
        },
        isNextBtn() {
            return this.per_page * this.page < this.total;
        },
        listPage() {
            let beforePage = 0;
            let afterPage = 0;
            if (this.page - this.showPage >= 1) {
                beforePage = this.page - this.showPage;
            } else {
                beforePage = 1;
            }
            if (this.page + this.showPage <= this.totalPage) {
                afterPage = this.page + this.showPage;
            } else {
                afterPage = this.totalPage;
            }
            let listPage = [];
            for (let i = beforePage; i <= afterPage; i++) {
                listPage.push(i);
            }
            return listPage;
        }

    },
    method: {
    },
    template: `<div v-show="totalPage>1" class="dataTables_paginate paging_simple_numbers">
        <div class="d-flex align-items-center">
            <div class="mr-4">
                <span class="showing-status__pages text-nowrap">{{page}} – {{currentPage}}</span> of 
                <span class="showing-status__total">{{total}}</span>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <label class="flex-shrink-0 mr-2">{{limitLabel}}</label>
                <select class="form-control"  v-model="comPerPage" @change="$emit('change-limit',comPerPage)">
                     <option v-for="i in [10,20,30]" :value="i">{{i}}</option>
                </select>
            </div>
        </div>
        <ul class="pagination">
            <li class="paginate_button page-item previous" :class="{'disabled': !isPrevBtn}">
                <a v-if="isPrevBtn" @click="$emit('change-page', 1)" class="page-link cursor-pointer"><<</a>
                <a v-else class="page-link"><<</a>
            </li>
            <li class="paginate_button page-item previous" :class="{'disabled': !isPrevBtn}">
                <a v-if="isPrevBtn" @click="$emit('change-page', page - 1)" class="page-link cursor-pointer"><</a>
                <a v-else class="page-link"><</a>
            </li>
            <li v-for="item in listPage" class="paginate_button page-item" :class="{'active':item==page}">
                <a v-if="item==page" class="page-link">{{item}}</a>
                <a v-else @click="$emit('change-page', item)" class="page-link cursor-pointer">{{item}}</a>
            </li>
        
            <li class="paginate_button page-item next" :class="{'disabled': !isNextBtn}">
                <a v-if="isNextBtn" @click="$emit('change-page', page + 1)" class="page-link cursor-pointer">></a>
                <a v-else class="page-link">></a>
            </li>
            <li class="paginate_button page-item next" :class="{'disabled': !isNextBtn}">
                <a v-if="isNextBtn" @click="$emit('change-page', totalPage)" class="page-link cursor-pointer">>></a>
                <a v-else class="page-link">>></a>
            </li>
        </ul>
    </div>`
});

Vue.component('fvn-ordering', {
    props: ['label', 'orderBy', 'orderType', 'active'],
    data: function () {
        return {
        }
    },
    computed: {
        displayOrdering() {
            if (this.active == this.orderBy) {
                if (this.orderType == 'ASC') {
                    return `<span class="ml-1">&#8593;</span>`;
                } else {
                    return `<span class="ml-1">&#8595;</span>`;
                }
            }
            return '';
        }
    },
    template: `<a href="javascript:void(0)" class="d-flex fvn-ordering" @click="$emit('update-ordering',orderBy)" >{{label}}
    <span v-html="displayOrdering"></span>
    </a>`
});
Vue.component('fvn-repeat', {
    props: ['fields', 'value', 'multiple', 'error', 'remote', 'dir'],
    data: function () {
        let valueCom = this.value;
        if (this.multiple) {
            if (!valueCom || typeof valueCom == 'string') {
                valueCom = [];
            }
            if (valueCom.length == 0) {
                valueCom.push({});
            }
        } else {
            if (!valueCom || typeof valueCom == 'string') {
                valueCom = {};
            }
        }
        return {
            valueCom: valueCom
        }
    },
    methods: {
        addItem() {
            this.valueCom.push({});
        },
        removeItem(index) {
            this.valueCom.splice(index, 1);
            this.valueCom = [...this.valueCom];
        },
        handleChange() {
            this.$emit('input', this.valueCom);
        }
    },
    watch: {
        valueCom() {
            this.handleChange();
        }
    },
    template: `<div class="fvn-input repeat">
    <div v-if="multiple">
        <div v-for="(item, index) in value" :key="index" class="d-flex gap-s">
            <div class="w-100">
                <fvn-input-group v-for="(type,field) in fields" :remote="remote" :dir="dir" :type="type.type" v-model="valueCom[index][field]" :label="type.display" :key="field"></fvn-input-group>
            </div>
            <div class="d-flex align-items-center justify-content-end">
                <button v-if="multiple" @click="removeItem(index)" class="button small" >-</button>
            </div>
        </div>
        <button @click="addItem" class="button small">+</button>
    </div>
    <div v-else>
        <fvn-input-group v-for="(type,field) in fields" :type="type.type" :remote="remote" :dir="dir" v-model="valueCom[field]" :label="type.display" :key="field"></fvn-input-group>
    </div>
    <div v-if="error" class="text-danger input-error">
            <p v-for="err in error">{{err}}</p>
    </div>
    
  </div>`
});

Vue.component('fvn-repeat-group', {
    props: ['fields', 'value', 'multiple', 'error', 'label', 'remote', 'dir'],
    data: function () {
        return {
            valueCom: this.value
        }
    },
    computed: {
    },
    template: `<fvn-input-layout :label="label">
    <fvn-repeat v-model="valueCom" @change.native="$emit('input',valueCom)" :fields="fields" :multiple="multiple" :error="error" :remote="remote" :dir="dir" ></fvn-repeat>
    </fvn-input-layout>`
});

Vue.component('fvn-html', {
    props: ['value'],
    data: function () {
        return {};
    },
    computed: {
        valueCom() {
            let valueCom = this.value;
            if (!valueCom) {
                valueCom = '';
            }
            valueCom = valueCom.replace(/(?:\r\n|\r|\n)/g, '<br>');
            return valueCom;
        }
    },
    template: `<div v-html="valueCom"></div>`
});