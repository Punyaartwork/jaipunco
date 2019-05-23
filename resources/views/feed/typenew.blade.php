@extends('feed.master')
@section('title',$type->type.' | jaipun')
@section('background','#fafafa')
@section('nav')
            <a href="/feedtype/{{$type_id}}" style="
            padding: 10px;
            font-size: 14px;
            ">
                Popular
            </a>
            <div style="
            padding: 10px;
            font-size: 14px;
            border-bottom: 3px solid #74b0c8;
            ">
                    Recent
            </div>
@stop

@section('headpage')
<div style="text-align:center 
    white-space: inherit !important;background:#fff;padding:20px">
<img src="{{$type->typeDraw}}"style="width: 140px;
    margin: auto;
    display: block;">
    <h1  style="margin:0px">{{$type->type}} </h1>
    <div style="white-space: initial !important;">{{$type->typeDetail}} </div>
</div>
@stop
@section('feedcontent')
<div style="max-width: 820px;
margin-left: auto;
margin-right: auto;">
    <div class="feedtag"  v-for="item in sliced"  :key="item.id" v-if="sliced">
        <a v-bind:href="'/feed/' + item.id">
            <div style="padding: 15px;position: absolute;">
                <div class="feedtag-title" v-text="item.tagname" v-bind:style="{ color:tagColor }"></div>
                <div v-html="item.tagDetail" class="feedtag-detail"></div>
                <div class="feedtag-votes">
                    <img src="https://image.flaticon.com/icons/svg/1721/1721997.svg" >
                    <span v-html="item.tagVotes"></span>
                </div>
            </div>

            <div class="feedtag-draw"><img  v-bind:src="item.tagDraw"></div>
        </a>
    </div>
</div>
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
                tagColor:null,
                type:null,
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
                        (document.body.offsetHeight - this.trigger)
                    ) {
                        if (this.display < this.items.length) {
                            this.display = this.display + this.offset;
                            let vm = this;
                            var postarray = [];
                            this.page = this.page+1;
                            this.$http.get('/api/type/new/{{$type_id}}?page='+this.page).then(function(response){
                               
                                postarray = response.data;
                                vm.posts = postarray.data;
                                                       
                                for (var i = 0; i < postarray.data.length; i++) { 
                                this.items.push({
                                    id:postarray.data[i].id,
                                    tagname:postarray.data[i].tagname,  
                                    tagDetail:postarray.data[i].tagDetail,                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
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
                    this.$http.get('/api/type/new/{{$type_id}}?page='+this.page).then(function(response){
                 
                        postarray = response.data;
                        vm.tagColor = postarray.data[0].tagColor;
                        this.items = postarray.data;                    
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