<?php
require 'app.php';
require 'app-login.php';
console_log($accessToken);
// console_log($loginUrl);
console_log($_SESSION);
console_log($_COOKIE);
// session_destroy();
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

  <script src="assets/components/modernizr.min.js"></script>
  <!--[if lt IE 9]> <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script> <![endif]-->
</head>
<body>

  <header class="header" role="banner">
    <div class="container">
      <h1><a href="index.html">FACEBOOK</a> Network Communication System</h1>
      <p>Please enter your access credentials to enter the most advanced communications system in the world.</p>
    </div>
  </header>

  <main class="main" role="main">
    <div class="container">
      <article>
        <form>

          <div class="field">
            <label for="">Username</label>
            <input type="text" class="full-width" value="user@fb" disabled>
          </div>
          <div class="field">
            <label for="">Password</label>
            <input type="text" class="full-width" value="***********" disabled>
          </div>

          <em>For this Demo you only need to login with your existing Facebook account and accept the Facebook App 'O-U-A-F'</em>
          <br><br>
          <?php if(isset($accessToken)): ?>
          <a href="page.php" class="tab">Enter</a>
          <?php else: ?>
          <a href="<?php echo $loginUrl; ?>" class="tab">Log in with your Facebook account</a>
          <?php endif; ?>

        </form>
      </article>
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
  (function(f,i,r,e,s,h,l){i['GoogleAnalyticsObject']=s;f[s]=f[s]||function(){
  (f[s].q=f[s].q||[]).push(arguments)},f[s].l=1*new Date();h=i.createElement(r),
  l=i.getElementsByTagName(r)[0];h.async=1;h.src=e;l.parentNode.insertBefore(h,l)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-XXXXXXXX-XX');
  ga('send', 'pageview');
  </script>

</body>
</html>
