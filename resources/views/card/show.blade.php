@extends('feed.master')
@section('title','card...'.$card->user->name.' | jaipun')
@section('background','#fafafa')
@section('nav')
<link rel="stylesheet" href="/fonts/style.css" type="text/css" media="all" />
<div class="navcenter" style="white-space: nowrap !important;overflow-y: auto;justify-content: center;
display: flex;text-align: center;max-width: 400px;margin: 0px auto;">
    <a  style="padding: 10px 15px; font-size: 14px; font-weight: 600;width: 20%;">
        <img src="https://image.flaticon.com/icons/svg/262/262584.svg" style="width: 20px;">
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
    <a href="/notification" style="padding: 10px 15px;font-size: 14px;width: 20%;position: relative; ">
        <div style="position: absolute;
        border-radius: 50%;
        border: 2px solid rgb(255, 255, 255);
        width: 10px;
        height: 10px;
        right: 35%;
        background:#2196F3;">
        </div>
        <img src="https://image.flaticon.com/icons/svg/63/63269.svg" style="width: 20px;">
    </a>

    <!-- https://image.flaticon.com/icons/svg/149/149022.svg -->
    <a href="/more" style="padding: 10px 15px;font-size: 14px;width: 20%;">
        <img src="https://image.flaticon.com/icons/svg/149/149946.svg" style="width: 20px;">
    </a>
</div>

 @stop
@section('feedcontent')


<div class="container" style="font-family: '2005iannnnnUBC';max-width: 560px;margin: auto;">


    <article  style="
    border: 1px solid #eaedf1;
        max-width: 560px;
        background: #fff;
        border-radius: 10px;
        margin:20px 0px;
    ">

    <div style="padding: 10px 60px 5px;text-align: center;">
        <div style="font-size: 40px;margin-top: 60px;" v-html="'{{$card->card}}'" ></div>
        <div style="font-weight: bold;font-size:26px" >{{$card->user->name}}</div>
        <div style="font-size: 18px;" :text-content.prop="{{$card->cardTime}} | timeSince"></div>
        <img src="{{$card->cardPhoto}}" alt="" style="
            width: 50%;
            margin: 30px 0px 15px;
        ">
    </div>


   <div style="
        font-size: 25px;
        margin: 0px 5px 0px 10px;
    " id="text_{{$card->id}}" ><span  v-if="{{$card->cardLike}} != 0">
        <span style=" margin: 0px 5px 0px 10px;" id="count_{{$card->id}}" >{{$card->cardLike}}</span>
            ล้านปลื้ม</span> 
        <span style="float: right;" v-if="{{$card->cardComment}} != 0">
        <span style=" margin: 0px 5px 0px 10px;" >{{$card->cardComment}}</span>comments</span>
        <span style="float: right;" v-if="{{$card->cardShare}} != 0">
        <span style=" margin: 0px 5px 0px 10px;" >{{$card->cardShare}} </span>shared</span>
    
    </div>


    <div style="width:100%;display: flow-root;">
            <div style="width: 30%;float: left;display: inline-block;border-top: 1px solid rgb(234, 237, 241);">
                <div style="padding: 5px;margin: auto;display: table;">
                    <img id="like_{{$card->id}}" v-if="liked == false" src="https://image.flaticon.com/icons/svg/1865/1865963.svg" @click="likedCard({{$card->id}})"  v-if="liked == false" src="https://image.flaticon.com/icons/svg/1865/1865963.svg"  alt="" style="float: left; width: 25px; margin: 3px 0px;"> 
                    <img  id="unlike_{{$card->id}}" v-else src="https://image.flaticon.com/icons/svg/1865/1865880.svg" @click="likedCard({{$card->id}})"  v-else src="https://image.flaticon.com/icons/svg/1865/1865880.svg" alt="" style="float: left; width: 25px; margin: 3px 0px;">
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
                <div @click="shared = !shared"  style="padding: 5px 10px;margin: auto;display: table;position: relative;">
                    <div @click="sharecard" style="position: absolute;display:none;margin-top: -45px"  id="'share_{{$card->id}}">
                        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
                        <div class="social-buttons" style="font-size: 25px;float:right;margin-top:10px">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=https://jaipun.com/card/{{$card->id}}"
                            target="_blank" style="color: #4e71a8 !important;">
                            <i class="fa fa-facebook-official"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url=https://jaipun.com/card/{{$card->id}}"
                            target="_blank" style="color: #1cb7eb !important;">
                                <i class="fa fa-twitter-square"></i>
                            </a>
        
                            <a href="https://social-plugins.line.me/lineit/share?url=https://jaipun.com/card/{{$card->id}}" target="_blank"><img src="https://image.flaticon.com/icons/svg/124/124027.svg" style="width: 20px;"></a>
                        </div>
                    </div>
                    <img src="https://image.flaticon.com/icons/svg/1787/1787887.svg" alt="" style="float: left; width: 25px; margin: 3px 0px;"> 
                    <div style="display: inline-block;">
                        <div style="font-size: 25px; margin: 3px 0px 0px 10px;">ส่งบุญ</div>
                    </div>
                </div>
            </div>
        </div>
        





<form method="post" action="{{ route('comments.store') }}" style="
    padding-top: 10px;
    border-top: 1px solid rgb(234, 237, 241);
