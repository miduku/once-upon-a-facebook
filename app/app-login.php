<?php
// Choose permissions
$permissions = [
  'email',
  'user_about_me',
  'user_birthday',
  'user_friends',
  'user_likes',
  'user_location',
  'user_work_history',
  'user_education_history',
  'user_posts',
  'user_hometown',
  // 'read_stream',
  'read_custom_friendlists'
]; // optional

$callback = $rootUrl . 'index.php';

// Choose your app context helper
$helper = $fb->getRedirectLoginHelper();

// Check if the user is logged in.
try {
  if (isset($_SESSION['facebook_access_token'])) {
    $accessToken = $_SESSION['facebook_access_token'];
  }
  else {
    $accessToken = $helper->getAccessToken();
  }
} catch( Facebook\Exceptions\FacebookSDKException $e ) {

  // There was an error communicating with Graph
  echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch (Facebook\Exceptions\FacebookSDKException $e) {

  // When validation fails or other local issue
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

// see if we have a session
if ( isset( $accessToken ) ) {

  // User authenticated your app!
  // Save the access token to a session and redirect
  if (isset($_SESSION['facebook_access_token'])) {
    $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
  }
  else {

    // logged in
    // getting short-lived access token
    $_SESSION['facebook_access_token'] = (string) $accessToken;

    // OAuth 2.0 client handler
    $oAuth2Client = $fb->getOAuth2Client();

    // Exchanges a short-lived access token for a long-lived one
    $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
    $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;

    // setting default access token to be used in script
    $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
  }

  // validating the access token
  try {
    $request = $fb->get('/me');
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    if ($e->getCode() == 190) {
      unset($_SESSION['facebook_access_token']);
      $loginUrl = $helper->getLoginUrl($callback, $permissions);
      echo "<script>window.top.location.href='".$loginUrl."'</script>";
    }
    exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }


  // header("Location: ./page.php");
}
elseif ( $helper->getError() ) {

  // The user denied the request
  // You could log this data . . .
  console_log($helper->getError());
  console_log($helper->getErrorCode());
  console_log($helper->getErrorReason());
  console_log($helper->getErrorDescription());


  // You could display a message to the user
  // being all like, "What? You don't like me?"
  exit;
} else {

  // login url
  $loginUrl = $helper->getLoginUrl($callback, $permissions);
}

?>
