<?php
$ds          = DIRECTORY_SEPARATOR;  //1

$storeFolder = 'music';   //2

if (!empty($_FILES)) {

    $file = './music-title.json';
    $json = json_decode(file_get_contents($file), true);
    $path = "Music";

    $json[$path][] = array("title" => $_FILES["file"]['name']);
    file_put_contents($file, json_encode($json));

    $tempFile = $_FILES['file']['tmp_name'];          //3

    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4

    $targetFile =  $targetPath. $_FILES['file']['name'];  //5

    move_uploaded_file($tempFile,$targetFile); //6

}
?>
