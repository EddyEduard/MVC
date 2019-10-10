<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Error - <?php echo self::ViewData()->status ?></title>
    <meta name="author" content="Eduard-Nicolae">
    <meta name="description" content="MVC Framework">
    <link rel="shortcut icon" href="<?php echo BASE_ADDRESS . "/" . APP_NAME . "/favicon.svg" ?>" type="image/vnd.microsoft.icon">
    <?php self::Styles("ErrorStyles") ?>
</head>
<body>
    <div id="bubble"></div>
    <div class="main">
        <h1><?php echo self::ViewData()->status ?></h1>
        <p>Not Found</p>
        <p><?php echo self::ViewData()->message ?></p>
        <button id="goBack">Go back</button>
    </div>
    <?php self::Scripts("ContentScripts") ?>
</body>
</html>
