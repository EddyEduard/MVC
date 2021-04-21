# MVC Template
This project is a template based on the MVC (Model-View-Controller) 
architectural model created to be used in the development of websites 
and web applications. This template can be used for creating 
applications / websites and Web APIs.

## Installation
Use the package manager [git](https://git-scm.com/) to install this template:
```bash
git clone https://github.com/EddyEduard/MVC.git
```

## Usage
Let's talk about how to use the routes, models and libraries in any project:
### Routes
The general form for initializing a route which calls an action from a controller is:
```php
use App\Core\Route;

Route::Get("/Your/Path/{here}", [
    "controller" => "ControllerName",
    "action" => "ActionName"
]);
```
Or, the general form for initializing a route which call a callback function is:
```php
use App\Core\Route;

Route::Get("/Your/Path/{here}", function($here){
    echo $here;
});
```

### Models
To create a model the general form is shown below:
```php
use App\Core\Model;

class TableModel extends Model
{
    public function __construct($database, $table)
    {
        parent::__construct($database, $table);
    }

    public $Id;

    ...
}

new UserModel(DATABASE, "TableName");
```
The variable named DATABASE is a global variable defined in the [config.php](https://github.com/EddyEduard/MVC/blob/master/Config/Config.php) 
and which contains all configuration for connecting to a certain database.

### Libraries
To add new libraries in the project you need to put their paths in the
following array (file [Application.php](https://github.com/EddyEduard/MVC/blob/master/Core/Application.php)  column 15):
 ```php
    private $libraries_files = [
        "Database" => [
            "MySQLConnection", "MySQLDatabase"
        ],
        "Storage" => [
            "Cookie", "Session"
        ]
    ];
```
If these paths are missing, the libraries will not be included in the application.  

## License
Distributed under the MIT License. See [MIT](https://github.com/EddyEduard/MVC/blob/master/LICENSE) for more information.

## Contact
Eduard-Nicolae - [eduard_nicolae@yahoo.com](mailTo:eduard_nicolae@yahoo.com)
\
Project link - [https://github.com/EddyEduard/MVC](https://github.com/EddyEduard/MVC.git)