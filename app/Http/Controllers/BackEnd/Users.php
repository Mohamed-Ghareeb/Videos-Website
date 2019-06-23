<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\BackEnd\Users\Store;
use App\Http\Requests\BackEnd\Users\Update;

class Users extends BackEndController
{
    public function __construct(User $model)
    {
        Parent::__construct($model);
    }  

    public function store(Store $request)
    {
        $requestArray = $request->all();
        $requestArray['password'] = Hash::make($requestArray['password']);

        $this->model->create($requestArray);    
        return redirect()->route('users.index');        

    }
      
    public function update($id, Update $request)
    {
        $row = $this->model->findOrfail($id);
        $requestArray = $request->all();
        
        if (isset($requestArray['password']) && $requestArray['password'] != '') {
            $requestArray['password'] = Hash::make($requestArray['password']);
        } else {
           unset($requestArray['password']); 
        }

        $row->update($requestArray);
        return redirect()->back();
    }

}
