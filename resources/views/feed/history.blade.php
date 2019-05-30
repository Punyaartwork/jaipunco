@extends('feed.master')
@section('title',$title)
@section('background','#fff')
@section('nav')
<!-- https://image.flaticon.com/icons/svg/263/263115.svg -->
<div class="navcenter" style="white-space: nowrap !important;overflow-y: auto;justify-content: center;
    display: flex;text-align: center;max-width: 450px;margin: 0px auto;">
    <a href="/" style="padding: 10px 15px; font-size: 14px; font-weight: 600;width: 20%;">
        <img src="https://image.flaticon.com/icons/svg/263/263115.svg" style="width: 20px;">
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
    <a href="" style="padding: 10px 15px;font-size: 14px;width: 20%;">
        <img src="https://image.flaticon.com/icons/svg/132/132233.svg" style="width: 20px;">
    </a>

    <!-- https://image.flaticon.com/icons/svg/149/149022.svg -->
    <a href="/more" style="padding: 10px 15px;font-size: 14px;width: 20%;">
        <img src="https://image.flaticon.com/icons/svg/149/149946.svg" style="width: 20px;">
    </a>
</div>
 @stop
@section('feedcontent')
<div  @click="onmark = false" id="coming" style="
    font-family: LayijiMaHaNiYom, sans-serif;
    font-size: xx-large;
    margin: 30px 0px;
    width: 50%;
    float:left;    
    text-align: center;
    ">อ่านล่าสุด</div>
    <div  @click="onmark = true" id="coming" style="
    font-family: LayijiMaHaNiYom, sans-serif;
    font-size: xx-large;
    margin: 30px 0px;
    float:left;
    width: 50%;
    text-align: center;
    ">Bookmark</div>

    @if($data != 0)
    <div v-if="onmark==false" style="
                padding: 10px;
                width: 95%;
                width: 340px;
                margin:10px auto;
            ">
        @foreach($data as $data)
            <?php
            $post = \App\Post::with('user')->with('tag')->find($data['id']);
            ?>
            
            <div style="
                display: inline-block;
                margin: 20px 0px;
            ">
                <img src="{{$post->postDraw}}" style="width: 30%;float: left;"> 
                <div style="font-family: 'cs_prajad', sans-serif;padding: 0px 10px;width: 70%;float: left;">
                <a href='/feed/{{$post->tag->id}}' style="font-size: 16px;">
                {{$post->tag->tagname}}
                </a> 
                <a href='/story/{{$post->id}}'>
                <div style="
                    font-size: 20px;
                    font-weight: 600;
                ">
                {{$post->postName}} 
                </div> 
                <div>
                    อ่านล่าสุดเมื่อ <span  :text-content.prop="{{$data['time']}} | timeSince" ></span>
                </div>
                </div>
                </a>
            </div>
            

        @endforeach 
        </div>
    @else   
    <div id="coming" style="
    font-family: LayijiMaHaNiYom, sans-serif;
    font-size: -webkit-xxx-large;
    margin: 40% 0px;
    width: 100%;
    text-align: center;
    ">ยังไม่มีข้อมูลครับ</div>
    @endif
    
    
    <div v-if="onmark!=false" style="
                padding: 10px;
                width: 95%;
                width: 340px;
                margin:10px auto;
            ">
        @if (\Session::has('user_id'))
            
        @foreach($mark as $mark)
            <?php
            $post = \App\Post::with('user')->with('tag')->find($mark->post_id);
            ?>

            <div style="
                display: inline-block;
                margin: 20px 0px;
            ">
                <img src="{{$post->postDraw}}" style="width: 30%;float: left;"> 
                <div style="font-family: 'cs_prajad', sans-serif;padding: 0px 10px;width: 70%;float: left;">
                <div style="font-size: 16px;">
                {{$post->tag->tagname}}
                </div> 
                <div style="
                    font-size: 20px;
                    font-weight: 600;
                ">
                {{$post->postName}} 
                </div> 
                <div>
                    บันทึกล่าสุดเมื่อ <span  :text-content.prop="{{$mark->markTime}} | timeSince" ></span>
                </div>
                </div>
            </div>
            

        @endforeach 
        </div>
        @else   
        <div id="coming" style="
        font-family: LayijiMaHaNiYom, sans-serif;
        font-size: -webkit-xxx-large;
        margin: 40% 0px;
        width: 100%;
        text-align: center;
        ">กรุณาล็อกอินก่อนใช้งาน</div>
        @endif

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
                onmark:false,
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
                        (document.body.offsetHeight - this.trigger)
                    ) {
                        if (this.display < this.items.length) {
                            this.display = this.display + this.offset;
                            let vm = this;
                        }
                        else {
                            this.end = true;
                        }
                    }
                };
                },
                // preform API request to the server
                fetch() {
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