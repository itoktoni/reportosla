<?php

namespace App\Http\Requests\Core;

use App\Dao\Traits\ValidationTrait;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
{
    use ValidationTrait;

    public function validation(): array
    {
        return [
            'start_date' => 'required',
            'end_date' => 'required',
        ];
    }

    public function withValidator($validator)
    {
        $start_date = Carbon::parse(request()->start_date);
        $end_date = Carbon::parse(request()->end_date);

        $diff = abs($start_date->diffInDays($end_date));

        $validator->after(function ($validator) use($diff) {

            $max = env('REPORT_MAX_DAYS', 7);
            if($diff > $max)
            {
                $validator->errors()->add('end_date', 'Tidak Boleh lebih dari '.$max.' hari');
            }
        });
    }
}
