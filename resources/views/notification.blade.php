<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
        $.ajax({        
            type : 'POST',
            url : "https://fcm.googleapis.com/fcm/send",
            headers : {
                Authorization : 'key=' + '<key>'
            },
            contentType : 'application/json',
            dataType: 'json',
            data: JSON.stringify({"to": "<instance ID>", "notification": {"title":"Test","body":"Test"}}),
            success : function(response) {
                console.log(response);
            },
            error : function(xhr, status, error) {
                console.log(xhr.error);                   
            }
        });
});
</script>