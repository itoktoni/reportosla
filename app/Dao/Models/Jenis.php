<?php

namespace App\Dao\Models;

use App\Dao\Entities\JenisEntity;
use App\Dao\Models\Core\SystemModel;

class Jenis extends SystemModel
{
    use JenisEntity;

    protected $perPage = 20;

    protected $table = 'jenis';

    protected $primaryKey = 'jenis_id';

    protected $connection = 'report';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['jenis_id', 'jenis_nama', 'jenis_berat'];

    public static function field_name()
    {
        return 'jenis_nama';
    }

    public function getFieldNameAttribute()
    {
        return $this->{$this->field_name()};
    }

    public function fieldSearching()
    {
        return $this->field_name();
    }
}
