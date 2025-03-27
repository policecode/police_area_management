<a id="ads__modal_direct_link_vue" v-if="show" @click="show=false" target="_blank" :href="redirect_link" class="fixed left-0 right-0 top-0 bottom-0" style="background-color: rgb(0 0 0 / 50%);">
    
</a>

<script>
    var ads_modal_app = {
        show: false,
        list_link: [
            'https://adaptunemployed.com/yufwc1i2?key=1f07ada3a05a250e82e341029078702c',
            'https://adaptunemployed.com/b4ic9kt4n?key=359e73437891c68f041068acc5649240',
            'https://adaptunemployed.com/yyu70skhi?key=14fc5ec1f98ee9a2aaf7476e067ea355',
            'https://adaptunemployed.com/xk92x8vp5t?key=1f259acdca6dc93652162688e7db7021'
        ],
        redirect_link: '',
    };
    var appAdsModal = new Vue({
        el: '#ads__modal_direct_link_vue',
        data: ads_modal_app,
        mounted: function() {
           this.getModal();
           
        },
        computed: {
            
        },
        methods: {
            getModal() {
                this.redirect_link = this.list_link[Math.floor(Math.random() * this.list_link.length)];
                setTimeout(() => {
                    this.show = true;
                }, 5000);
            },
       

        },
        watch: {

        },
    });
</script>