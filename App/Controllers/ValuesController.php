<?php

include "Models\UserModel.php";

use App\Core\APIController;
use App\Core\RequestCore as Request;
use App\Models\UserModel as User;

class ValuesController extends APIController
{
    public function All()
    {
        parent::OK(User::all());
    }

    public function Find($column, $value)
    {
        parent::OK(User::find($column, $value));
    }

    public function Where($column, $value)
    {
        parent::OK(User::where($column, $value));
    }

    public function Insert()
    {
        $request = new Request();

        $request->validate([
            "username" => "required|type:string|max:100|min:6",
            "email" => "required|type:string|max:80|min:10"
        ]);

        parent::OK(User::insert($request->body()));
    }

    public function Update($id)
    {
        $request = new Request();
        parent::OK(User::update($id, $request->body()));
    }

    public function Delete($id)
    {
        parent::OK(User::delete($id));
    }
}