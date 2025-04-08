<?php

namespace App\Dao\Entities;

use App\Dao\Models\Kategori;
use App\Dao\Models\Rs;
use App\Dao\Models\ViewTotalJenis;

trait JenisEntity
{
    public static function field_primary()
    {
        return 'jenis_id';
    }

    public function getFieldPrimaryAttribute()
    {
        return $this->{$this->field_primary()};
    }

    public static function field_name()
    {
        return 'jenis_nama';
    }

    public function getFieldNameAttribute()
    {
        return $this->{$this->field_name()};
    }

    public static function field_description()
    {
        return 'jenis_deskripsi';
    }

    public function getFieldDescriptionAttribute()
    {
        return $this->{$this->field_description()};
    }

    public static function field_rs()
    {
        return 'jenis_id_rs';
    }

    public function getFieldRsAttribute()
    {
        return $this->{$this->field_rs()};
    }

    public static function field_rs_id()
    {
        return 'jenis_id_rs';
    }

    public function getFieldRsIdAttribute()
    {
        return $this->{$this->field_rs_id()};
    }

    public function getFieldRsNameAttribute()
    {
        return $this->{Rs::field_name()};
    }

    public static function field_parstock()
    {
        return 'jenis_parstok';
    }

    public function getFieldParstockAttribute()
    {
        return $this->{$this->field_parstock()};
    }

    public static function field_weight()
    {
        return 'jenis_berat';
    }

    public function getFieldWeightAttribute()
    {
        return $this->{$this->field_weight()} ?? 0;
    }

}
