@extends('feed.master')
@section('title','more | jaipun')
@section('background','#eee')
@section('nav')
<!-- https://image.flaticon.com/icons/svg/263/263115.svg -->
<div class="navcenter" style="white-space: nowrap !important;overflow-y: auto;justify-content: center;
    display: flex;text-align: center;max-width: 400px;margin: 0px auto;">
    <a href="/" style="padding: 10px 15px; font-size: 14px; font-weight: 600;width: 20%;">
        <img src="https://image.flaticon.com/icons/svg/263/263115.svg" style="width: 20px;">
    </a> 


    <!-- https://image.flaticon.com/icons/svg/865/865132.svg -->
    <a href="/card" style="padding: 10px 15px; font-size: 14px;width: 20%;">
        <img src="https://image.flaticon.com/icons/svg/238/238693.svg" style="width: 20px;">
    </a> 

     <!--     https://image.flaticon.com/icons/svg/1001/1001287.svg -->

    <a href="/list" style="padding: 10px 15px; font-size: 14px;width: 20%;">
        <img src="https://image.flaticon.com/icons/svg/1001/1001399.svg" style="width: 20px;">
    </a>

    <!-- https://image.flaticon.com/icons/svg/132/132233.svg -->
    <a href="/history" style="padding: 10px 15px; font-size: 14px; width: 20%;">
        <img src="https://image.flaticon.com/icons/svg/63/63269.svg" style="width: 20px;">
    </a>

    <!-- https://image.flaticon.com/icons/svg/149/149022.svg -->
    <a href="" style="padding: 10px 15px;font-size: 14px;width: 20%;">
        <img src="https://image.flaticon.com/icons/svg/149/149946.svg" style="width: 20px;">
    </a>
</div>
 @stop
@section('feedcontent')
<link rel="stylesheet" href="fonts/style.css" type="text/css" media="all" />

@if (\Session::has('user_id'))
    <?php
    $user = \App\User::find(\Session::get('user_id'));
    ?>

<div style="text-align: center;background: rgb(255, 255, 255);">
    <div style="text-align: center;">
        <div style="height: 160px; background-image: url(&quot;http://jaipun.com/icon/backgroundtype.svg&quot;); background-size: 500px;"></div> 
        <div class="profile-photo">
            <img src="{{$user->profile}}" class="profile-photo-img">
        </div> 
        <h2 style="margin: 15px 0px 0px; color: rgb(84, 173, 161);">{{$user->name}}</h2> 
        <p style="margin: 5px 10px;">{{$user->detail}}</p> 
        <div> <img src="https://image.flaticon.com/icons/svg/1835/1835765.svg" width="25px" alt=""> <span style=" margin: 5px;">0 (พลังบุญ)</span></div>
        <div class="profile-followers" style="display: table;margin: auto;padding: 0px;">
            <div @click="showboons" style="float: left; width: 80px;margin: 10px;padding: 10px 15px;font-weight: 600; border-bottom: 3px solid #EEEEEE;">
                <span class="profile-follow-int">{{$user->stories}}</span> 
                <span class="profile-follow-text">Boons</span>
            </div>
            <div @click="showcards" style="float: left; width: 80px;margin: 10px;padding: 10px 15px;font-weight: 600; border-bottom: 3px solid #EEEEEE;">
                <span class="profile-follow-int">{{$user->stories}}</span> 
                <span class="profile-follow-text">Cards</span>
            </div>
            <div @click="showstories" style="float: left; width: 80px;margin: 10px;padding: 10px 15px;font-weight: 600; border-bottom: 3px solid #EEEEEE;">
                <span class="profile-follow-int">{{$user->stories}}</span> 
                <span class="profile-follow-text">Stories</span>
            </div>
        </div>
    </div>
