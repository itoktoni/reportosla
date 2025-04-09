<?php

namespace App\Http\Controllers;

use App\Dao\Enums\TransactionType;
use App\Dao\Models\DataBersih;
use App\Dao\Models\DataKotor;
use App\Dao\Models\Rs;
use App\Http\Controllers\Core\ReportController;
use App\Http\Requests\Core\ReportRequest;
use Carbon\Carbon;

class ReportRekapKotorController extends ReportController
{
    public $kotor;

    public function __construct(DataKotor $model)
    {
        $this->model = $model::getModel();
    }

    protected function beforeForm()
    {
        $rs = Rs::getOptions();

        self::$share = [
            'rs' => $rs,
        ];
    }

    public function getKotor()
    {
        $query = DataKotor::query()
            ->where(Rs::field_primary(), request()->get(Rs::field_primary()))
            ->where(DataKotor::field_status(), TransactionType::Kotor)
            ->where('tanggal', '>=', request()->get('start_date'))
            ->where('tanggal', '<=', request()->get('end_date'));

        return $query;
    }

    public function getBersih()
    {
        $query = DataBersih::query()
            ->where(Rs::field_primary(), request()->get(Rs::field_primary()))
            ->where(DataBersih::field_status(), TransactionType::BersihKotor);

        if ($start_date = request()->start_date) {
            $bersih_from = Carbon::createFromFormat('Y-m-d', $start_date) ?? false;
            if ($bersih_from) {
                $query = $query->where('tanggal', '>=', $bersih_from->addDay(1)->format('Y-m-d'));
            }
        }

        if ($end_date = request()->end_date) {
            $bersih_to = Carbon::createFromFormat('Y-m-d', $end_date) ?? false;
            if ($bersih_to) {
                $query = $query->where('tanggal', '<=', $bersih_to->addDay(1)->format('Y-m-d'));
            }
        }

        return $query;
    }

    public function getPrint(ReportRequest $request)
    {
        set_time_limit(0);
        ini_set('memory_limit', '512M');
        $location = $linen = [];

        $rs = Rs::with([HAS_RUANGAN, HAS_JENIS])->find($request->get(Rs::field_primary()));
        $location = $rs->has_ruangan;
        $linen = $rs->has_jenis;

        $kotor = $this->getKotor()->get();
        $bersih = $this->getBersih()->get();

        return moduleView(modulePathPrint(), $this->share([
            'rs' => $rs,
            'bersih' => $bersih,
            'kotor' => $kotor,
            'location' => $location,
            'linen' => $linen,
        ]));
    }
}
