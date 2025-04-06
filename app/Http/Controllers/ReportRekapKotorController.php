<?php

namespace App\Http\Controllers;

use App\Facades\Model\UserModel;
use App\Http\Controllers\Core\ReportController;
use App\Http\Requests\Core\ReportRequest;
use Illuminate\Http\Request;

class ReportRekapKotorController extends ReportController
{
    public $data;

    public function __construct(UserModel $model)
    {
        $this->model = $model::getModel();
    }

    public function getData()
    {
        $query = $this->model->dataRepository();

        return $query;
    }

    public function getPrint(ReportRequest $request)
    {
        dd($request->all());
        set_time_limit(0);

        $this->data = $this->getData($request);

        return moduleView(modulePathPrint(), $this->share([
            'data' => $this->data,
        ]));
    }
}
