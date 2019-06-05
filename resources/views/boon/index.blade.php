@extends('feed.master')
@section('title','Boons | jaipun')
@section('background','#fafafa')
@section('nav')
<link rel="stylesheet" href="fonts/style.css" type="text/css" media="all" />

    <!-- https://image.flaticon.com/icons/svg/263/263115.svg -->
    <div class="navcenter" style="white-space: nowrap !important;overflow-y: auto;justify-content: center;
        display: flex;text-align: center;max-width: 450px;margin: 0px auto;">
        <a href="/" style="padding: 10px 15px; font-size: 14px; font-weight: 600;width: 20%;">
            <img src="https://image.flaticon.com/icons/svg/262/262584.svg" style="width: 20px;">
        </a> 


        <!-- https://image.flaticon.com/icons/svg/865/865132.svg -->
        <a href="/new" style="padding: 10px 15px; font-size: 14px;width: 20%;">
            <img src="https://image.flaticon.com/icons/svg/109/109613.svg" style="width: 20px;">
        </a> 

        <!--     https://image.flaticon.com/icons/svg/1001/1001287.svg -->

        <a href="/list" style="padding: 10px 15px; font-size: 14px;width: 20%;">
            <img src="https://image.flaticon.com/icons/svg/1001/1001399.svg" style="width: 20px;">
        </a>

        <!-- https://image.flaticon.com/icons/svg/132/132233.svg -->
        <a href="/history" style="padding: 10px 15px;font-size: 14px;width: 20%;">
            <img src="https://image.flaticon.com/icons/svg/132/132284.svg" style="width: 20px;">
        </a>

        <!-- https://image.flaticon.com/icons/svg/149/149022.svg -->
        <a href="/more" style="padding: 10px 15px;font-size: 14px;width: 20%;">
            <img src="https://image.flaticon.com/icons/svg/149/149946.svg" style="width: 20px;">
        </a>
    </div>
 @stop
@section('feedcontent')

<style>


.news__col {
  width: 50%;
  display: inline-block;
  transition: all .3s;
}
.news__col:nth-of-type(1) {
  margin-left: -50%;
}
.news__main {
  display: block;
  flex-wrap: wrap;
  overflow: hidden;
}

.callback__arrow-prev {
  left: 30px;
  position: absolute;
  font-size: 50px;
  top: 40%;
  cursor: pointer;
  user-select: none;
}
.callback__arrow-next {
  right: 30px;
  top: 40%;
  position: absolute;
  font-size: 50px;
  cursor: pointer;
  user-select: none;
}

</style>

<div class="container" style="font-family: '2005iannnnnUBC';max-width: 560px;margin: auto;">

<div style="border: 1px solid rgb(234, 237, 241);max-width: 560px;background: rgb(255, 255, 255);border-radius: 10px;margin: 20px 0px;">
    <div style="
    padding: 15px;
    font-size: xx-large;
    text-align: center;
    padding-bottom: 0px;
    ">มาร่วมสร้างสังคมที่เต็มไปด้วยเรื่องบุญ ๆ ด้วยกันกับเรา</div>
    <a href="/boon/create" style="
    text-align: center;
    width: 300px;
    padding: 10px;
    font-size: xx-large;
    border-radius: 5px;
    background: #71dbe8;
    margin: 10px auto;
    color: #fff;display: block;
    ">Add a Boon</a>
