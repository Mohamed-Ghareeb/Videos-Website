<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\User;

class Home extends BackEndController
{
    public function __construct(User $model)
    {
        Parent::__construct($model);
    }

    public function index()
    {
        return view('back-end.home');
    }
}
