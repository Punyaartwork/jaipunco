@extends('feed.master')
@section('title','Types | jaipun')
@section('feedcontent')
<div style="max-width: 520px;margin-left: auto;margin-right: auto;">
    <article  class="feedtype" v-for="item in sliced" :key="item.id" v-if="sliced">
                  <div class="feedtype-text">
                  <a v-bind:href="'/feedtype/' + item.id">
                      <div class="feedtype-title" v-text="item.type"> </div>
                    
                        <div class="feedtype-content" v-text="item.typeDetail">
                        </div>
                        </div>
                        <div class="feedtype-img"><img v-bind:src="item.typeDraw"></div>
                    </a>
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
                            this.$http.get('/api/typenew?page='+this.page).then(function(response){
                                postarray = response.data;
                                vm.posts = postarray.data;
                                for (var i = 0; i < postarray.data.length; i++) { 
                                this.items.push({
                                    id:postarray.data[i].id,
                                    postName:postarray.data[i].postName,  
                                    post:postarray.data[i].post,                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
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
                    this.$http.get('/api/typenew?page='+this.page).then(function(response){
                        postarray = response.data;
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

        </script>
@stop