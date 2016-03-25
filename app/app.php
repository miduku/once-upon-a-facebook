<?php
ini_set('error_reporting',E_ERROR | E_WARNING | E_PARSE);

// Pass session data over.
if(!session_id()) {
  session_start();
}
// Include the required dependencies.
require_once __DIR__.'/assets/Facebook/autoload.php';

// get config
$config = json_decode(file_get_contents(__DIR__.'/config/default-test.json'), true);

// root url of app
$rootUrl = 'http://localhost/once-upon-a-facebook/app/';
// $rootUrl = 'http://dustinkummer.com/work/o-u-a-f/';

// Initialize the Facebook PHP SDK v5 using the Facebook namespace.
$fb = new Facebook\Facebook([
  'app_id'                => $config['ID'],
  'app_secret'            => $config['SECRET'],
  'default_graph_version' => 'v2.5'
]);


//////// console logging
function console_log($data) {
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}
// console_log($rootUrl);
?>
