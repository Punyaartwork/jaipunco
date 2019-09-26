<?php
	// Type your website name or domain name here.
// Generating random image name each time so image name will not be same .
$target_dir = public_path() . "/photos/" .rand() . "_" . time() . ".jpeg";

// Receiving image tag sent from application.
$img_tag = $_POST["image_tag"];



if(move_uploaded_file($_FILES['image']['tmp_name'], $target_dir)){
		
    // Adding domain name with image random name.
    $target_dir = $domain_name . $target_dir ;
    
    // Inserting data into MySQL database.
    mysql_query("insert into image_upload_table ( image_tag, image_path) VALUES('$img_tag' , '$target_dir')");
    
    $MESSAGE = "Image Uploaded Successfully." ;
        
    // Printing response message on screen after successfully inserting the image .	
    echo json_encode($MESSAGE);
}
?>