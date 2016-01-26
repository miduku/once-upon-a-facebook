<?php
$callback = $rootUrl . 'index.php';

if ( isset( $accessToken ) ) {
  // get logout url
  $logoutUrl = $helper->getLogoutUrl($accessToken, $callback);
} else {
  // redirecting user back to app login page
  header("Location: ./index.php");
}


?>