">
    @csrf
    <div style="position: relative;">
            <textarea placeholder="Write a comment..." name="body" style="
            border: 1px solid #ccd0d5;
            border-radius: 16px;
            width: 80%;
            margin: 0% 2%;
            padding: 8px 12px;
            line-height: 16px;
            overflow: hidden;
            height: 35px;
            outline:none;
        "></textarea>
        <input type="hidden" name="post_id" value="{{$card->id}}" />
        <input type="hidden" name="commentTime" value="{{time()}}" />        
        <input type="hidden" name="commentType" value="3" />  
        <button type="submit" style="border: 0; background: transparent; position: absolute;outline:none;
            margin: 0px 0px 0px 0%;">
            <img src="https://image.flaticon.com/icons/svg/1878/1878898.svg" width="35" height="35" alt="submit" />
        </button>  
    </div>
</form>

@foreach($card->comments as $comment)

    <div >

                <div style="margin: 15px 20px;">
                    <img src="{{$comment->user->profile}}" alt="" style="
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
                        <span style="font-weight: bold;font-size:20px" >{{$comment->user->name}}</span><span style="
                            font-size: 20px;
                            margin: 0px 5px;
                        " >{{$comment->body}}</span>   
                        <div style="font-size: 18px;" :text-content.prop="{{$comment->commentTime}} | timeSince"></div>
                    </div> 
                </div>
    </div>

@endforeach

    
</div> 

    </article>



    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $('.detele_form').on('submit',function(){
            if(confirm("detele ??")){
                return true;
            }else{
                return false;
            }
        });
    });
    </script>
@stop



@section('vuefeed')
        <script>
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
                liked:null,
                shared:false,
            },
            computed: {
                // slice the array of data to display
                sliced() {
                    return this.items.slice(0, this.display);
                },
            },
            methods: {
                likeBoon(id){

                    //this.items[index].liked =vm.liked;
                },
                likedtest(id){
                    //alert(id);
                    let vm = this;   
                    var index = this.items.map((el) => el.id).indexOf(id);  
                    this.$http.get('/like/'+ id +'/islikedBoonbyme').then(function(response){
                        this.items[index].liked = response.body;
                    });  
                    if(this.items[index].liked=='false'){
                        alert('false');
                    }else{
                        //this.items[index].liked=true;
                        alert(this.items[index].liked);
                    }

                    //this.items[index].liked =vm.liked;
                },
                likedCard(id){
                    let vm = this;
                    @if(\Session::has('user_id'))
                        this.$http.get('/like/'+ id +'/islikedCardbyme').then(function(response){
                            if(response.body==='true'){               
                                var count = Number($( "#count_"+id ).text()); 
                                var sum = count - 10;
                                $("#count_"+id).html(sum);   
                                $("#unlike_"+id).attr('src','https://image.flaticon.com/icons/svg/1865/1865963.svg');                                                                          
                                this.$http.get('/like/'+ id +'/likedCard').then(function(response){});
                                $("#unlike_"+id).attr('id',   'like_' + id);                                   
                            }else{
                                var count = Number($( "#count_"+id ).text()); 
                                var sum = count + 10;
                                $("#count_"+id).html(sum);
                                $("#text_"+id).html('<span ><span style=" margin: 0px 5px 0px 10px;" id="count_'+id+'" >'+sum +'</span>ล้านปลื้ม</span>');                                                                                                                                                                                                                         
                                $("#like_"+id).attr('src','https://image.flaticon.com/icons/svg/1865/1865880.svg'); 
                                this.$http.get('/like/'+ id +'/likedCard').then(function(response){});
                                $("#like_"+id).attr('id',   'unlike_' + id);   
                                
                            }
                        }, function(error){
                            console.log(error.statusText);
                        });
                    @else
                    this.onOff = true;
                    @endif                  
                },
                sharecard(){
                   this.$http.get('/sharecard/{{$card->id}}').then(function(response){});         
                },         
                // preform API request to the server
                fetch() {
                    this.$http.get('/like/'+ {{$card->id}} +'/islikedCardbyme').then(function(response){
                        this.liked = response.body;
                            if(this.liked=='false'){
                                this.liked=false;
                            }else{
                                this.liked=true;
                            }
                    });  
           
                    
                    let vm = this;
                    var postarray = [];

                 
                    this.show = true;
                },

            },
            mounted() {
                
                // track scroll event
                this.end = true;
                let vm = this;
            },
            created() {
                // get the data by performing API request
                this.fetch();  
            }
        });


        Vue.filter('truncate', function (text) {
          return text.replace(/<\/?[^>]+(>|$)/g, "").replace(/&amp;nbsp;/gi,' ').substring(0, 50) + '...';
        });
        /*
        Vue.filter('likeBoon',function(id){
            return "https://image.flaticon.com/icons/svg/1865/1865963.svg";
           /* this.$http.get('/like/'+ id +'/islikedBoonbyme').then(function(response){
                if(response.body==false){
                    return "https://image.flaticon.com/icons/svg/1865/1865963.svg";
                }else{
                    return "https://image.flaticon.com/icons/svg/1865/1865963.svg";
                }
            });  
        });*/

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