</div>

    <article  v-for="item in sliced" :key="item.id" v-if="sliced" style="
    border: 1px solid #eaedf1;
        max-width: 560px;
        background: #fff;
        border-radius: 10px;
        margin:20px 0px;
    ">
    <div style="padding: 10px 15px 5px 15px;">
        <div style="font-size:40px;
        text-align: center;" v-text="item.boonName"></div>
        <div style="font-size: 30px;text-align: center;" v-text="item.boon"></div>

    </div>


        <div class="multislider news__main" style="
        display: block;
        flex-wrap: wrap;
        overflow: hidden;
        position: relative;
        max-width: 560px;
    "><div class="callback__arrow-box"><div v-if="item.photo.length > 1" v-on:click="prev(item.id)"  class="callback__arrow-prev" style="
        left: 15px;
        position: absolute;
        font-size: 50px;
        top: 30%;
        cursor: pointer;
        user-select: none;
    ">&lt;</div> <div v-if="item.photo.length > 1" v-on:click="next(item.id)" class="callback__arrow-next" style="
        right: 15px;
        top: 30%;
        position: absolute;
        font-size: 50px;
        cursor: pointer;
        user-select: none;
    ">&gt;</div>

    </div> 
    <div class="news__container" style="
        white-space: nowrap;
    "><div class="news__col" style="
        margin-left: 0%;
        width: 100%;
        display: inline-block;
        transition: all .3s;
    " :key="photo.id" v-for="photo in item.photo" >
            <div class="news__container">
                <div class="news__col" >
                    <a >
                        <div class="news__prev">
                            <img class="news__img" :src="photo.photo" style="width:100%">
                        </div>
                    </a>
                </div>
            </div>
        </div> 


   <div style="
        font-size: 25px;
        margin: 0px 5px 0px 10px;
    " v-bind:id="'text_'+item.id" ><span  v-if="item.boonLike != 0"><span style=" margin: 0px 5px 0px 10px;" v-bind:id="'count_'+item.id" v-text="item.boonLike"></span>ล้านปลื้ม</span> <span style="float: right;" v-if="item.boonComment != 0"><span style=" margin: 0px 5px 0px 10px;" v-text="item.boonComment"></span>comments</span></div>


    <div style="margin: 15px 20px;">
        <img v-bind:src="item.user.profile" alt="" style="
        margin: 0px 10px 0px 0px;
        border-radius: 100px;
        height: 50px;
        width: 50px;
        object-fit: cover;
        display: inline-block;
        float: left;
        "> 
        <div style="display: inline-block;">
            <div style="font-weight: bold;font-size:26px" v-text="item.user.name"></div>
            <div style="font-size: 18px;" :text-content.prop="item.boonTime | timeSince"></div>
        </div> 
    </div>

