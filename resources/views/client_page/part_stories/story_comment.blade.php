 {{-- Comment Start --}}
 <div id="vue_app_story_comment"
     class="box-comment-wapper p-3 rounded bg-[#fff] mb-6 shadow-[2px_2px_6px_rgba(0,0,0,.13)]">
     {{-- <div class="fb-comments"
                            data-href="{{ route('client.story', ['story_slug' => $story['slug']]) }}" data-width="100%"
                            data-colorscheme="dark" data-numposts="10" data-mobile="true"></div> --}}
     <p class="text-[1.125rem] md:text-[1.25rem] mb-4 font-bold text[rgba(0,0,0,0.8)]">Bình luận (@{{story.total_comment}})</p>
     <div class="simple-comment-box">
        <p class="mb-2 text-center font-medium">** Đạo hữu nào thấy có vấn đề ở bộ truyện thì để lại bình luận cho mình sớm khắc phục nhé.</p>

         <div v-if="user" class="simple-form-comment executed" style="align-items: stretch;" target="0">
             <div class="list-tag-user">
             </div>
             <div class="avartar">
                 <div class="c-img">
                     <picture>
                         <img loading="lazy" :src="user.avatar_url" :alt="user.name" class="img-fluid">
                     </picture>
                 </div>
             </div>
             <div class="edit-content-comment">
                 <textarea v-model="itemDetail.content" :disabled="loading" class="comment-content p-2 "
                     :class="{ 'focused': !loading }" placeholder="Nhận xét..." style="width: 100%; height: 100%;"></textarea>
             </div>
             <div class="send-comment">
                 <button @click="postComment($event, 'post')" class="btn-send-comment btn-green" style="color: white;"
                     type="button">Gửi</button>
             </div>
         </div>
         <p v-else class="mb-2">* Hãy <a href="{{ route('member.form_login') }}" class="text-[#128c7e] font-bold"
                 title="">đăng nhập</a> để tham gia bình luận về truyện nhé.</p>
         <div class="comment-fillter-box">
             <span>Sắp xếp: </span>
             <select class="comment-fillter-sort border border-[#aaa] rounded px-3 py-1">
                 <option value="1">Mới nhất</option>
                 <option value="2">Cũ nhất</option>
                 <option value="3">Nhiều lượt like nhất</option>
             </select>
         </div>
         <div class="list-comment" cmt-target="0">
             <div v-for="(item, index) in items" class="item-comment-box off-reply have-child open">
                 {{-- Comment parent --}}
                 <div class="avartar">
                     <a :href="item.url_profile" class="c-img" :title="item.name">
                         <img :src="item.url_avatar" alt="Default User Avartar">
                     </a>
                 </div>
                 <div class="item-comment-content" item-cmt="1645">
                     <div class="inner-content">

                         <div class="content-wraper">
                             <p class="user-name"><a :href="item.url_profile" class="smooth"
                                     :title="item.name">@{{ item.name }}</a></p>
                             <div class="user-comment">@{{ item.content }}</div>
                         </div>
                         <div class="item-comment-action-wrapper">
                             <div class="item-comment-action-box">
                                 <div class="like-action-box executed">
                                     <button @click="likeComment(item.id)" class="like-comment-btn" :show="item.status">Thích</button>
                                 </div>
                                 <button @click="getFormReply(item.id, item.user_id, item.name)" class="btn-reply-comment" type="button" target="1645">Trả lời</button>
                                 <span class="item-time">@{{ convertStringAfterTime(item.after_minutes) }}</span>
                             </div>
                             <div v-if="item.like > 0" class="comment-count-like">
                                 <div class="comment-count-like-wrapper">
                                     <div class="represent">
                                         <div class="item-count-like item-count-like-1"></div>
                                     </div>
                                     <div v-if="item.like > 1" class="count-like">@{{item.like}}</div>
                                 </div>
                             </div>
                         </div>
                     </div>
                     {{-- Comment child --}}
                     <div v-if="item.childs.length > 0" class="list-child-comment">
                         <button v-if="!showComment.includes(item.id)" @click="showChildComments(item.id)" class="show-child-comment" ><i class="fa-solid fa-share"></i> @{{item.childs.length}} phản hồi</button>
                         <div v-else v-for="(child, i) in item.childs" class="item-comment-box off-reply ">
                             <div class="avartar">
                                 <a :href="child.url_profile" class="c-img" :title="child.name">
                                     <img :src="child.url_avatar" :alt="child.name">
                                 </a>
                             </div>
                             <div class="item-comment-content">
                                 <div class="inner-content">
                                     <div class="content-wraper">
                                         <div class="user-name-with-tag">
                                             <p class="user-name"><a :href="child.url_profile" class="smooth" :title="child.name">@{{ child.name }}</a></p>
                                             <span v-if="child.ask_user_id">nói với</span>
                                             <a v-if="child.ask_user_id" :href="child.url_ask_profile" class="item-user-cmnt-tag"
                                                 :title="child.ask_name">@{{ child.ask_name }}</a>
                                         </div>
                                         <div class="user-comment">@{{ child.content }}</div>
                                     </div>
                                     <div class="item-comment-action-wrapper">
                                         <div class="item-comment-action-box">
                                             <div class="like-action-box executed">
                                                 <button @click="likeComment(child.id)" class="like-comment-btn" :show="child.status">Thích</button>
                                             </div>
                                             <button @click="getFormReply(item.id, child.user_id, child.name)" class="btn-reply-comment" type="button" target="1648">Trả lời</button>
                                             <span class="item-time">@{{ convertStringAfterTime(child.after_minutes) }}</span>
                                         </div>
                                         <div v-if="child.like > 0" class="comment-count-like" target="1648">
                                             <div class="comment-count-like-wrapper">
                                                 <div class="represent">
                                                     <div class="item-count-like item-count-like-1"></div>
                                                 </div>
                                                  <div v-if="child.like > 1" class="count-like">@{{child.like}}</div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                        
                             </div>
                         </div>
                         
                     </div>
                 {{-- Reply Comment --}}

                     <form v-if="reply.parent_id == item.id"
                        @submit="postComment($event, 'reply')"    
                        class="simple-form-comment executed">
                         <div v-if="reply.ask_user_id" class="list-tag-user">
                             <div class="item-tag-user">
                                 @{{reply.ask_user_name}}
                                 <div @click="closeAskFriend" class="close-icon">
                                     <i class="fa-solid fa-xmark"></i>
                                 </div>
                             </div>
                         </div>
                         <div class="avartar">
                             <div class="c-img">
                                 <picture>
                                     <img loading="lazy"
                                         :src="user.avatar_url"
                                         :alt="user.name"
                                         class="img-fluid">
                                 </picture>
                             </div>
                         </div>
                         <div class="edit-content-comment">
                             <input v-model="reply.content" type="text" class="comment-content" :class="{ 'focused': !loading }" :placeholder="`Trả lời ${reply.ask_user_name}`" />
                         </div>
                         <div class="send-comment">
                             <button class="btn-send-comment btn-green" style="color: white;" type="submit">Gửi</button>
                         </div>
                    </form>
                 </div>
             </div>
             {{-- Load thêm comment Start --}}
             
             <div v-if="loading" class="loader-dot">
                <div class="loader-item"></div>
                <div class="loader-item"></div>
                <div class="loader-item"></div>
                <div class="loader-item"></div>
            </div>
            <div v-if="isPaging" class="pagination-comment-box">
                <button @click="nextPage" class="btn-view-more-comment" title="Xem thêm bình luận">Xem thêm bình luận</button>
                <p>@{{stringRecord}}</p>
            </div>
             {{-- Load thêm comment End --}}

         </div>
     </div>
 </div>
 {{-- Comment End --}}

 <script>
     var vue_story_comment_app = {
         loading: false,
         story: {{ Illuminate\Support\Js::from($story) }},
         user: {{ Illuminate\Support\Js::from(Auth::user()) }},
         items: [],
         itemDetail: {
             content: '',
             parent_id: 0,
             story_id: {{ $story['id'] }},
             ask_user_id: 0
         },
         reply: {
             content: '',
             parent_id: 0,
             story_id: {{ $story['id'] }},
             ask_user_id: 0,
             ask_user_name: ""
         },
         like: {
            comment_id: 0
         },
         showComment: [],
         querySearch: {
             total: 0,
             page: 1,
             per_page: 10,
             story_id: {{ $story['id'] }},
             order_by: "id",
             order_type: "DESC",
         },
         apiUrl: FVN_LARAVEL_HOME + "/api/member",
     };
     var appCommentStory = new Vue({
         el: '#vue_app_story_comment',
         data: vue_story_comment_app,
         mounted: function() {
             this.searchItem();
            
         },
         computed: {
            stringRecord() {
                if (this.querySearch.page * this.querySearch.per_page <= this.querySearch.total) {
                    return `${this.querySearch.page * this.querySearch.per_page}/${this.querySearch.total}`;
                }
                    return `${this.querySearch.total}/${this.querySearch.total}`;
            },
            isPaging() {
                return !this.loading && (this.querySearch.page * this.querySearch.per_page < this.querySearch.total)
            }
         },
         methods: {
             convertStringAfterTime(after_minutes) {
                 return getStringAfterTime(after_minutes, 'vi');
             },
             isAuthLogin() {
                if (!this.user) {
                    jAlertCLient("Bạn cần đăng nhập tài khoản để sử dụng chức năng này", 'danger');
                    return true;
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
                     this.items = [...this.items, ...jsonData.data];
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
             buildQueryItem(task, changeUrl) {
                 if (changeUrl == undefined) {
                     changeUrl = true;
                 }
                 if (task == "export") {
                     //  this.getItemUrl = this.apiUrl + ".export";
                 } else if (task) {
                     this.getItemUrl = `${this.apiUrl}/list-comment?is_paginate=1`;
                 } else {
                     this.getItemUrl = `${this.apiUrl}/list-comment?is_paginate=`;
                 }
                 let paramSearch = {};
                 for (const i in this.querySearch) {
                     let value = this.querySearch[i];
                     if (i == "book_date_min" || i == "book_date_max") {
                         value = format_date(value);
                     }
                     paramSearch[i] = value;
                     this.getItemUrl += "&" + i + "=" + value;
                 }

                 // paramSearch["order_by"] = this.querySearch.order_by;
                 // paramSearch["order_type"] = this.querySearch.order_type;
                 // paramSearch["per_page"] = this.querySearch.per_page;
                 // paramSearch["page"] = this.querySearch.page;
                 // if (changeUrl) {
                 //     parent.location.hash = objectToQuery(paramSearch);
                 // }
             },
             getFormReply(id, user_id, user_name) {
                if (this.isAuthLogin()) {
                    return;
                }
                 this.reply.parent_id = id;
                 this.reply.content = '';
                 if (this.user.id != user_id) {
                     this.reply.ask_user_id = user_id;
                     this.reply.ask_user_name = user_name;
                 } else {
                    this.reply.ask_user_id = 0;
                    this.reply.ask_user_name = '';
                 }
                 
             },
             closeAskFriend() {
                this.reply.ask_user_id = 0;
                 this.reply.ask_user_name = '';
             },
             closeFormReply() {
                 this.reply.parent_id = 0;
                 this.reply.content = '';
             },
             async postComment(e, action) {
                 e.preventDefault();
                 this.loading = true;
                 let data = {};
                 if (action == 'post') {
                     data = this.itemDetail;
                 }
                 if (action == 'reply') {
                     data = this.reply;
                 }
                 jsonData = await new RouteApi().post(`${this.apiUrl}/post-comment`, data);
                  if (jsonData.status) {
                      jnotice(jsonData.message);
                      if (jsonData.data.parent_id > 0) {
                          this.closeFormReply();
                          for (i in this.items) {
                              if (this.items[i].id == jsonData.data.parent_id) {
                                  this.items[i].childs.push(jsonData.data);
                                  break;
                                }
                            }
                        } else {
                          this.itemDetail.content = '';
                          this.items.unshift(jsonData.data);
                      }
                  } else {
                      let messErrr = jsonData.message;
                      if (jsonData.errors) {
                          for (const key in jsonData.errors) {
                              messErrr += `<br />${jsonData.errors[key][0]}`
                          }
                      }
                      jAlertCLient(messErrr, 'danger');
                  }
                 this.loading = false;
             },
             async likeComment(comment_id) {
                if (this.isAuthLogin()) {
                    return;
                }
                this.like.comment_id = comment_id
                jsonData = await new RouteApi().post(`${this.apiUrl}/like-comment`, this.like);
                  if (jsonData.status) {
                    //   jnotice(jsonData.message);
                    //   console.log(jsonData.data);
                      let flags = false;
                          for (i in this.items) {
                              if (this.items[i].id == comment_id) {
                                  this.items[i].like = jsonData.data.like;
                                  this.items[i].status = jsonData.data.status;
                                  break;
                                }
                                if (this.items[i].childs.length > 0) {
                                    for (j in this.items[i].childs) {
                                        if (this.items[i].childs[j].id == comment_id) {
                                        this.items[i].childs[j].like = jsonData.data.like;
                                        this.items[i].childs[j].status = jsonData.data.status;
                                        flags = true;
                                        break;
                                        }
                                    }
                                }
                                if (flags) {
                                    break;
                                }
                            }
                  } else {
                      let messErrr = jsonData.message;
                      if (jsonData.errors) {
                          for (const key in jsonData.errors) {
                              messErrr += `<br />${jsonData.errors[key][0]}`
                          }
                      }
                      jAlertCLient(messErrr, 'danger');
                  }
             },
             nextPage() {
                this.querySearch.page += 1;
                this.getItems();
            },
             showChildComments(comment_id) {
                this.showComment.push(comment_id);
             },

         },
         watch: {

         },
     });
 </script>
