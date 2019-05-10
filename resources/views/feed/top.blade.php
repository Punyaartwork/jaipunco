@extends('feed.master')
@section('title','Jaipun')

@section('nav')
    <a href="/new"  style="
    padding: 10px;
    font-size: 14px;
    font-weight:600;
    ">
    new
    </a>
    @foreach($types as $types)
    <a href="/feedtype/{{$types->id}}"  style="padding: 10px;font-size: 14px;">
    {{$types->type}} 
    </a>
    @endforeach
    <a href="/types"  style="
    padding: 10px;
    font-size: 14px;
    ">
        more
            
    </a>
@stop
@section('feedcontent')
    <article class="feed" v-for="item in sliced" :key="item.id" v-if="sliced">

            <div class="feed-text" >
            <a v-bind:href="'/feed/' + item.tag_id">
                <div class="feed-tag" v-text="item.tag.tagname"></div>
            </a>

            <a v-bind:href="'/story/' + item.id">
                <div class="feed-title" v-text="item.postName"></div>
                <div class="feed-content" :text-content.prop="item.post | truncate">
                
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

            <a v-bind:href="'/profile/' + item.user_id">
                <div class="feed-writer">
                    <img v-bind:src="item.user.profile" class="feed-writer-profile"> 
                    <div class="feed-writer-name"  ><span v-text="item.user.name"></span><span class="feed-writer-detail"  v-text="item.user.detail"></span>
                    </div><div style="font-size: 12px; " :text-content.prop="item.postTime | timeSince"></div>
                </div>
            </a>
            </div>


            <div class="feed-img"><img v-bind:src="item.postDraw"></div>
            

    </article>
@stop


@section('vuefeed')
        <script>
        
        // example demo content
        const app = new Vue({
            el: "#app",
            data: {
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
                menu: [
                        { name: 'login', url: '/login' },
                        { name: 'About US', url: '' }   
                    ],
                menulogin: [
                        { name: 'POST', url: '/post/create' },
                        { name: 'logout', url: '/logout' }   
                    ],
                onOff:false
            },
            computed: {
                // slice the array of data to display
                sliced() {
                return this.items.slice(0, this.display);
                },
            },
            methods: {
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
                            this.$http.get('/api/post/top?page='+this.page).then(function(response){
                                postarray = response.data;
                                vm.posts = postarray.data;
                                for (var i = 0; i < postarray.data.length; i++) { 
                                this.items.push({
                                    id:postarray.data[i].id,
                                    tag_id:postarray.data[i].tag_id,  
                                    postName:postarray.data[i].postName,  
                                    post:postarray.data[i].post,         
                                    postDraw:postarray.data[i].postDraw,   
                                    postLike:postarray.data[i].postLike,   
                                    postComment:postarray.data[i].postComment,   
                                    postShare:postarray.data[i].postShare,     
                                    postTime:postarray.data[i].postTime,                                                                                                             
                                    tag:{
                                        id:postarray.data[i].tag.id,                                      
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
                        else {
                            this.end = true;
                        }
                    }
                };
                },
                // preform API request to the server
                fetch() {
                window.setTimeout(() => {
                    let vm = this;
                    var postarray = [];
                    this.$http.get('/api/post/top?page='+this.page).then(function(response){
                        postarray = response.data;
                        this.items = postarray.data;                    
                    }, function(error){
                        console.log(error.statusText);
                    });
                    this.show = true;
                }, 2000);
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

        </script>
@stop