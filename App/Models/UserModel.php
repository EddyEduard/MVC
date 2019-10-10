<?php

namespace App\Models;

use App\Core\Model;

class UserModel extends Model
{
    public function __construct($database, $table)
    {
        parent::__construct($database, $table);
    }

    public $Id = null;

    public $Username = null;

    public $Email = null;

    public $Password = null;
}

new UserModel(MVC, "User");