</div>
  
    <div v-if="boons==true">
    <boon style="border: 1px solid rgb(234, 237, 241);
    max-width: 560px;
    background: rgb(255, 255, 255);
    border-radius: 5px;
    box-shadow: 0 10px 20px 0 rgba(0,0,0,.05)!important;
    margin: 5px auto;font-family: '2005iannnnnUBC';"  
        v-if="item.boon != null" 
        v-for="item in sliced"     
        v-bind:item="item"
        v-on:share="shareBoon"
        v-on:prev="prev"
        v-on:next="next"            
    > 
        </boon>
    </div>
    <card style="border: 1px solid rgb(234, 237, 241);
    max-width: 560px;
    background: rgb(255, 255, 255);
    border-radius: 10px;
    box-shadow: 0 10px 20px 0 rgba(0,0,0,.05)!important;
    margin: 20px auto;font-family: '2005iannnnnUBC';" 
            v-if="cards==true" 
            v-bind:item="item"
            v-on:share="shareCard"
            v-for="item in sliced" 
     >
    </card>


    <div v-if="stories==true">
        <article class="feed" v-for="item in sliced" :key="item.id" v-if="sliced">
                <div class="feed-text" >
                <a v-bind:href="'/feed/' + item.tag_id">
                    <!--<div class="feed-tag" v-text="item.tag.tagname"></div>-->
                </a>

                <a v-bind:href="'/story/' + item.id">
                    <div class="feed-title" v-text="item.postName"  style="margin-top:20px"></div>
                    <div class="feed-content" v-text="item.post">
                    
                    </div>
                    <img v-bind:src="item.postDraw" class="feed-imgdraw">
                
                    <div class="feed-like">
                        <img src="https://image.flaticon.com/icons/svg/1721/1721997.svg" class="feed-like-icon"><span class="feed-like-text"  v-text="item.postLike"></span>
                    </div>
                    <div class="feed-comment">
                        <img src="https://image.flaticon.com/icons/svg/134/134831.svg" class="feed-comment-icon"><span class="feed-comment-text"  v-text="item.postComment"></span>
                    </div>
                    <div class="feed-share">
                        <img src="https://image.flaticon.com/icons/svg/1246/1246222.svg" class="feed-share-icon"><span class="feed-share-text" v-text="item.postShare"></span>
                    </div>
                </a>

                </div>


                <div class="feed-img"><img v-bind:src="item.postDraw"></div>
        </article>
    </div>
