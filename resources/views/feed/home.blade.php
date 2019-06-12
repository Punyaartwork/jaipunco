@extends('feed.master')
@section('title','latest.')
@section('background','#fafafa')
@section('nav')
@if (\Session::has('user_id'))
    <?php
    $user = \App\User::find(\Session::get('user_id'));
    $image = $user->profile;
    ?>
@else  
    <?php
    $image = "https://image.flaticon.com/icons/svg/109/109718.svg" ;
    ?>
@endif  
    <div class="navcenter" style="white-space: nowrap !important;overflow-y: auto;justify-content: center;
    display: flex;text-align: center;max-width: 400px;margin: 0px auto;">
        <a  style="padding: 10px 15px; font-size: 14px; font-weight: 600;width: 20%;">
            <img src="https://image.flaticon.com/icons/svg/262/262584.svg" style="width: 20px;">
        </a> 


        <!-- https://image.flaticon.com/icons/svg/865/865132.svg -->
        <a href="/more" style="padding: 10px 15px; font-size: 14px;width: 20%;">
            <img src="https://image.flaticon.com/icons/svg/238/238693.svg" style="width: 20px;">
        </a> 

        <!--     https://image.flaticon.com/icons/svg/1001/1001287.svg -->

        <a href="/list" style="padding: 10px 15px; font-size: 14px;width: 20%;">
            <img src="https://image.flaticon.com/icons/svg/1001/1001399.svg" style="width: 20px;">
        </a>

        <!-- https://image.flaticon.com/icons/svg/132/132233.svg -->
        <a href="/history" style="padding: 10px 15px;font-size: 14px;width: 20%;">
            <img src="https://image.flaticon.com/icons/svg/63/63269.svg" style="width: 20px;">
        </a>

        <!-- https://image.flaticon.com/icons/svg/149/149022.svg -->
        <a href="/more" style="padding: 10px 15px;font-size: 14px;width: 20%;">
            <img src="https://image.flaticon.com/icons/svg/149/149946.svg" style="width: 20px;">
        </a>
    </div>
            @stop
@section('feedcontent')
<style>

    feedboon-text{
        padding: 10px 15px 5px 15px;
        text-align: center;
    }
    feedboon-boonName{
        font-size:40px;
    }
    feedboon-boon{
        font-size: 30px;
    }
</style>
<link rel="stylesheet" href="fonts/style.css" type="text/css" media="all" />
<div style="max-width: 560px;border-radius: 10px;margin: 20px auto;">
    <div style="border: 1px solid rgb(234, 237, 241);width:100%;background: rgb(255, 255, 255);border-radius: 10px;display: inline-block;"><div style="padding: 15px 15px 0px; font-size: xx-large; text-align: center; font-family: &quot;2005iannnnnUBC&quot;;">มาร่วมสร้างสังคมที่เต็มไปด้วยเรื่องบุญ ๆ ด้วยกันกับเรา</div> <a href="/boon/create" style="text-align: center;width: 40%;padding: 10px;font-size: xx-large;border-radius: 5px;background: rgb(33, 150, 243);margin: 10px 5%;display: block;float: left;color: rgb(255, 255, 255);font-family: &quot;2005iannnnnUBC&quot;;">Add a Boon</a> <a href="/card/create" style="text-align: center;width: 40%;padding: 10px;font-size: xx-large;border-radius: 5px;background:#009688;margin: 10px 5%;color: rgb(255, 255, 255);display: block;float: left;font-family: &quot;2005iannnnnUBC&quot;;">Add a card</a></div>
</div>
    <article style="border: 1px solid rgb(234, 237, 241);
    max-width: 560px;
    background: rgb(255, 255, 255);
    border-radius: 10px;
    margin: 20px auto;font-family: '2005iannnnnUBC';" v-for="item in sliced" >

        <boon v-if="item.boon != null" 
            v-bind:item="item"
            v-on:like="likedBoon"
            v-on:share="shareBoon"
            v-on:prev="prev"
            v-on:next="next"            
        > 
         </boon>

         <card v-else 
            v-bind:item="item"
            v-on:like="likedCard"
            v-on:share="shareCard"
         > 
         </card>

    </article>

