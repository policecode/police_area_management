Vue.use(VueQuillEditor);
Vue.component("fvn-text-editor", {
    props: ["value", "label"],
    data: function () {
        return {
            editorOption: {
                theme: "snow",
                readOnly: false, //Bật/tắt chế độ chỉ đọc
                modules: {
                    toolbar: {
                        container: [
                            ["bold", "italic", "underline", "strike"],
                            ["blockquote", "code-block"],
                            [{ list: "ordered" }, { list: "bullet" }],
                            // [{ 'script': 'sub'}, { 'script': 'super' }],
                            [{ indent: "-1" }, { indent: "+1" }],
                            // [{ 'direction': 'rtl' }],
                            [{ size: ["small", false, "large", "huge"] }],
                            [{ header: [1, 2, 3, 4, 5, 6, false] }],
                            [{ color: [] }, { background: [] }], // dropdown with defaults from theme
                            [{ font: [] }],
                            [{ align: [] }],
                            ["link"],
                            ["formula"],
                            ["clean"],
                            ["image"],
                            // ['toggle'],
                        ],
                        handlers: {
                            image: this.imageHandler,
                        },
                    },
                },
            },
        };
    },
    mounted: function () {
        // console.log(this.id, this.label);
    },
    computed: {},
    methods: {
        onEditorBlur(editor) {
            // console.log('editor blur!', editor)
        },
        onEditorFocus(editor) {
            // console.log('editor focus!', editor)
        },
        onEditorReady(editor) {
            // console.log(this.value)
            // console.log('editor ready!', editor)
        },
        handleChange(e) {
            this.$emit("input", e.html);
        },
        imageHandler(e) {
            const input = document.createElement("input");
            input.setAttribute("type", "file");
            input.setAttribute("accept", "image/*");
            input.click();
            input.onchange = async function () {
                //   const file = input.files[0];
                //   let quill = this.$refs.myQuillEditor.quill
                //   const range = quill.getSelection();
                //   let formData = new FormData();
                //   formData.append('path','public')
                //   formData.append('file',file)
                //   const resApi = await FileService.create(formData)
                //   if(resApi && resApi.status==API_CODE.Succeed){
                //     quill.insertEmbed(range.index, 'image', resApi.data.path);
                //   }else{
                //     if(resApi){
                //       JsCoreHelper.showErrorMsg(resApi.data.message)
                //     }else{
                //       JsCoreHelper.showErrorMsg('Upload failed')
                //     }
                //   }
                return;
            }.bind(this);
        },
    },
    template: `
                <quill-editor class="fvn-editor" style="min-height:200px"
                  ref="myQuillEditor"
                  :value="value"
                  :options="editorOption" 
                  @blur="onEditorBlur($event)" 
                  @focus="onEditorFocus($event)" 
                  @ready="onEditorReady($event)"
                  @change="handleChange"
                />
              `,
});
