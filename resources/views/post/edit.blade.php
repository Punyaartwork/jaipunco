<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel='shortcut icon' href='/css/3ByI2t.ico' type='image/x-icon'>        

  <meta charset="UTF-8">
  <title>Edit Post | jaipun</title>
<link rel="stylesheet" href="/fonts/style.css" type="text/css" media="all" />
<link rel="stylesheet" href="/css/font.css">  
<h1 style="text-align:center">create Edit Post</h1> 
<div style="
    max-width: 560px;
    margin: auto;
    border: 1px solid rgb(234, 237, 241);
    background: rgb(255, 255, 255);
    border-radius: 10px;
">
     

      @if(count($errors) > 0)
          @foreach($errors->all() as $error)
          <p  class="alert alert-danger">{{$error}}</p>
          @endforeach    
      @endif

      @if(\Session::has('success'))
      <p class="alert alert-success">{{ \Session::get('success')}}</p>
      @endif

  <style>
  body{
    background:#fafafa;
    font-family:'2005iannnnnUBC';
  }

  p{
    font-size: 20px;
    text-align: center;
  }

  /* HIDE RADIO */
  [type=radio] { 
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
  }

  /* IMAGE STYLES */
  [type=radio] + img {
    cursor: pointer;
  }

  /* CHECKED STYLES */
  [type=radio]:checked + img {
    outline: 1px solid #eaedf1;
    background: #fafafa;
  }

  .content-article{
    font-family: 'cs_prajad', sans-serif !important;
    word-wrap: break-word;
    margin: 5px;
    color: #000 !important;
    background-color: #fff !important;
    font-size: 20px !important;
    line-height: 45px !important;
}

.content-article img{
    display: block;
    margin-left: auto;
    margin-right: auto;
    margin-top: 20px;
    margin-bottom: 20px;
    width: 160px !important;
}

    
.content-article * {
  font-family: 'cs_prajad', sans-serif !important;
  word-wrap: break-word;
  margin: 5px;
  color:#000 !important;
  background-color:#fff !important;
  font-size: 20px !important;
  line-height: 45px !important;
  /*min-width: 100%;*/
}

.content-article{
  font-family: 'cs_prajad', sans-serif !important;
  word-wrap: break-word;
  margin: 5px;
  color:#000 !important;
  background-color:#fff !important;
  font-size: 20px !important;
  line-height: 45px !important;
  /*min-width: 620px;*/
}
    
  </style>  
  <div id='root' class="box">
    <div style="float:left;margin: 10px; padding: 10px;">
        <button @click="selectionToHtml('bold')" style="border:none;background:none;outline:none"> <img src="https://image.flaticon.com/icons/svg/84/84266.svg" width="30px"></button>   
        <button @click="selectionToHtml('italic')" style="border:none;background:none;outline:none"> <img src="https://image.flaticon.com/icons/svg/84/84008.svg"  width="30px"> </button>
        <button @click="selectionToHtml('underline')" style="border:none;background:none;outline:none;"> <img src="https://image.flaticon.com/icons/svg/84/84212.svg"  width="30px"></button>
        
    </div>
  
    <form action="{{action('PostController@update',$id)}}" method="post">
      {{csrf_field()}}
      <input type="hidden" name="_method" value="PATCH">
      <input type="submit" value="Edit" style="font-size: 20px;border: none;text-align: center;width: 100px;padding: 10px;border-radius: 5px;background: #2196F3;float: right;margin: 10px;color: rgb(255, 255, 255);display: block;">

        <input name="post"  type="hidden" :value="content" >
        <div style="padding:10px 60px 5px;">
          <input style="font-size: 28px; margin-top: 10px;outline:none;border: none;" type="text" name="tag_id" class="form-control" id="email" placeholder="Enter tag_id"  value="{{$post->tag_id}}">
          <input style="font-size: 28px;margin-top: 10px; outline:none;border: none;" type="text" name="postName" class="form-control" id="email" placeholder="Enter postName" value="{{$post->postName}}" >
      

          <div v-focus
            contenteditable="true"
            @input="onInput"
            class="content-article"
          v-html="'{{$post->post}}'"> 
          </div>


          <h2 style="text-align: center;font-weight: normal;border-top: 1px solid rgb(234, 237, 241);padding-top: 25px;">คลิกที่ภาพด้านล่าง เพื่อเลือกภาพวาดประกอบข้างใน</h2>
          <div style="padding: 30px;
          overflow: auto;
          height: 250px;-webkit-overflow-scrolling:touch;">
            @foreach($draws as $draw)
              <label  @click="selectionToIMG('{{$draw->draw}}')" > <img src="{{$draw->draw}}"  width="90px" style="margin:15px"></label>
            @endforeach    
            
          </div>

        <div  style="width:40%;margin:30px auto;">
            <img v-bind:src="picked" style="width:100%;">
          </div>
        </div>

        <h2 style="text-align: center;font-weight: normal;border-top: 1px solid rgb(234, 237, 241);padding-top: 25px;">คลิกที่ภาพด้านล่าง เพื่อเลือกภาพวาดประกอบโพส</h2>
        <div style="padding: 30px;
        overflow: auto;
        height: 250px;-webkit-overflow-scrolling:touch;">
          @foreach($draws as $draw)

          <label >
            <input type="radio" name="postDraw" id="one" value="{{$draw->draw}}" v-model="picked">
            <img src="{{$draw->draw}}" width="90px" style="margin:15px">
          </label>

          @endforeach    
          
        </div>

        </form>

  </div>







</div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js'></script>
  <script src="https://cdn.jsdelivr.net/vue.resource/1.0.3/vue-resource.min.js"></script>
<script>

Vue.directive('focus', {
  // When the bound element is inserted into the DOM...
  inserted: function (el) {
    // Focus the element
    el.focus()
  }
})

new Vue({
  el: '#root',
  data: {
    message: 'Hello Vue',
    picked: '{{$post->postDraw}}',    
    content: null,
  },
  methods: {
    onInput(e) {
      this.content = e.target.innerHTML;
    },
    selectionToHtml(value) {
      document.execCommand(value,false,null)
      var htmlData = document.getElementById('textRef').innerHTML
      this.innerText = htmlData
    },
    selectionToIMG(value) {
      document.execCommand("insertHTML",false,"<img src='"+value+"' >")
      var htmlData = document.getElementById('textRef').innerHTML
      this.innerText = htmlData
    },
  },
})
</script>



