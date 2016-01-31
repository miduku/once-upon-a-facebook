<?php
if (isset($accessToken)) {

  // getting feed from the users wall
  try {
    $feed_request = $fb->get('me/feed?fields=message,from,likes,type,created_time,updated_time,picture,comments{message,like_count,from,created_time}&limit=20}');

    $feed = $feed_request->getGraphEdge()->asArray();

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

// Template: feed
$cFeed = '';

foreach ($feed as $data) {
  $cFeed .= '
    <article>
      <h2><a href="' . $data['from']['id'] . '">' . $data['from']['name'] . '</a> shared a ' . $data['type'] . '</h2>
      <time class="fb-time" datetime="' . date_format($data["updated_time"], 'Y-m-d H:i:s') . '">' . date_format($data["updated_time"], 'Y-m-d H:i:s') . '</time>
  ';

    // if there are pictures
    if (isset($data['picture'])) {
      $cFeed .= '
        <p class="message"><a href="' . $data['picture'] . '" target="_blank">[external picture]</a></p>
      ';
    }

    // if there are message
    if (isset($data['message'])) {
      $cFeed .= '
        <p class="message">' . $data['message'] . '</p>
      ';
    }

    // if there are likes
    if (!isset($data['likes'])) {
      $cFeed .= '
        <span class="fb-like"><a href="">LIKE</a> (0)</span>
      ';
    } else {
      $cFeed .= '
        <span class="fb-like"><a href="">LIKE</a> (' . count($data['likes']) . ')</span>
      ';
    }

    $cFeed .= '
      <span class="fb-comment"><a href="">COMMENT</a></span>
    ';

    // comments
    if (isset($data['comments'])) {
      $cFeed .= '
        <section class="comments">
      ';

      foreach ($data['comments'] as $comments) {
        $cFeed .= '
          <div class="comment">
            <h3><a href="">' . $comments['from']['name'] . '</a> commented</h3>
            <time class="fb-time" datetime="' . date_format($comments["created_time"], 'Y-m-d H:i:s') . '">' . date_format($comments["created_time"], 'Y-m-d H:i:s') . '</time>
            <p class="message">' . $comments['message'] . '</p>
              <span class="fb-like"><a href="">LIKE</a> (' . $comments['like_count'] . ')</span>
              <span class="fb-reply"><a href="">REPLY</a></span>
          </div>
        ';
      }

      $cFeed .= '
        </section>
      ';
    }

  $cFeed .= '
    </article>
  ';
}

$cFeed .= '
  <nav class="nav-pagination">
    <ul>
      <li><a href="' . $feed['paging']['previous'] . '"><< Previous page</a></li> |
      <li><a href="' . $feed['paging']['next'] . '">Next page >></a></li>
    </ul>
  </nav>
';

?>
