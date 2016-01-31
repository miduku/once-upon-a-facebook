<?php
require 'app.php';
require 'app-login.php';
require 'app-logout.php';
require 'app-profile.php';
require 'app-feed.php';
// console_log($accessToken);
// var_dump($profile);
?>

<!doctype html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <title>Facebook Network Communication System</title>

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <link href="//www.google-analytics.com" rel="dns-prefetch">
  <link href="//ajax.googleapis.com" rel="dns-prefetch">
  <link href="assets/css/style.min.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="favicon.png" />

  <script src="assets/components/modernizr.min.js"></script>
  <!--[if lt IE 9]> <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script> <![endif]-->
</head>
<body>

  <header class="header" role="banner">
    <div class="container">
      <h1><a href="page.php">FACEBOOK</a> Network Communication System</h1>
      <p>User:
        <br><a href="profile.php" class="fb-user"><?php echo $profile['name']; ?></a></p>

      <nav class="nav" role="navigation">
        <ul>
          <li class="active"><a href="page.php">Homepage</a></li>
          <li><a href="profile.php">Profile</a></li>
          <li><a href="friends.php">Friends</a></li>
          <li><a href="<?php echo $logoutUrl; ?>">Logout</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <main class="main" role="main">
    <div class="container">

      <?php echo $cFeed; ?>

    </div>
  </main>

  <footer class="footer" role="contentinfo">
    <div class="container">
      <p>Facebook © 1968</p>
    </div>
  </footer>

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="assets/components/dist/jquery.min.js"><\/script>');</script>
  <script src="assets/js/scripts.min.js"></script>

  <script>
  (function(o,u,a,f,F,H,P){u['GoogleAnalyticsObject']=F;o[F]=o[F]||function(){
  (o[F].q=o[F].q||[]).push(arguments)},o[F].P=1*new Date();H=u.createElement(a),
  P=u.getElementsByTagName(a)[0];H.async=1;H.src=f;P.parentNode.insertBefore(H,P)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-XXXXXXXX-XX');
  ga('send', 'pageview');
  </script>

</body>
</html>
