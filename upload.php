<?php
header('Content-Type: application/json');
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
$formatos = ['.mp4','.avi','.3gp','.mov','.gif'];
if($_FILES['file']['error'] > 0){
    echo json_encode(array('status'=>404,'message'=>'error:'.$_FILES['file']['error']));
} else {
    $name = str_replace("/../", "abc",str_replace(' ','',$_FILES['file']['name']));
    move_uploaded_file($_FILES['file']['tmp_name'], 'public/videos/'.$name);
    $id = generateRandomString(25);
    $url = 'http://localhost:5000/procesar/'.$name;
    $ch = curl_init();
    // Will return the response, if false it print the response
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0); 
    curl_setopt($ch, CURLOPT_TIMEOUT, 1000);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // Set the url
    curl_setopt($ch, CURLOPT_URL,$url);
    // Execute
    $result=curl_exec($ch);
    // Closing
    curl_close($ch);
    echo $result;
}
?> 
