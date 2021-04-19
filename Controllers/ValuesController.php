<?php

use App\Core\APIController;
use App\Core\Request as Request;
use App\Models\UserModel as User;

class ValuesController extends APIController
{
    // Get users.
    public function Get()
    {
        parent::OK(User::all());
    }

    // Get a user by id.
    public function GetById($id)
    {
        $user = User::find("Id", $id);

        if ($user != null)
            parent::OK($user);
        else
            parent::NotFound(["error" => "There is no a user with this id.", "status" => 404]);
    }

    // Find a user by a column and value.
    public function Find($column, $value)
    {
        parent::OK(User::find($column, $value));
    }

    // Select users by a column and value.
    public function Where($column, $value)
    {
        parent::OK(User::where($column, $value));
    }

    // Insert a new user.
    public function Post()
    {
        $request = new Request();

        $isValidate = $request->validate([
            "Username" => "required|type:string|max:30|min:3",
            "Email" => "required|type:string|max:50|min:20",
            "Age" => "required|type:integer|max:2|min:1"
        ]);

        if (is_array($isValidate))
            parent::Fail($isValidate);
        else
            parent::OK(User::insert($request->body()));
    }

    // Update a user by id.
    public function Put($id)
    {
        $user = User::find("Id", $id);

        if ($user == null)
            parent::NotFound(["error" => "There is no a user with this id.", "status" => 404]);
        else {
            $request = new Request();

            $isValidate = $request->validate([
                "Username" => "required|type:string|max:30|min:3",
                "Email" => "required|type:string|max:50|min:20",
                "Age" => "required|type:integer|max:2|min:1"
            ]);

            if (is_array($isValidate))
                parent::Fail($isValidate);
            else
                parent::OK(User::update($id, $request->body()));
        }
    }

    // Delete a user by id.
    public function Delete($id)
    {
        $user = User::find("Id", $id);

        if ($user != null)
            parent::OK(User::delete($id));
        else
            parent::NotFound(["error" => "There is no a user with this id.", "status" => 404]);
    }
}