@extends('feed.master')
@section('title',$title)
@section('background','#74b0c8')
@section('nav')
<!-- https://image.flaticon.com/icons/svg/263/263115.svg -->
<div class="navcenter" style="white-space: nowrap !important;overflow-y: auto;justify-content: center;
display: flex;text-align: center;max-width: 400px;margin: 0px auto;">
    <a  style="padding: 10px 15px; font-size: 14px; font-weight: 600;width: 20%;">
        <img src="https://image.flaticon.com/icons/svg/263/263115.svg" style="width: 20px;">
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
<h1 style="text-align:center;padding-top: 15px;color:#fff">notification</h1>
<div v-for="item in sliced" :key="item.id" v-if="sliced" style="max-width: 400px;   background: rgba(230, 230, 230, 0.7);box-shadow: rgba(0, 0, 0, 0.02) 0px 10px 20px 0px !important;position: relative;height: 66px;border-radius: 8px; margin: 10px auto;">

    <a v-if="item.itemType <= 3">
        <img src="https://image.flaticon.com/icons/svg/132/132284.svg" alt=""style=" border-radius: 4px;width: 16px;height: 16px;background: #eee;top: 8px;position: absolute;left: 12px;">
        <div style=" position: absolute;top: 5px;
        left: 36px;
        color: #444;
        font-size: 14px;
        font-weight: bold;
        ">sadha</div>
    </a>
    <a v-else-if="item.itemType > 3 && item.itemType <= 6">
        <img src="https://image.flaticon.com/icons/svg/70/70157.svg" alt=""style=" border-radius: 4px;width: 16px;height: 16px;background: #eee;top: 8px;position: absolute;left: 12px;">
        <div style=" position: absolute;top: 5px;
        left: 36px;
        color: #444;
        font-size: 14px;
        font-weight: bold;
        ">comments</div>
    </a>
    <a v-else >
        <img src="https://image.flaticon.com/icons/svg/126/126516.svg" alt=""style=" border-radius: 4px;width: 16px;height: 16px;background: #eee;top: 8px;position: absolute;left: 12px;">
        <div style=" position: absolute;top: 5px;
        left: 36px;
        color: #444;
        font-size: 14px;
        font-weight: bold;
        ">messages</div>
    </a>
    <div style=" font-weight: bold;
    font-size: 11px;
    color: #000;
    left: 12px;position: absolute;
    top: 28px;" v-text="item.user.name"></div>
    <div style="color: #111;position: absolute;
    font-size: 11px;
    top: 42px;
    left: 12px;" v-text="item.item"></div>
    <div style="    font-size: 10px;position: absolute;
    color: #222;
    right: 12px;
    top: 8px;" :text-content.prop="item.notificationTime | timeSince">now</div>
</div>


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
                items  : [
                    {
                        id:1,
                        notification_id:7,
                        user_id:8,
                        item_id:10,
                        item:"Ready to go?",
                        itemType:1,
                        notificationStatus:1,
                        notificationTime:1557716160,
                        user:{
                            name:"punyapath"
                        }
                    },
                    {
                        id:2,
                        notification_id:7,
                        user_id:8,
                        item_id:11,
                        item:"Ready to go?",
                        itemType:7,
                        notificationStatus:1,
                        notificationTime:1557716160,
                        user:{
                            name:"Thawanat"
                        }
                    },
                    {
                        id:3,
                        notification_id:7,
                        user_id:8,
                        item_id:12,
                        item:"Ready to go?",
                        itemType:4,
                        notificationStatus:1,
                        notificationTime:1557716160,
                        user:{
                            name:"Suwattana"
                        }
                    }
                ],    // server response data
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