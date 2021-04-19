<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Error - <?php \App\Core\Error::code(); ?></title>
    <meta name="author" content="<?php echo AUTHOR ?>">
    <meta name="description" content="<?php echo DESCRIBE ?>">
    <link rel="shortcut icon" href="/MVC/favicon.svg" type="image/vnd.microsoft.icon">
    <?php App\Core\Bundle::Styles("ErrorStyles") ?>
</head>
<body>
<div id="bubble"></div>
<div class="main">
    <h1><?php \App\Core\Error::code(); ?></h1>
    <p>Not Found</p>
    <p><?php \App\Core\Error::message(); ?></p>
    <button id="goBack">Go back</button>
</div>
<?php App\Core\Bundle::Scripts("ContentScripts") ?>
</body>
</html>
