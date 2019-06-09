
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel='shortcut icon' href='/css/3ByI2t.ico' type='image/x-icon'>        

  <meta charset="UTF-8">
  <title>create card | jaipun</title>
<link rel="stylesheet" href="/fonts/style.css" type="text/css" media="all" />
<div style="text-align:center;font-weight: 100;font-size: 50px;">สร้างการ์ด</div>

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
  </style>
  <div id='root' class="box">
    <div style="float:left;margin: 10px; padding: 10px;">
        <button @click="selectionToHtml('bold')" style="border:none;background:none;outline:none"> <img src="https://image.flaticon.com/icons/svg/84/84266.svg" width="30px"></button>   
        <button @click="selectionToHtml('italic')" style="border:none;background:none;outline:none"> <img src="https://image.flaticon.com/icons/svg/84/84008.svg"  width="30px"> </button>
        <button @click="selectionToHtml('underline')" style="border:none;background:none;outline:none;"> <img src="https://image.flaticon.com/icons/svg/84/84212.svg"  width="30px"></button>
    </div>
  <form action="{{url('card')}}" method="post">
      {{csrf_field()}}

        <input type="submit" value="Post" style="font-size: 20px;border: none;text-align: center;width: 100px;padding: 10px;border-radius: 5px;background: rgb(113, 219, 232);float: right;margin: 10px;color: rgb(255, 255, 255);display: block;">
    


        <input name="card"  type="hidden" :value="content" >
        <div style="padding:10px 60px 5px;text-align:center">
          <div v-focus
            contenteditable="true"
            @input="onInput"
            style="font-size: 40px;
            margin-top: 100px;
            outline:none;
            border-bottom: 1px solid #eaedf1;"
          >
          </div>
          <div  style="width:40%;margin:30px auto;">
            <img v-bind:src="picked" style="width:100%;">
          </div>
        </div>

        <h2 style="text-align: center;font-weight: normal;border-top: 1px solid rgb(234, 237, 241);padding-top: 25px;">คลิกที่ภาพด้านล่าง เพื่อเลือกภาพวาดประกอบการ์ด</h2>
        <div style="padding: 30px;
        overflow: auto;
        height: 250px;-webkit-overflow-scrolling:touch;">
          @foreach($draws as $draw)

          <label >
            <input type="radio" name="cardPhoto" id="one" value="/{{$draw->draw}}" v-model="picked">
            <img src="/{{$draw->draw}}" width="90px" style="margin:15px">
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
    picked: null,    
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
  },
})
</script>
