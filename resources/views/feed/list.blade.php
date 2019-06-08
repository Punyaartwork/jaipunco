@extends('feed.master')
@section('title','Jaipun')
@section('background','#fafafa')
@section('nav')
<!-- https://image.flaticon.com/icons/svg/263/263115.svg -->
<div class="navcenter" style="white-space: nowrap !important;overflow-y: auto;justify-content: center;
    display: flex;text-align: center;max-width: 450px;margin: 0px auto;">
    <a href="/" style="padding: 10px 15px; font-size: 14px; font-weight: 600;width: 20%;">
        <img src="https://image.flaticon.com/icons/svg/263/263115.svg" style="width: 20px;">
    </a> 

    <!-- https://image.flaticon.com/icons/svg/865/865132.svg -->
    <a href="/card" style="padding: 10px 15px; font-size: 14px;width: 20%;">
    <img src="https://image.flaticon.com/icons/svg/1001/1001287.svg" style="width: 20px;">
</a> 

     <!--    https://image.flaticon.com/icons/svg/1001/1001399.svg  -->
     
    <a href="" style="padding: 10px 15px; font-size: 14px;width: 20%;">
        <img src="https://image.flaticon.com/icons/svg/1001/1001287.svg" style="width: 20px;">
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
<div style="text-align: center;"> 
<article class="feedlist" v-for="item in sliced" :key="item.id" v-if="sliced" >
    <div class="feedlist-into">
        <a v-bind:href="'/feed/' + item.id">
        <div class="feedlist-text">
            <div style="font-size: 14px;" v-text="item.type.type"></div>    
            <div style="
                font-weight: bold;font-size: 20px;
            " v-text="item.tagname"></div>
            <div style="font-size: 12px;width: 100%;" v-text="item.tagDetail"></div>
            <div v-text="item.user.name"></div>   
            <img src="https://image.flaticon.com/icons/svg/1721/1721997.svg" style="
                width: 15px;
                float: left;
            "> <span class="feedlist-votes" v-text="item.tagVotes"></span>
            <br>    
        </div>
        <div  class="feedlist-draw">
            <img  v-bind:src="item.tagDraw">
        </div>     
        </a>
    <div style="float:left;width:100%">
        <div style="
            padding: 10px;border-top:1px solid #ddd;
        " v-for="data in item.post.slice(0,3)" >
        <a v-bind:href="'/story/' + data.id">
            <div style="
                font-weight: bold;
            " v-text="data.postName" ></div>
            <div style="
                font-size: 14px;
            " v-text="truncate(data.post)" ></div>  
        </a>          
        </div>
    </div>
</article>
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
                            this.$http.get('/api/list?page='+this.page).then(function(response){
                                postarray = response.data;
                                vm.posts = postarray.data;
                                for (var i = 0; i < postarray.data.length; i++) { 
                                this.items.push({
                                    id:postarray.data[i].id,
                                    tagname:postarray.data[i].tagname,  
                                    tagDetail:postarray.data[i].tagDetail, 
                                    tagVotes:postarray.data[i].tagVotes,  
                                    tagDraw:postarray.data[i].tagDraw,   
                                    post:postarray.data[i].post, 
                                    type:postarray.data[i].type,     
                                    user:postarray.data[i].user,                                                                                                                                                                                 
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
                    this.$http.get('/api/list?page='+this.page).then(function(response){
                        postarray = response.data;
                        this.items = postarray.data;             
                    }, function(error){
                        console.log(error.statusText);
                    });
                    this.show = true;
                },
                truncate(text){
                    return text.replace(/<\/?[^>]+(>|$)/g, "").replace(/&amp;nbsp;/gi,' ').substring(0, 50) + '...';
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