<?php

namespace App\Http\Controllers\BackEnd;
use App\Models\Tag;
use App\Http\Requests\BackEnd\Tags\Store;

class Tags extends BackEndController
{
    public function __construct(Tag $model)
    {
        Parent::__construct($model);
    }

    public function store(Store $request)
    {
        $this->model->create($request->all());
        return redirect()->route('tags.index');
    }

    public function update($id, Store $request)
    {
        $row = $this->model->findOrfail($id);
        $row->update($request->all());
        return redirect()->back();
    }
}
