<?php
if (isset($accessToken)) {

  // getting basic info about user
  try {
    $friends_request = $fb->get('/me/friends');

    $friends = $friends_request->getGraphEdge()/*->asArray()*/;

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

// Template: profile
// $cFriends = '
//         <p>In total you have ' . $friends['summary']['total_count'] . ' people in your friends list, including those wo aren\'t using the application.</p>
//         <ul>
// ';

if (isset($friends['data'])) {
  foreach ($friends as $data) {
    $cFriends .= '
      <li><a href="">' . $data['name'] . '</a></li>
    ';
  }
}

$cFriends .= '
        </ul>
';

?>
