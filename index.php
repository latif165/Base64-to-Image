<?php

$base64_image_string = $_POST['base64_image_string'];
$filename = mt_rand(00,99).time();
$output_file_without_extension = './uploads/'.$filename;
$path_with_end_slash = './uploads/';
$signature_file = $this->save_base64_image($base64_image_string, $output_file_without_extension, $path_with_end_slash="" );

function save_base64_image($base64_image_string, $output_file_without_extension, $path_with_end_slash="" )
{
    //usage:  if( substr( $img_src, 0, 5 ) === "data:" ) {  $filename=save_base64_image($base64_image_string, $output_file_without_extentnion, getcwd() . "/application/assets/pins/$user_id/"); }
    //
    //data is like:    data:image/png;base64,asdfasdfasdf
    $splited = explode(',', substr( $base64_image_string , 5 ) , 2);

    $mime=$splited[0];
    $data=$splited[1];

    $mime_split_without_base64=explode(';', $mime,2);
    $mime_split=explode('/', $mime_split_without_base64[0],2);
    if(count($mime_split)==2)
    {
        $extension=$mime_split[1];
        if($extension=='jpeg')$extension='jpg';
        //if($extension=='javascript')$extension='js';
        //if($extension=='text')$extension='txt';
        $output_file_with_extension=$output_file_without_extension.'.'.$extension;
    }
    file_put_contents( $path_with_end_slash . $output_file_with_extension, base64_decode($data) );
    return $output_file_with_extension;
}