<div style="width:100%;display: flow-root;">
    <div style="
    width: 30%;     float: left;    display: inline-block;
    border-top: 1px solid rgb(234, 237, 241);
    ">
    <!-- https://image.flaticon.com/icons/svg/1865/1865880.svg -->
        <div style="padding: 5px 20px;margin: auto;display: table;">
            <img v-bind:id="'like_'+item.id" v-if="item.liked == false" src="https://image.flaticon.com/icons/svg/1865/1865963.svg" @click="likedBoon(item.id)" v-on:click="item.liked = ! item.liked" alt="" style="float: left; width: 25px; margin: 3px 0px;"> 
            <img v-bind:id="'unlike_'+item.id" v-else src="https://image.flaticon.com/icons/svg/1865/1865880.svg" @click="likedBoon(item.id)" v-on:click="item.liked = ! item.liked" alt="" style="float: left; width: 25px; margin: 3px 0px;">
            <div style="display: inline-block;">
                <div style="font-size: 25px; margin: 3px 0px 0px 10px;">ปลื้มเลย<span v-text="item.liked"></span></div>
            </div>
        </div>
    </div>
    <div style="
    width: 35%;       float: left;  display: inline-block;
    border-top: 1px solid rgb(234, 237, 241);
    ">
        <div style="padding: 5px 20px;margin: auto;display: table;">
            <img src="https://image.flaticon.com/icons/svg/134/134819.svg" alt="" style="float: left; width: 25px; margin: 3px 0px;"> 
            <div style="display: inline-block;">
                <div style="font-size: 25px; margin: 3px 0px 0px 10px;">comment</div>
            </div>
        </div>
    </div>
    <!-- https://image.flaticon.com/icons/svg/1787/1787882.svg -->
    <div style="
    width: 35%;      float: left;   display: inline-block;
    border-top: 1px solid rgb(234, 237, 241);
    ">
        <div style="padding: 5px 20px;margin: auto;display: table;">
            <img src="https://image.flaticon.com/icons/svg/1787/1787887.svg" alt="" style="float: left; width: 25px; margin: 3px 0px;"> 
            <div style="display: inline-block;">
                <div style="font-size: 25px; margin: 3px 0px 0px 10px;">ส่งบุญ</div>
            </div>
        </div>
    </div>
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
                liked:null
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
                likedBoon(id){
                    var index = this.items.map((el) => el.id).indexOf(id); 
                    let vm = this;
                    @if(\Session::has('user_id'))
                        this.$http.get('/like/'+ id +'/islikedBoonbyme').then(function(response){
                            if(response.body==='true'){                  
                                this.items[index].liked = false;
                                this.items[index].boonLike - 10;
                                var count = Number($( "#count_"+id ).text()); 
                                var sum = count - 10;
                                $("#count_"+id).html(sum);   
                                $("#unlike_"+id).attr('src','https://image.flaticon.com/icons/svg/1865/1865963.svg');                                                                          
                                this.$http.get('/like/'+ id +'/likedBoon').then(function(response){});
                                $("#unlike_"+id).attr('id',   'like_' + id);                                   
                            }else{
                                this.items[index].liked = true; 
                                this.items[index].boonLike + 10;  
                                var count = Number($( "#count_"+id ).text()); 
                                var sum = count + 10;
                                $("#count_"+id).html(sum);
                                $("#text_"+id).html('<span ><span style=" margin: 0px 5px 0px 10px;" id="count_'+id+'" >'+sum +'</span>ล้านปลื้ม</span>');                                                                                                                                                                                                                         
                                $("#like_"+id).attr('src','https://image.flaticon.com/icons/svg/1865/1865880.svg'); 
                                this.$http.get('/like/'+ id +'/likedBoon').then(function(response){});
                                $("#like_"+id).attr('id',   'unlike_' + id);   
                                
                            }
                        }, function(error){
                            console.log(error.statusText);
                        });
                    @else
                    this.onOff = true;
                    @endif                  
                },
                prev(id) {
                    var index = this.items.map((el) => el.id).indexOf(id);                   
                    var last = this.items[index].photo.pop();
                    this.items[index].photo.splice(0, 0, last)
                },
                next(id) {
                    var index = this.items.map((el) => el.id).indexOf(id);                                                                        
                    var first = this.items[index].photo.shift();
                    this.items[index].photo.push(first)
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
                            this.$http.get('/api/boon/new?page='+this.page).then(function(response){                                                                           
                                postarray = response.data;
                                vm.posts = postarray.data;
                                for (var i = 0; i < postarray.data.length; i++) { 
                                        if(postarray.data[i].like.length > 0){
                                            for (var j = 0; j <postarray.data[i].like.length; j++) { 
                                                @if(\Session::has('user_id'))
                                                    if(postarray.data[i].like[j].user_id == {{\Session::get('user_id')}}){
                                                        postarray.data[i].liked = true;
                                                    }else{
                                                        postarray.data[i].liked = false;
                                                    }
                                                @else
                                                    postarray.data[i].liked = false;                                                
                                                @endif
                                            }
                                        }else{
                                            postarray.data[i].liked = false;
                                        }
                                this.items.push({
                                    id:postarray.data[i].id,
                                    boonName:postarray.data[i].boonName,  
                                    boon:postarray.data[i].boon, 
                                    boonLike:postarray.data[i].boonLike,   
                                    boonComment:postarray.data[i].boonComment, 
                                    boonShare:postarray.data[i].boonShare,
                                    boonTime:postarray.data[i].boonTime,    
                                    user:postarray.data[i].user,                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
                                    photo:postarray.data[i].photo,
                                    like:postarray.data[i].like,   
                                    liked:postarray.data[i].liked,                                                                       
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
                    
                    let vm = this;
                    var postarray = [];
                    this.$http.get('/api/boon/new?page='+this.page).then(function(response){
                        postarray = response.data;
                        this.items = postarray.data;         
                        for (var i = 0; i < this.items.length; i++) { 
                            if(this.items[i].like.length > 0){
                                for (var j = 0; j < this.items[i].like.length; j++) { 
                                    @if(\Session::has('user_id'))
                                    if(this.items[i].like[j].user_id == {{\Session::get('user_id')}}){
                                        this.items[i].liked = true;
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
