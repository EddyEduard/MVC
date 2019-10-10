<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php HomeController::ViewData("title") ?></title>
    <meta name="author" content="<?php echo AUTHOR ?>">
    <meta name="description" content="<?php echo DESCRIBE ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="shortcut icon" href="favicon.svg"
          type="image/vnd.microsoft.icon">
    <?php HomeController::Styles("BootstrapStyles") ?>
</head>
<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">MVC Framework</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="/App">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="About">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="Contact">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <div class="container">
        <?php HomeController::Content() ?>
    </div>

    <?php
        HomeController::Scripts("BootstrapScripts");
        HomeController::Scripts("APIScripts");
    ?>
</body>
</html>
