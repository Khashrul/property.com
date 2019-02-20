<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 6/13/2017
 * Time: 2:32 PM
 */

namespace app\helpers;


class ImageHelper
{
    function __construct() {
        \Cloudinary::config(array(
            "cloud_name" => "dtiozlg5h",
            "api_key" => "459393383463192",
            "api_secret" => "y1grj3lryxPLQB8YTWfAAtAK8RA"
        ));
    }
    public function getScaledImageFromCloudinary($image_path,$config_array = array()){
        if($image_path != ''){
            echo fetch_image_tag($image_path,$config_array);
        } else {
            echo fetch_image_tag('http://ad-dwit-a.s3.amazonaws.com/1491289149.jpg',$config_array);
        }
    }
}