@else  
<div id="coming" style="font-family: LayijiMaHaNiYom, sans-serif; font-size: -webkit-xxx-large; margin: 40% 0px; width: 100%; text-align: center;">ยังไม่ได้ล็อกอิน</div>
@endif  


    
@stop
@section('vuefeed')
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

            <div style="margin: 15px 20px;">
                <div style="font-size: 18px;" :text-content.prop="item.boonTime | timeSince"></div>
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
        </div> 
        `
        })
        // example demo content
        const app = new Vue({
            el: "#app",
            data: {
                show   : true, // display content after API request
                offset : 5,     // items to display after scroll
                display: 5,     // initial items
                trigger: 300,   // how far from the bottom to trigger infinite scroll
                items  : [],    // server response data
                end    : false, // no more resources
                posts: [],
                page:1,
                text:null,
                onOff:false,
                counter: 0,
                stories:false,
                boons:true,
                cards:false,                
            },
            computed: {
                // slice the array of data to display
                sliced() {
                    return this.items.slice(0, this.display);
                },
            },
            methods: {
                showstories(){
                    this.page=1;         
                    this.tiems=[];
                    this.stories=true;
                    this.boons=false;
                    this.cards=false; 
                    this.display=5;                                    
                    let vm = this;
                    var postarray = [];
                    this.$http.get("/api/profile/posts/{{\Session::get('user_id')}}?page="+this.page).then(function(response){
                        //alert(JSON.stringify(response.body.data));
                        postarray = response.body;
                        this.items = postarray.data;  
                        for (var i = 0; i < this.items.length; i++) { 
                            this.items[i].post = this.items[i].post.replace(/<\/?[^>]+(>|$)/g, "").replace(/&amp;nbsp;/gi,' ').substring(0, 50) + '...';
                        }                  
                    }, function(error){
                        console.log(error.statusText);
                    });
                },
                showboons(){
                    this.stories=false;
                    this.boons=true;
                    this.cards=false; 
                    this.tiems=[];
                    this.page=1;    
                    this.display=5;                
                    let vm = this;
                    var postarray = [];
                    this.$http.get("/api/profile/boons/{{\Session::get('user_id')}}?page="+this.page).then(function(response){
                        postarray = response.body;
                        this.items = postarray.data;                   
                    }, function(error){
                        console.log(error.statusText);
                    });
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
                showcards(){
                    this.page=1;         
                    this.stories=false;
                    this.boons=false;
                    this.cards=true; 
                    this.tiems=[];       
                    this.display=5;                                                 
                    let vm = this;
                    var postarray = [];
                    this.$http.get("/api/profile/cards/{{\Session::get('user_id')}}?page="+this.page).then(function(response){
                        postarray = response.body;
                        this.items = postarray.data;       
                    }, function(error){
                        console.log(error.statusText);
                    });
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
                prev(id) {                  
                    var last = this.items[id].photo.pop();
                    this.items[id].photo.splice(0, 0, last)
                },
                next(id) {                                                                      
                    var first = this.items[id].photo.shift();
                    this.items[id].photo.push(first)
                },
                // check to see if we're at the bottom of the page
                scroll() {
                window.onscroll = ev => {
                        
                        if (
                        window.innerHeight + window.scrollY >=
                            (document.body.offsetHeight - this.trigger)
                        ) {
                            if (this.display < this.items.length) {

                            if(this.boons == true){
                                this.display = this.display + this.offset;
                                let vm = this;
                                var postarray = [];
                                this.page = this.page+1;
                                this.$http.get("/api/profile/boons/{{\Session::get('user_id')}}?page="+this.page).then(function(response){
                                        postarray = response.body.data;
                                        vm.posts = postarray;
                                        for (var i = 0; i < postarray.length; i++) { 
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
                                                }); 

                                    }                                                                                                    
                                }, function(error){
                                    console.log(error.statusText);
                                });

                            }else if(this.cards == true){
                                this.display = this.display + this.offset;
                                let vm = this;
                                var postarray = [];
                                this.page = this.page+1;
                                this.$http.get("/api/profile/cards/{{\Session::get('user_id')}}?page="+this.page).then(function(response){
                                    postarray = response.body.data;
                                    vm.posts = postarray;
                                    //alert('cards');
                                    for (var i = 0; i < postarray.length; i++) { 
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
                                        });     
                                    }                                                                                                    
                                }, function(error){
                                    console.log(error.statusText);
                                });

                            }else{

                                this.$http.get("/api/profile/posts/{{\Session::get('user_id')}}?page="+this.page).then(function(response){
                                    postarray = response.body;
                                    vm.posts = postarray;
                                    for (var i = 0; i < postarray.data.length; i++) { 
                                        this.items.push({
                                            id:postarray.data[i].id,
                                            postName:postarray.data[i].postName,  
                                            post:postarray.data[i].post,         
                                            postDraw:postarray.data[i].postDraw,   
                                            postLike:postarray.data[i].postLike,   
                                            postComment:postarray.data[i].postComment,   
                                            postShare:postarray.data[i].postShare,     
                                            postTime:postarray.data[i].postTime,                                                                                                             
                                            tag:{
                                                tagname:postarray.data[i].tag.tagname
                                                },
                                            user:{
                                                user_id:postarray.data[i].user.user_id,
                                                profile:postarray.data[i].user.profile,                                        
                                                name:postarray.data[i].user.name,
                                                detail:postarray.data[i].user.detail,                                        
                                                },                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
                                        });    
                                    }                                                                                                    
                                }, function(error){
                                    console.log(error.statusText);
                                });
                            }
                            }
                        }
                    };
                },
                // preform API request to the server
                fetch() {
                    let vm = this;
                    var postarray = [];
                    this.$http.get("/api/profile/boons/{{\Session::get('user_id')}}?page="+this.page).then(function(response){
                        postarray = response.body;
                        this.items = postarray.data;              
                    }, function(error){
                        console.log(error.statusText);
                    });
                    this.show = true;
                },

            },
            mounted() {
                // track scroll event
                this.end = true;
                let vm = this;
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

        </script>
@stop