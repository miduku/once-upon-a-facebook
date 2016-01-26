<?php
if (isset($accessToken)) {

  // getting basic info about user
  try {
    $profile_request = $fb->get('/me?fields=name,first_name,last_name,email');
    $profile = $profile_request->getGraphNode()->asArray();
  } catch(Facebook\Exceptions\FacebookResponseException $e) {

    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    session_destroy();

    // redirecting user back to app login page
    header("Location: ./index.php");
      exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {

    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage() . '  ' . $accessToken;
      exit;
  }
}
?>
