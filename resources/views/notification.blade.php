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
            data: JSON.stringify({"to": "1:40654945219:android:e722604c88e7d2f9bcdb76", "notification": {"title":"Test","body":"Test"}}),
            success : function(response) {
                alert('success'+response);
            },
            error : function(xhr, status, error) {
                alert('error'+xhr.error);                   
            }
        });
});
</script>