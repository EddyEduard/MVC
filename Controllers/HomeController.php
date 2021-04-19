<?php

use App\Core\BaseController;

class HomeController extends BaseController
{
    public function Index()
    {
        parent::View(["title" => "MVC"]);
    }

    public function About()
    {
        parent::View(["title" => "MVC - About"]);
    }

    public function Contact()
    {
        parent::View(["title" => "MVC - Contact"]);
    }
}
