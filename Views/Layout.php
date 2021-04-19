<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php App\Core\BaseController::ViewData("title") ?></title>
    <meta name="author" content="<?php echo AUTHOR ?>">
    <meta name="description" content="<?php echo DESCRIPTION ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="shortcut icon" href="/MVC/favicon.svg"
          type="image/vnd.microsoft.icon">
    <?php App\Core\Bundle::Styles("BootstrapStyles"); ?>
</head>
<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="/MVC/">MVC Template</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="/MVC/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="/MVC/About">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="/MVC/Contact">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <?php App\Core\BaseController::Content() ?>
</div>

<?php
App\Core\Bundle::Scripts("BootstrapScripts");
App\Core\Bundle::Scripts("APIScripts");
?>
</body>
</html>
