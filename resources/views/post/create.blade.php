<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="/css/fonts.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>POST JAIPUN</title>
        <style>
        #coming{
            display:none;
        }
        @media only screen and (max-width: 820px) {
            #coming{
                display:block;
            }
        }

        </style>
        <div id="coming"style="
            position: absolute;
            width: 100%;
            height: 100%;
            background: #fff;
            z-index: 99;
                    ">
                <div style="
                position: relative;
                font-family: 'LayijiMaHaNiYom', sans-serif;
                top: 30%;
                font-size: -webkit-xxx-large;
                margin: auto;
                display: table;
                ">ยังไม่พร้อมใช้งาน</div>
        </div>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->

        <style>
            * {
                word-wrap: break-word !important;
            }

            h3{
            padding:30px;
            }
            html{ height:100%; }
            body{ min-height:100%; padding:0; margin:0; position:relative; }

            .msf_hide{
                display: none;
            }
            .msf_show{
                display: block;
            }


            button{
                background:none;
                border:none;
                font-weight:600;
                padding:5px 10px;
                font-size:16px;
                font-family: 'cs_prajad', sans-serif;
            }

            fieldset{
                min-height: 100%; 
                background: #fff;
                border: none;
                box-shadow: 0 4px 12px 0 rgba(0,0,0,.05)!important;
                padding:0px;
            }

            .btn_next{
                color:#ff4545;
            }

            [contentEditable=true]:empty:not(:focus):before{
                content:attr(data-text);
            }


            #document img{
            
                display: block;
                margin-left: auto;
                margin-right: auto;
                margin-top: 20px;
                margin-bottom: 20px;
                width: 160px !important;   
            }


            #document * {
                font-family: 'cs_prajad', sans-serif !important;
                word-wrap: break-word !important;
                color:#000 !important;
                background-color:#fff !important;
                font-size: 20px !important;
                line-height: 35px !important;
                /*min-width: 100%;*/
            }

            #document{
                font-family: 'cs_prajad', sans-serif !important;
                word-wrap: break-word !important;
                color:#000 !important;
                background-color:#fff !important;
                font-size: 20px !important;
                line-height: 35px !important;
            }

                
            .wrapper img{
                width:120px;
                margin:20px;
            }

            
            /************************DRAW FORM END*******************************/


            

            </style>
            
    </head>
<body style="background:#fafafa">
    <div style="
    width: 100%;
"><div class="wrapper" style="
width: 50%;
float: left;
position: fixed;
overflow-y: scroll;
height: 100%;
background: #fff;

">
@foreach($draws as $draw)
<button  data-action="insertImage" data-img="{{$draw['draw']}}" ><img    class="emoji-img" src="{{$draw['draw']}}"/></button>
@endforeach
            </div>
            <form action="{{url('post')}}" id="postform" method="post">
            {{ csrf_field() }}
            <div style="width: 50%;float: right;height: 100%;padding: 20px;"><div style="max-width: 600px;height: 500px;position: relative;margin-left: auto;margin-right: auto;">
            <!-- WRITE START -->
            <fieldset class="msf_show" style="max-width: 600px;">
         
            <select name="tag_id"  id="inputA"  style="outline: none;padding: 10px;font-size: 16px;font-weight: 600;width: 100px;border: 1px solid #eee;margin: 10px;border-radius: 10px;">
                @foreach($tags as $tags)
                <option value="{{$tags['id']}}">{{$tags['tagname']}}</option>
                @endforeach
            </select>
            
            <input name="title" type="text" id="txtUsername" placeholder="ชื่อเรื่อง" style="border: none;outline: none;padding: 15px 15px;font-size: 18px;font-weight: 600;border-bottom: 1px solid #eee;width: 90%;/* margin: 20px; */display: block;">
            
            
            <div class="errorpost" style="color:red;"></div>
            <input type="hidden" name="content" id="inputC">
            
            <div style="
            width: 99%;
            position: absolute;
            ">
            <div id="document" contenteditable="true" data-text="เล่าเรื่องของคุณที่นี่" class="post-card-contentform" style="min-height: 100%;border: none;outline: none;padding: 20px 20px;"></div>
            
            <button class="postbutton" onclick="submitform()" style="padding: 20px;border: 1px solid #fafafa;background: #00BCD4;border-radius: 10px;color: #fff;margin: 10px;float: right;">POST TO Jaipun</button></div>
            </form>
            
            </fieldset>
            <!-- WRITE END -->
            
            
            
            
            <div class="writeinfo">
            </div>   
            
                
            </div></div>
</body>
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>

$(document).ready(function () {
    
/*** OPEN DRAW START ***/
$('button').on('click', function(e) {
    var $this = $(this),
            action = $this.data("action");
    
    var aShowDefaultUI = false, aValueArgument = null;
    if($this.data('show-default-ui'))
        aShowDefaultUI = $this.data('show-default-ui');
    

    if($this.data('action') == 'insertImage')
        aValueArgument = $this.data("img");	
    //emojibtn.classList.remove('open');
    
    document.execCommand(action, aShowDefaultUI, aValueArgument);
});
/*** OPEN DRAW END ***/
}); 





//function Send data to datadase
function submitform(){
    var doc = document.getElementById("document").innerHTML;
    var inputC = $('#inputC'); //document
    inputC.val(doc);

  var tag_id = $("#inputA").val();
  var title = $('input[type=text][name=title]').val();
  var user_id = $('input[type=text][name=user_id]').val();  
  var postDraw = $('input[type=text][name=postDraw]').val();    
  var content = $('input[type=hidden][name=content]').val();
    alert("!!!!!!!!!!POST SUCCESS!!!!!!!!!!");
    $('#postform').submit();
}

    </script>
</html>
