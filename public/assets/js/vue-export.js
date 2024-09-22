
Vue.component('fvn-export', {
    props: ['label','url','trunk','total'],
    data: function () {
        return {
            doing: false,
            loadPercent: 0,
            downloadUrl:'',
            message:''
        }
    },
    mounted: function () {
        
    },
    computed: {
    },
    methods: {
        async startExport(){
            this.loadPercent = 0;
            this.doing=true;
            this.$emit('start');
            await setTimeout(function(){},300);
            this.downloadUrl = '';
            let trunk = this.trunk?this.trunk:1000;
            let totalPage = Math.ceil(this.total/trunk);
            let filename = '';
            let url = this.url;
            url += '&full_lib=1&per_page='+trunk;
            this.loadPercent = 1;
            for(i=0;i<totalPage;i++){
                url += '&page='+(i+1);
                if(filename){
                    url += '&filename='+filename;
                }
                let jsonData = await new RouteApi().get(url);
                this.message = jsonData.message;
                if(jsonData.status){
                    this.loadPercent = Math.floor(i/totalPage);
                    filename = jsonData.filename;
                }else{
                    this.loadPercent = 100;
                    return;
                }
                this.loadPercent = 100;
                this.downloadUrl = siteUrl+'wp-content/uploads/export/'+filename;
            }
        }
    },
    template: `<div>
        <button class="button button-export" @click="startExport">{{label}}</button>
        <fvn-popup v-if="doing">            
            <div slot="content">
                <div v-if="loadPercent>0 && loadPercent<100" class="loading-percent"><div class="loaded" :style="{width:loadPercent+'%'}"></div></div>
                <div v-if="loadPercent==100" class="text-center">{{message}}</div>
            </div>
            <div slot="footer">
                <a target="_blank" v-if="downloadUrl" :href="downloadUrl" class="button">Download</a>
                <button type="button" class="button" @click="doing=0">Close</button>
            </div>
        </fvn-popup>
    </div>`
});