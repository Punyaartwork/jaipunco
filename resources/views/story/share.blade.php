<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="social-buttons" style="font-size: 25px;float:right;margin-top:10px">
    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($url) }}"
       target="_blank" style="color: #4e71a8 !important;">
       <i class="fa fa-facebook-official"></i>
    </a>
    <a href="https://twitter.com/intent/tweet?url={{ urlencode($url) }}"
       target="_blank" style="color: #1cb7eb !important;">
        <i class="fa fa-twitter-square"></i>
    </a>
    <a href="https://pinterest.com/pin/create/button/?{{ 
        http_build_query([
            'url' => $url,
            'media' => $image,
            'description' => $description
        ]) 
        }}" target="_blank" style="color: #ca3737 !important;">
        <i class="fa fa-pinterest-square"></i>
    </a>
</div>