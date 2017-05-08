<?php
if (is_ajax()) {
    test_function();
}

//Function to check if the request is an AJAX request
function is_ajax() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function test_function(){
    $file = './dates.json';
    $json = json_decode(file_get_contents($file), true);
    $path = "dates";

    $json[$path][] = array("place" => $_POST['place'], "desc" => $_POST['desc'], "date" => $_POST['date']);
    file_put_contents($file, json_encode($json));
}

?>
