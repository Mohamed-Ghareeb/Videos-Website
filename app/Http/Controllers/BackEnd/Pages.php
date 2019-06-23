<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Page;
use App\Http\Requests\BackEnd\Pages\Store;

class Pages extends BackEndController
{
    public function __construct(Page $model)
    {
        Parent::__construct($model);
    }

    public function store(Store $request)
    {
        $this->model->create($request->all());
        return redirect()->route('pages.index');
    }

    public function update($id, Store $request)
    {
        $row = $this->model->findOrfail($id);
        $row->update($request->all());
        return redirect()->back();
    }
}
