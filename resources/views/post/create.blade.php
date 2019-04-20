<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Laravel</title>

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
     
            </div>
            
            <div style="width: 50%;float: right;height: 100%;padding: 20px;"><div style="max-width: 600px;height: 500px;position: relative;margin-left: auto;margin-right: auto;">
            <!-- WRITE START -->
            <fieldset class="msf_show" style="max-width: 600px;">
            <input name="user_id" type="text" id="txtUsername" placeholder="user_id" style="outline: none;padding: 10px;font-size: 16px;font-weight: 600;width: 100px;border: 1px solid #eee;margin: 10px;border-radius: 10px;">
            <input type="text" name="tag_id" placeholder="tag_id" id="inputA" style="outline: none;padding: 10px;font-size: 16px;font-weight: 600;width: 100px;border: 1px solid #eee;margin: 10px;border-radius: 10px;"><input name="postDraw" type="text" id="txtUsername" placeholder="Draw" style="outline: none;padding: 10px;font-size: 16px;/* font-weight: 600; */width: 250px;border: 1px solid #eee;margin: 10px;border-radius: 10px;">
            <input name="title" type="text" id="txtUsername" placeholder="ชื่อเรื่อง" style="border: none;outline: none;padding: 15px 15px;font-size: 18px;font-weight: 600;border-bottom: 1px solid #eee;width: 90%;/* margin: 20px; */display: block;">
            
            
            <div class="errorpost" style="color:red;"></div>
            <input type="hidden" name="document" id="inputC">
            
            <div style="
            width: 99%;
            position: absolute;
            ">
            <div id="document" contenteditable="true" data-text="เล่าเรื่องของคุณที่นี่" class="post-card-contentform" style="min-height: 100%;border: none;outline: none;padding: 20px 20px;"></div>
            
            <button class="postbutton" onclick="submit()" style="padding: 20px;border: 1px solid #fafafa;background: #00BCD4;border-radius: 10px;color: #fff;margin: 10px;float: right;">POST TO Jaipun</button></div>
            
            
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
    var wrapper = document.querySelector('.wrapper')
    wrapper.innerHTML="";
    $.ajax({
        url:"http://128.199.215.103/api/draw",
        beforeSend: function()
            {
                $('.ajax-load').show();
            }
    }).then(function(emojis) {
        for(var i = 0; i < emojis.length; i++){
            if(emojis[i].draw == null) continue
            wrapper.innerHTML += `
                <button  data-action="insertImage" data-img="/${emojis[i].draw}" ><img    class="emoji-img" src="/${emojis[i].draw}"/></button>
            `
            }

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
    });
    /*** OPEN DRAW END ***/
}); 





//function Send data to datadase
function submit(){
    var doc = document.getElementById("document").innerHTML;
    var inputC = $('#inputC'); //document
    inputC.val(doc);

  var tag_id = $('input[type=text][name=tag_id]').val();
  var title = $('input[type=text][name=title]').val();
  var user_id = $('input[type=text][name=user_id]').val();  
  var postDraw = $('input[type=text][name=postDraw]').val();    
  var content = $('input[type=hidden][name=document]').val();
    alert(":::user_id::" + user_id  + ":::tag_id::" + tag_id + ":::title:: " + title + " :::content::" + content + ":::postDraw::" + postDraw);

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        /* the route pointing to the post function */
        url: '/postsave',
        type: 'POST',
        /* send the csrf-token and the input to the controller */
        data: {_token: CSRF_TOKEN, message:"OK",tag_id:tag_id,title:title,content:content,user_id:user_id,postDraw:postDraw},
        dataType: 'JSON',
        /* remind that 'data' is the response of the AjaxController */
        success: function (data) { 
            alert('Successed Post'); 
            location.reload();
        }
    }); 

}

    </script>
</html>
