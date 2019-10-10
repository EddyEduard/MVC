<?php

use App\Core\Controller;

class HomeController extends Controller
{
    public function Index()
    {
        parent::View(["title" => "App MVC"]);
    }

    public function About()
    {
        parent::View(["title" => "About MVC"]);
    }

    public function Contact()
    {
        parent::View(["title" => "Contact MVC"]);
    }
}
