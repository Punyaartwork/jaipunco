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
    <a href="" style="padding: 10px 15px;font-size: 14px;width: 20%;">
        <img src="https://image.flaticon.com/icons/svg/149/149946.svg" style="width: 20px;">
    </a>
</div>
 @stop
@section('feedcontent')
<div id="coming" style="
font-family: LayijiMaHaNiYom, sans-serif;
font-size: -webkit-xxx-large;
margin: 40% 0px;
width: 100%;
text-align: center;
">ยังไม่พร้อมใช้งาน</div>
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