@stop

@section('vuefeed')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>

        Vue.component('boon', {
            props: ['item'],
        template:  `
        <div>
            <div style="padding: 10px 15px 5px 15px;text-align: center;"><div style="font-size:40px"  v-text="item.boonName"></div><div style="font-size:30px" class="feedboon-boon"   v-text="item.boon"></div></div>
            <div style="display: block;flex-wrap: wrap;overflow: hidden; position: relative;max-width: 560px;"> 
            <div><div v-if="item.photo.length > 1" v-on:click="$emit('prev', item.index)" style="left: 15px;position: absolute; font-size: 50px;top: 40%;cursor: pointer;user-select: none;">&lt;</div> <div v-if="item.photo.length > 1" v-on:click="$emit('next', item.index)" style="right: 15px;top: 40%;position: absolute;font-size: 50px;cursor: pointer;user-select: none;">&gt;</div></div>
                <div style="white-space: nowrap;">
                    <div  style=" margin-left: 0%; width: 100%;display: inline-block;transition: all .3s;" :key="photo.id" v-for="photo in item.photo" >
                        <div><a><div><img :src="photo.photo" style="width:100%"></div></a></div>
                    </div>
                </div>
            </div>   

            <div style="font-size: 25px;margin: 0px 5px 0px 10px;" >
                <span v-bind:id="'text_'+item.index">
                    <span   v-if="item.boonLike  > 0">
                        <span style=" margin: 0px 5px 0px 10px;" v-bind:id="'count_'+item.index" v-text="item.boonLike"></span>
                        ล้านปลื้ม
                    </span> 
                </span>
                <span style="float: right;" v-if="item.boonComment  > 0">
                    <span style=" margin: 0px 5px 0px 10px;" v-text="item.boonComment"></span>
                    comments
                </span>
                <span style="float: right;" v-if="item.boonShare  > 0">
                    <span style=" margin: 0px 5px 0px 10px;" v-text="item.boonShare"></span>
                    shared
                </span>
            </div>

            <div style="width:100%;display: flow-root;">
                <div  style="width: 30%;float: left;display: inline-block;border-top: 1px solid rgb(234, 237, 241);">
                    <div style="padding: 5px;margin: auto;display: table;">
                        <img class="like" v-bind:id="'like_'+item.index+'_'+item.id" v-if="item.liked == false" src="https://image.flaticon.com/icons/svg/1865/1865963.svg"   alt="" style="float: left; width: 25px; margin: 3px 0px;"> 
                        <img class="unlike" v-bind:id="'unlike_'+item.index+'_'+item.id" v-else src="https://image.flaticon.com/icons/svg/1865/1865880.svg" alt="" style="float: left; width: 25px; margin: 3px 0px;">
                        <div style="display: inline-block;">
                            <div style="font-size: 25px; margin: 3px 0px 0px 5px;">ปลื้มเลย</div>
                        </div>
                    </div>
                </div>

                <div style=" width: 35%;float: left;  display: inline-block; border-top: 1px solid rgb(234, 237, 241);">
                    <div style="padding: 5px;margin: auto;display: table;">
                        <img src="https://image.flaticon.com/icons/svg/134/134819.svg" alt="" style="float: left; width: 25px; margin: 3px 0px;"> 
                        <div style="display: inline-block;">
                            <div style="font-size: 25px; margin: 3px 0px 0px 10px;">comment</div>
                        </div>
                    </div>
                </div>

                <div style=" width: 35%; float: left;display: inline-block;border-top: 1px solid rgb(234, 237, 241);">
                    <div v-on:click="$emit('share', item.index)" style="padding: 5px 10px;margin: auto;display: table;position: relative;">
                        <div style="position: absolute;display:none;margin-top: -45px"  v-bind:id="'share_'+item.index">
                            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
                            <div class="social-buttons" style="font-size: 25px;float:right;margin-top:10px">
                                <a v-bind:href="'https://www.facebook.com/sharer/sharer.php?u=https://jaipun.com/boon/'+item.id"
                                target="_blank" style="color: #4e71a8 !important;">
                                <i class="fa fa-facebook-official"></i>
                                </a>
                                <a v-bind:href="'https://twitter.com/intent/tweet?url=https://jaipun.com/boon/'+item.id"
                                target="_blank" style="color: #1cb7eb !important;">
                                    <i class="fa fa-twitter-square"></i>
                                </a>

                                <a v-bind:href="'https://social-plugins.line.me/lineit/share?url=https://jaipun.com/boon/'+item.id" target="_blank"><img src="https://image.flaticon.com/icons/svg/124/124027.svg" style="width: 20px;"></a>
                            </div>
                        </div>
                        <img src="https://image.flaticon.com/icons/svg/1787/1787887.svg" alt="" style="float: left; width: 25px; margin: 3px 0px;"> 
                        <div style="display: inline-block;">
                            <div style="font-size: 25px; margin: 3px 0px 0px 10px;">ส่งบุญ</div>
                        </div>
                    </div>
                </div>
            </div>
            <form method="post" action="{{ route('comments.store') }}" style=" padding-top: 10px;border-top: 1px solid rgb(234, 237, 241);">
                @csrf
                <div class="form-group">
                                
                        <img src="{{$image}}" height="30px" alt="" style="border-radius: 100px;position: absolute;    margin: 0px 2%;   border: 1px solid #BDBDBD;object-fit: cover;">
                        <textarea placeholder="Write a comment..." name="body" style="
                        border: 1px solid #ccd0d5;
                        border-radius: 16px;
                        width: 75%;
                        margin: 0% 0px 0% 12%;
                        padding: 8px 12px;
                        line-height: 16px;
                        overflow: hidden;
                        height: 35px;
                        outline:none;
                    "></textarea>
                    <input type="hidden" name="post_id" :value="item.id" />
                    <input type="hidden" name="commentType" value="2" />  
                    <button type="submit" style="border: 0; background: transparent; position: absolute;outline:none;">
                        <img src="https://image.flaticon.com/icons/svg/1878/1878898.svg" width="30" height="30" alt="submit" />
                    </button>  
                </div>
            </form>

            <div :key="comment.id" v-for="comment in item.comments" >
                <div style="margin: 15px 20px;">
                    <img v-bind:src="comment.user.profile" alt="" style="
                    margin: 0px 10px 0px 0px;
                    border-radius: 100px;
                    border: 1px solid #BDBDBD;
                    height: 30px;
                    width: 30px;
                    object-fit: cover;
                    display: inline-block;
                    float: left;
                    "> 
                    <div style="display: inline-block;">
                        <span style="font-weight: bold;font-size:20px" v-text="comment.user.name"></span><span style="
                            font-size: 20px;
                            margin: 0px 5px;
                        " v-text="comment.body"></span>   
                        <div style="font-size: 18px;" v-text="comment.created_at"></div>
                    </div> 
                </div>
            </div>
            
        </div>
        `
        })

        
        Vue.component('card', {
            props: ['item'],
        template: `
        <div>
            <div style="padding: 10px 60px 5px;text-align: center;">
                <div style="font-size: 40px;margin-top: 60px;" v-html="item.card"></div>
                <div style="font-weight: bold;font-size:26px" v-text="item.user.name"></div>
                <div style="font-size: 18px;" :text-content.prop="item.cardTime | timeSince"></div>
                <img v-bind:src="item.cardPhoto" alt="" style="
                    width: 50%;
                    margin: 30px 0px 15px;
                ">
            </div>

            <div style="font-size: 25px;margin: 0px 5px 0px 10px;display: inline-block;"  >
                <span v-bind:id="'text_'+item.index">
                    <span  v-if="item.cardLike > 0">
                        <span style=" margin: 0px 5px 0px 10px;" v-bind:id="'count_'+item.index" v-text="item.cardLike"></span>
                        ล้านปลื้ม
                    </span> 
                </span>
                <span style="float: right;" v-if="item.cardComment > 0">
                    <span style=" margin: 0px 5px 0px 10px;" v-text="item.cardComment"></span>
                    comments
                </span>
                <span style="float: right;" v-if="item.cardShare > 0">
                    <span style=" margin: 0px 5px 0px 10px;" v-text="item.cardShare"></span>
                    shared
                </span>
            </div>

            <div style="width:100%;display: flow-root;">
                <div style="width: 30%;float: left;display: inline-block;border-top: 1px solid rgb(234, 237, 241);">
                    <div style="padding: 5px;margin: auto;display: table;">
                        <img class="clike" v-bind:id="'like_'+item.index+'_'+item.id" v-if="item.liked == false" src="https://image.flaticon.com/icons/svg/1865/1865963.svg"  alt="" style="float: left; width: 25px; margin: 3px 0px;"> 
                        <img  class="cunlike" v-bind:id="'unlike_'+item.index+'_'+item.id" v-else src="https://image.flaticon.com/icons/svg/1865/1865880.svg" alt="" style="float: left; width: 25px; margin: 3px 0px;">
                        <div style="display: inline-block;">
                            <div style="font-size: 25px; margin: 3px 0px 0px 5px;">ปลื้มเลย<span v-text="item.liked"></span></div>
                        </div>
                    </div>
                </div>

                <div style=" width: 35%;float: left;  display: inline-block; border-top: 1px solid rgb(234, 237, 241);">
                    <div style="padding: 5px;margin: auto;display: table;">
                        <img src="https://image.flaticon.com/icons/svg/134/134819.svg" alt="" style="float: left; width: 25px; margin: 3px 0px;"> 
                        <div style="display: inline-block;">
                            <div style="font-size: 25px; margin: 3px 0px 0px 10px;">comment</div>
                        </div>
                    </div>
                </div>

                <div style=" width: 35%; float: left;display: inline-block;border-top: 1px solid rgb(234, 237, 241);">
                    <div v-on:click="$emit('share', item.index)" style="padding: 5px 10px;margin: auto;display: table;position: relative;">
                        <div style="position: absolute;display:none;margin-top: -45px"  v-bind:id="'share_'+item.index">
                            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
                            <div class="social-buttons" style="font-size: 25px;float:right;margin-top:10px">
                                <a v-bind:href="'https://www.facebook.com/sharer/sharer.php?u=https://jaipun.com/card/'+item.id"
                                target="_blank" style="color: #4e71a8 !important;">
                                <i class="fa fa-facebook-official"></i>
                                </a>
                                <a v-bind:href="'https://twitter.com/intent/tweet?url=https://jaipun.com/card/'+item.id"
                                target="_blank" style="color: #1cb7eb !important;">
                                    <i class="fa fa-twitter-square"></i>
                                </a>

                                <a v-bind:href="'https://social-plugins.line.me/lineit/share?url=https://jaipun.com/card/'+item.id" target="_blank"><img src="https://image.flaticon.com/icons/svg/124/124027.svg" style="width: 20px;"></a>
                            </div>
                        </div>
                        <img src="https://image.flaticon.com/icons/svg/1787/1787887.svg" alt="" style="float: left; width: 25px; margin: 3px 0px;"> 
                        <div style="display: inline-block;">
                            <div style="font-size: 25px; margin: 3px 0px 0px 10px;">ส่งบุญ</div>
                        </div>
                    </div>
                </div>
            </div>

            <form method="post" action="{{ route('comments.store') }}" style=" padding-top: 10px;border-top: 1px solid rgb(234, 237, 241);">
                @csrf
                <div class="form-group">
                                
                        <img src="{{$image}}" height="30px" alt="" style="border-radius: 100px;position: absolute;    margin: 0px 2%;   border: 1px solid #BDBDBD;object-fit: cover;">
                        <textarea placeholder="Write a comment..." name="body" style="
                        border: 1px solid #ccd0d5;
                        border-radius: 16px;
                        width: 75%;
                        margin: 0% 0px 0% 12%;
                        padding: 8px 12px;
                        line-height: 16px;
                        overflow: hidden;
                        height: 35px;
                        outline:none;
                    "></textarea>
                    <input type="hidden" name="post_id" :value="item.id" />
                    <input type="hidden" name="commentType" value="3" />  
                    <button type="submit" style="border: 0; background: transparent; position: absolute;outline:none;">
                        <img src="https://image.flaticon.com/icons/svg/1878/1878898.svg" width="30" height="30" alt="submit" />
                    </button>  
                </div>
            </form>

            <div :key="comment.id" v-for="comment in item.comments" >
                <div style="margin: 15px 20px;">
                    <img v-bind:src="comment.user.profile" alt="" style="
                    margin: 0px 10px 0px 0px;
                    border-radius: 100px;
                    border: 1px solid #BDBDBD;
                    height: 30px;
                    width: 30px;
                    object-fit: cover;
                    display: inline-block;
                    float: left;
                    "> 
                    <div style="display: inline-block;">
                        <span style="font-weight: bold;font-size:20px" v-text="comment.user.name"></span><span style="
                            font-size: 20px;
                            margin: 0px 5px;
                        " v-text="comment.body"></span>   
                        <div style="font-size: 18px;" v-text="comment.created_at"></div>
                    </div> 
                </div>
            </div>

            
        </div> 
        `
        })
        let feed = {
                show   : false, // display content after API request
                offset : 5,     // items to display after scroll
                display: 5,     // initial items
                trigger: 300,   // how far from the bottom to trigger infinite scroll
                items  : [],    // server response data
                end    : false, // no more resources
                posts: [],
                page:1,
                text:null,
                tags:[],
                datacontent: 'This component was made with the help of a data object in the Vue instance',
                menu: [
                        { name: 'login', url: '/login' },
                        { name: 'About US', url: '' }   
                    ],
                menulogin: [
                        { name: 'edit profile', url: '/post/create' },
                        { name: 'edit', url: '/post/create' },
                        { name: 'POST', url: '/post/create' },                        
                        { name: 'logout', url: '/logout' }   
                    ],
                onOff:false
            };
        // example demo content
        const app = new Vue({
            el: "#app",
            data: feed,
            computed: {
                // slice the array of data to display
                sliced() {
                    return this.items.slice(0, this.display);
                },
            },
            methods: {
                test(id) {
                    alert('OK'+id);
                },
                likedBoon(id){
                    let vm = this;
                    @if(\Session::has('user_id'))
                        this.$http.get('/like/'+ this.items[id].id +'/islikedBoonbyme').then(function(response){
                            if(response.body==='true'){                  
                                this.items[id].liked = false;
                                this.items[id].boonLike - 10;
                                var count = Number($( "#count_"+id ).text()); 
                                var sum = count - 10;
                                $("#count_"+id).html(sum);   
                                $("#unlike_"+id).attr('src','https://image.flaticon.com/icons/svg/1865/1865963.svg');                                                                          
                                this.$http.get('/like/'+ this.items[id].id  +'/likedBoon').then(function(response){});
                                $("#unlike_"+id).attr('id',   'like_' + id);                                   
                            }else{
                                this.items[id].liked = true; 
                                this.items[id].boonLike + 10;  
                                var count = Number($( "#count_"+id ).text()); 
                                var sum = count + 10;
                                $("#count_"+id).html(sum);
                                $("#text_"+id).html('<span ><span style=" margin: 0px 5px 0px 10px;" id="count_'+id+'" >'+sum +'</span>ล้านปลื้ม</span>');                                                                                                                                                                                                                         
                                $("#like_"+id).attr('src','https://image.flaticon.com/icons/svg/1865/1865880.svg'); 
                                this.$http.get('/like/'+ this.items[id].id  +'/likedBoon').then(function(response){});
                                $("#like_"+id).attr('id',   'unlike_' + id);   
                                
                            }
                        }, function(error){
                            console.log(error.statusText);
                        });
                    @else
                    this.onOff = true;
                    @endif                  
                },
                shareBoon(id){        
                    if(this.items[id].share===true){
                        $("#share_"+id).hide(); 
                        this.items[id].share = false;
                    }else{
                        $("#share_"+id).show();   
                        this.items[id].share = true; 
                        this.$http.get('/shareboon/'+items[id].id).then(function(response){});                                             
                    }                   
                },                
                prev(id) {                  
                    var last = this.items[id].photo.pop();
                    this.items[id].photo.splice(0, 0, last)
                },
                next(id) {                                                                      
                    var first = this.items[id].photo.shift();
                    this.items[id].photo.push(first)
                },

                likedCard(id){
                    let vm = this;
                    @if(\Session::has('user_id'))
                        this.$http.get('/like/'+ this.items[id].id +'/islikedCardbyme').then(function(response){
                            if(response.body==='true'){                                   
                                this.items[id].liked = false;
                                this.items[id].cardLike - 10;
                                var count = Number($( "#count_"+id ).text()); 
                                var sum = count - 10;
                                $("#count_"+id).html(sum);   
                                $("#unlike_"+id).attr('src','https://image.flaticon.com/icons/svg/1865/1865963.svg');                                                                          
                                this.$http.get('/like/'+ this.items[id].id +'/likedCard').then(function(response){});
                                $("#unlike_"+id).attr('id',   'like_' + id);                                   
                            }else{
                                this.items[id].liked = true; 
                                this.items[id].cardLike + 10;  
                                var count = Number($( "#count_"+id ).text()); 
                                var sum = count + 10;
                                $("#count_"+id).html(sum);
                                $("#text_"+id).html('<span ><span style=" margin: 0px 5px 0px 10px;" id="count_'+id+'" >'+sum +'</span>ล้านปลื้ม</span>');                                                                                                                                                                                                                         
                                $("#like_"+id).attr('src','https://image.flaticon.com/icons/svg/1865/1865880.svg'); 
                                this.$http.get('/like/'+ this.items[id].id +'/likedCard').then(function(response){});
                                $("#like_"+id).attr('id',   'unlike_' + id);   
                                
                            }
                        }, function(error){
                            console.log(error.statusText);
                        });
                    @else
                    this.onOff = true;
                    @endif                  
                },
                shareCard(id){              
                    if(this.items[id].share===true){
                        $("#share_"+id).hide(); 
                        this.items[id].share = false;
                    }else{
                        $("#share_"+id).show();   
                        this.items[id].share = true; 
                        this.$http.get('/sharecard/'+this.items[id].id).then(function(response){});                                             
                    }                   
                },   

                // check to see if we're at the bottom of the page
                scroll() {
                window.onscroll = ev => {
                    
                    if (
                        window.innerHeight + window.scrollY >=
                        (document.documentElement.offsetHeight - this.trigger)
                    ) {
                        if (this.display < this.items.length) {
                            this.display = this.display + this.offset;
                            let vm = this;
                            var postarray = [];
                            this.page = this.page+1;
                            this.$http.get('/api/all?page='+this.page).then(function(response){
                                postarray = response.body;
                                vm.posts = postarray;
                                //alert(JSON.stringify(response.body));
                                for (var i = 0; i < postarray.length; i++) { 
                                        if(postarray[i].like.length > 0){
                                            for (var j = 0; j < postarray[i].like.length; j++) { 
                                                @if(\Session::has('user_id'))
                                                    if(postarray[i].like[j].user_id == {{\Session::get('user_id')}}){
                                                        postarray[i].liked = true;
                                                    }else{
                                                        postarray[i].liked = false;
                                                    }
                                                @else
                                                    postarray[i].liked = false;                                                
                                                @endif
                                            }
                                        }else{
                                            postarray[i].liked = false;
                                        }
                                    if(postarray[i].boon != 0){
                                        this.items.push({
                                            id:postarray[i].id, 
                                            index:this.items.length,                                                 
                                            boon:postarray[i].boon,   
                                            boonName:postarray[i].boonName, 
                                            boonLike:postarray[i].boonLike,  
                                            boonComment:postarray[i].boonComment,  
                                            boonShare:postarray[i].boonShare,                                               
                                            photo:postarray[i].photo,  
                                            comments:postarray[i].comments,                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          
                                            user:postarray[i].user,   
                                            liked:postarray[i].liked,                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      
                                        }); 
                                    }else{
                                        this.items.push({
                                            id:postarray[i].id, 
                                            index:this.items.length,    
                                            card:postarray[i].card, 
                                            cardPhoto:postarray[i].cardPhoto,   
                                            cardLike:postarray[i].cardLike,  
                                            cardComment:postarray[i].cardComment,  
                                            cardShare:postarray[i].cardShare,  
                                            comments:postarray[i].comments,                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
                                            user:postarray[i].user,   
                                            liked:postarray[i].liked,                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
                                        });     
                                    }
                                }                                                                                                    
                            }, function(error){
                                console.log(error.statusText);
                            });
                            
                            
                        }
                        else {
                            this.end = true;
                        }
                    }
                };
                },
                // preform API request to the server
                fetch() {
                    let vm = this;
                    var postarray = [];
                    this.$http.get('/api/all?page='+this.page).then(function(response){
                        postarray = response.body;
                        this.items = postarray;            
                        for (var i = 0; i < this.items.length; i++) { 
                            this.items[i].share = false;
                            this.items[i].index = i;                            
                            if(this.items[i].like.length > 0){
                                for (var j = 0; j < this.items[i].like.length; j++) { 
                                    @if(\Session::has('user_id'))
                                    if(this.items[i].like[j].user_id == {{\Session::get('user_id')}}){
                                        alert(this.items[i].like[j].user_id+'==' + {{\Session::get('user_id')}});
                                        this.items[i].liked = true; 
                                        return;                                   
                                    }else{
                                        this.items[i].liked = false;
                                    }
                                    @else
                                        this.items[i].liked = false;                                              
                                    @endif
                                }
                            }else{
                                this.items[i].liked = false;
                            }
                        }        
                    }, function(error){
                        console.log(error.statusText);
                    });
                    this.show = true;
                },

            },
            mounted() {
                // track scroll event
                this.scroll();
            },
            created() {
                // get the data by performing API request
                this.fetch();
            }
        });

        Vue.filter('truncate', function (text) {
          return text.replace(/<\/?[^>]+(>|$)/g, "").replace(/&amp;nbsp;/gi,' ').substring(0, 50) + '...';
        });

        Vue.filter('timeSince', function(timeStamp) {
            timeStamp = new Date(timeStamp * 1000);
            var now = new Date(),
            secondsPast = (now.getTime() - timeStamp.getTime() ) / 1000;
        if(secondsPast < 60){
            return parseInt(secondsPast) + ' seconds ago';
        }
        if(secondsPast < 3600){
            return parseInt(secondsPast/60) + ' minutes ago';
        }
        if(secondsPast <= 86400){
            return parseInt(secondsPast/3600) + ' hours ago';
        }
        if(secondsPast <= 259200){
            hour = timeStamp.getHours();
            minute = timeStamp.getMinutes();
            return parseInt(secondsPast/86400) + ' day ago at  ' + hour +":"+ minute;
        }
        if(secondsPast > 259200){
            day = timeStamp.getDate();
            month = timeStamp.toDateString().match(/ [a-zA-Z]*/)[0].replace(" ","");
            year = timeStamp.getFullYear() == now.getFullYear() ? "" :  " "+timeStamp.getFullYear();
            hour = timeStamp.getHours();
            minute = timeStamp.getMinutes();
            if(hour < 10){
                hour = "0"+hour;
            }
            if(minute < 10){
                minute = "0"+minute;
            }
            return day + " " + month + year + " " + hour +":"+ minute;
        }
        });

        $( document ).ready(function() {
            console.log( "ready!" );
            $(document).on("click",".like",function() {
                @if(\Session::has('user_id'))
                //alert("click bound to document listening for #test-element"+$(this).attr('id'));
                var res = $(this).attr('id').substring(5);
                var split_id = res.split("_");
                //alert(res +'  '+ split_id[1]);
                var index =split_id[0];
                var id =split_id[1];     
                var count = Number($( "#count_"+index ).text()); 
                var sum = count + 10;      
                $("#count_"+index).html(sum);
                $("#text_"+index).html('<span ><span style=" margin: 0px 5px 0px 10px;" id="count_'+index+'" >'+sum +'</span>ล้านปลื้ม</span>');                                                                                                                                                                                                                         
                $("#like_"+index+"_"+id).attr('src','https://image.flaticon.com/icons/svg/1865/1865880.svg'); 
                $.get( '/like/'+ id  +'/likedBoon', function( response ) {
                    console.log( response ); // server response
                });
                //this.$http.get('/like/'+ this.items[id].id  +'/likedBoon').then(function(response){});
                $("#like_"+index+"_"+id).attr('class','unlike');            
                $("#like_"+index+"_"+id).attr('id',   'unlike_'+index+'_'+id); 
                @else
                    feed.onOff = true;                                             
                @endif   
            });

            $(document).on("click",".unlike",function() {
                //alert("click bound to document listening for #test-element"+$(this).attr('id'));
                var res = $(this).attr('id').substring(7);
                var split_id = res.split("_");
                //alert(res +'  '+ split_id[1]);
                var index =split_id[0];
                var id =split_id[1];   

                var count = Number($( "#count_"+index ).text()); 
                var sum = count - 10;
                $("#count_"+index).html(sum);  
                $("#unlike_"+index+"_"+id).attr('src','https://image.flaticon.com/icons/svg/1865/1865963.svg');                                                                          
                //this.$http.get('/like/'+ this.items[id].id  +'/likedBoon').then(function(response){});
                $.get( '/like/'+ id  +'/likedBoon', function( response ) {
                    console.log( response ); // server response
                });
                $("#unlike_"+index+"_"+id).attr('class','like');
                $("#unlike_"+index+"_"+id).attr('id',   'like_'+index+'_'+id);       
            });

            $(document).on("click",".clike",function() {
                @if(\Session::has('user_id'))                
                //alert("click bound to document listening for #test-element"+$(this).attr('id'));
                var res = $(this).attr('id').substring(5);
                var split_id = res.split("_");
                //alert(res +'  '+ split_id[1]);
                var index =split_id[0];
                var id =split_id[1];     
                var count = Number($( "#count_"+index ).text()); 
                var sum = count + 10;      
                $("#count_"+index).html(sum);
                $("#text_"+index).html('<span ><span style=" margin: 0px 5px 0px 10px;" id="count_'+index+'" >'+sum +'</span>ล้านปลื้ม</span>');                                                                                                                                                                                                                         
                $("#like_"+index+"_"+id).attr('src','https://image.flaticon.com/icons/svg/1865/1865880.svg'); 
                $.get( '/like/'+ id  +'/likedCard', function( response ) {
                    console.log( response ); // server response
                });
                //this.$http.get('/like/'+ this.items[id].id  +'/likedBoon').then(function(response){});
                $("#like_"+index+"_"+id).attr('class','cunlike');            
                $("#like_"+index+"_"+id).attr('id',   'unlike_'+index+'_'+id);    
                @else
                    feed.onOff = true;                                             
                @endif   
            });

            $(document).on("click",".cunlike",function() {
                //alert("click bound to document listening for #test-element"+$(this).attr('id'));
                var res = $(this).attr('id').substring(7);
                var split_id = res.split("_");
                //alert(res +'  '+ split_id[1]);
                var index =split_id[0];
                var id =split_id[1];   

                var count = Number($( "#count_"+index ).text()); 
                var sum = count - 10;
                $("#count_"+index).html(sum);  
                $("#unlike_"+index+"_"+id).attr('src','https://image.flaticon.com/icons/svg/1865/1865963.svg');                                                                          
                //this.$http.get('/like/'+ this.items[id].id  +'/likedBoon').then(function(response){});
                $.get( '/like/'+ id  +'/likedCard', function( response ) {
                    console.log( response ); // server response
                });
                $("#unlike_"+index+"_"+id).attr('class','clike');
                $("#unlike_"+index+"_"+id).attr('id',   'like_'+index+'_'+id);       
            });
        });
        </script>
@stop