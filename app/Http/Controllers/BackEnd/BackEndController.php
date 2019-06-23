<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;

class BackEndController extends Controller
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $rows        = $this->model;
        $rows        = $this->filter($rows);
        $with        = $this->with();
        if (!empty($with)) {
            $rows    = $rows->with($with);
        }
        $rows        = $rows->paginate(10);

        $moduleName  = $this->pluralModelName();
        $sModuleName = $this->getModelName();
        $routeName   = $this->getClassNameFromModel();
        $pageTitle   = 'Control ' . $moduleName;
        $pageDesc    = 'Here You Can Add / Edit / Delete ' . $moduleName;
    
        return view('back-end.'. $this->getClassNameFromModel() .'.index', compact(
            'rows',
            'moduleName',
            'pageTitle',
            'pageDesc',
            'sModuleName',
            'routeName',
        ));
    }

    public function create()
    {
        $moduleName = $this->getModelName();
        $folderName = $this->getClassNameFromModel();
        $routeName  = $folderName;
        $pageTitle  =  'Create ' . $moduleName;
        $pageDesc   = 'Here You Can Create ' . $moduleName;
        $append     = $this->append();

        return view('back-end.'. $folderName .'.create', compact(
            'moduleName',
            'pageTitle',
            'pageDesc',
            'folderName',
            'routeName',
        ))->with($append);
    }

    public function edit($id)
    {
        $row        = $this->model->findOrfail($id);
        $moduleName = $this->getModelName();
        $folderName = $this->getClassNameFromModel();
        $routeName  = $folderName;
        $pageTitle  =  'Edit ' . $moduleName;
        $pageDesc   = 'Here You Can Edit ' . $moduleName;
        $append     = $this->append();

        return view('back-end.'. $folderName .'.edit', compact(
            'row',
            'moduleName',
            'pageTitle',
            'pageDesc',
            'folderName',
            'routeName', 
        ))->with($append);
    }

    public function destroy($id)
    {
        $row = $this->model->findOrfail($id)->delete();
        return redirect()->route($this->getClassNameFromModel() . '.index');
    }

    public function getClassNameFromModel()       //  This Function Get The Name Of Model And Plural It And Convert it To Small Case ex.[ users ]
    {
        return strtolower($this->pluralModelName());
    }

    protected function pluralModelName()         //  This Function Get The Name Of Model And Plural It ex.[ Users ]
    {
        return str_plural($this->getModelName());
    }

    protected function getModelName()           //  This Function Get The Name Of Model ex.[ User ]
    {
        return class_basename($this->model);
    }

    protected function with()
    {
        return [];
    }

    protected function append()
    {
        return [];
    }

    protected function filter($rows)
    {
        return $rows;
    }
}   