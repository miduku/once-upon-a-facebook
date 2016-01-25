<?php
// Pass session data over.
session_start();

// Include the required dependencies.
require ('assets/Facebook/autoload.php');


// get config
$config = json_decode(file_get_contents('config/default-test.json'), true);


// Initialize the Facebook PHP SDK v5.
$fb = new Facebook\Facebook([
  'app_id'                => $config['ID'],
  'app_secret'            => $config['SECRET'],
  'default_graph_version' => 'v2.5'
]);


// console logging
function console_log($data) {
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}

console_log($fb);
?>
