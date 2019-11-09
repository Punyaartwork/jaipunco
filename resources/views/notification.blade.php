<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
        $.ajax({        
            type : 'POST',
            url : "https://fcm.googleapis.com/fcm/send",
            headers : {
                Authorization : 'key=' + 'AIzaSyCu4hAVR2msOjx7B_eyn95y1kkTqfU1yGM'
            },
            contentType : 'application/json',
            dataType: 'json',
            data: JSON.stringify({"to": "eJN2WRYJP4k:APA91bGrjsht9ga_ef4VcK9LA3QoYTbxpLZG5xCdsWZ0b2J4I-pVqraYVrMOOLajVawRQXiMXghTQJRJJbeR8g_TZaBhJQOIE23BDqj7QVCIXuF02EywRBAIFjfU7g18EFh2pdfZByia", "notification": {"title":"Test","body":"Test"}}),
            success : function(response) {
                alert('success'+JSON.stringify(response));
            },
            error : function(xhr, status, error) {
                alert('error'+xhr.error);                   
            }
        });
});
</script>
<?
$ch = curl_init();
?>