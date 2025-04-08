<?php

namespace App\Dao\Models;

use App\Dao\Models\Core\SystemModel;

class DataKotor extends SystemModel
{
    protected $perPage = 20;

    protected $table = 'data_kotor';

    protected $primaryKey = 'id';

    protected $connection = 'report';

    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'rs_id',
        'ruangan_id',
        'jenis_id',
        'tanggal',
        'status',
        'qty',
    ];

    public static function field_name()
    {
        return 'tanggal';
    }

    public function getFieldNameAttribute()
    {
        return $this->{$this->field_name()};
    }

    public static function field_status()
    {
        return 'status';
    }

    public function getFieldStatusAttribute()
    {
        return $this->{$this->field_status()};
    }

    public static function field_beda_rs()
    {
        return 'beda_rs';
    }

    public function getFieldBedaRsAttribute()
    {
        return $this->{$this->field_beda_rs()};
    }

    public function fieldSearching()
    {
        return $this->field_name();
    }
}
