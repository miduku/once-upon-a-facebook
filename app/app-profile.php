<?php
if (isset($accessToken)) {

  // getting basic info about user
  try {
    $profile_request = $fb->get('/me?fields=name,first_name,last_name,email,work,education,bio,location,hometown');

    $profile = $profile_request->getGraphNode()/*->asArray()*/;

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
$cProfile = '
  <article>
    <h2>About YOU</h2>

    <ul class="list-unstyled">
';

// Bio
if (isset($profile['bio'])) {
  $cProfile .= '
      <li>Bio:
        <ul>
          <li>' . $profile['bio'] . '</li>
        </ul>
      </li>
  ';
}

// Location
if (isset($profile['location'])) {
  $cProfile .= '
      <li>Location:
        <ul>
          <li>' . $profile['location']['name'] . '</li>
        </ul>
      </li>
  ';
}

// Hometown
if (isset($profile['hometown'])) {
  $cProfile .= '
      <li>Hometown:
        <ul>
          <li>' . $profile['hometown']['name'] . '</li>
        </ul>
      </li>
  ';
}

// Work
if (isset($profile['work'])) {
  $cProfile .= '
      <li>Work:
        <ul>
  ';

  foreach ($profile['work'] as $work) {
    $cProfile .= '
            <li>' . $work['employer']['name'] . '
              <ul>
    ';

      if (isset($work['description'])) {
        $cProfile .= '<li>Description: ' . $work['description'] . '</li>';
      }

      if (isset($work['position'])) {
        $cProfile .= '<li>Position: ' . $work['position']['name'] . '</li>';
      }

      if (isset($work['start_date'])) {
        $cProfile .= '<li>Employed from ' . $work['start_date'];
      } else {
        $cProfile .= '<li>Employed from --';
      }
      if (isset($work['end_date'])) {
        $cProfile .= ' to ' . $work['end_date'] . '</li>';
      } else {
        $cProfile .= ' to --</li>';
      }


    $cProfile .= '
                <li>Located in ' . $work['location']['name'] . '</li>
              </ul>
            </li>
    ';
  }

  $cProfile .= '
        </ul>
      </li>
  ';
}

// Education
if (isset($profile['education'])) {
  $cProfile .= '
      <li>Education:
        <ul>
  ';

  foreach ($profile['education'] as $education) {
    $cProfile .= '
            <li>' . $education['school']['name'] . ' (' . $education['type'] . ')
    ';

      if (isset($education['year'])) {
        $cProfile .= '
              <ul>
                <li>Year: ' . $education['year']['name'] . '</li>
              </ul>
        ';
      }


    $cProfile .= '
            </li>
    ';
  }

  $cProfile .= '
        </ul>
      </li>
  ';
}

$cProfile .= '
    </ul>

  </article>
';


?>
