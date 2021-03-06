@extends('feed.master')
@section('title',$tag->tagname.' | jaipun')
@section('background',$tag->tagColor)
@section('nav')
            <a style="
            padding: 10px;
            font-size: 16px;
            font-weight:600;
            " href="/feed/{{$tag->id}}">
                Popular
            </a>
            @foreach($tags as $tags)
            <a href="/feed/{{$tags->id}}"  style="padding: 10px;font-size: 16px;">
               {{$tags->tagname}} 
            </a>
            @endforeach
            <a href="/feedtype/{{$tag->type_id}}" style="
            padding: 10px;
            font-size: 16px;
            
            ">
                    more
                    
            </a>
@stop


@section('headpage')
<div style="text-align:center 
    white-space: inherit !important;padding:20px;background:{{$tag->tagColor}}">
<img src="{{$tag->tagDraw}}"style="width: 180px;
    margin: auto;
    display: block;">
    <h1  style="margin:0px;color:#fff">{{$tag->tagname}}</h1>
    <div style="white-space: initial !important;">{{$tag->tagDetail}}</div>
    <div class="feedtag-writer" style="
    margin: 10px auto;
    width: 240px;
">
        <img src="{{$tag->user->profile}}" class="feedtag-writer-profile"> 
        <div class="feedtag-writer-name" > <span >{{$tag->user->name}}</span> <span class="feedtag-writer-detail">{{$tag->user->detail}}</span>
        </div>
        <div style="font-size: 12px;"  v-text="timeSince({{$tag->tagDate}})" ></div>
    </div>
</div>
@stop
@section('feedcontent')
    <article class="feed" v-for="item in sliced" :key="item.id" v-if="sliced">

            <div class="feed-text" >
                <div class="feed-tag" v-text="item.tag.tagname"></div>


            <a v-bind:href="'/story/' + item.id">
                <div class="feed-title" v-text="item.postName"></div>
                <div class="feed-content"  v-text="truncate(item.post)" >
                
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
                    </div><div style="font-size: 12px; "  v-text="timeSince(item.postTime)"></div>
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
                tag:null,
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
                                        this.$http.get('/api/tag/new/{{$id}}?page='+this.page).then(function(response){
                                            postarray = response.data;
                                            vm.posts = postarray.data;
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
                 timeSince(timeStamp) {
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
                },
                truncate(text){
                    return text.replace(/<\/?[^>]+(>|$)/g, "").replace(/&amp;nbsp;/gi,' ').substring(0, 50) + '...';
                },
                // preform API request to the server
                fetch() {
                window.setTimeout(() => {
                    let vm = this;
                    var postarray = [];
                    this.$http.get('/api/tag/new/{{$id}}?page='+this.page).then(function(response){
                        postarray = response.data;
                        this.items = postarray.data;                    
                    }, function(error){
                        console.log(error.statusText);
                    });
                    this.show = true;
                }, 1000);
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

        </script>
@stop