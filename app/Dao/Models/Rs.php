<?php

namespace App\Dao\Models;

use App\Dao\Models\Core\SystemModel;

/**
 * Class Rs
 *
 * @property $rs_id
 * @property $rs_name
 * @property $rs_user_id
 * @property User $user
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Rs extends SystemModel
{
    protected $perPage = 20;

    protected $table = 'rs';

    protected $primaryKey = 'rs_id';

    protected $connection = 'report';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['rs_id', 'rs_nama'];

    public static function field_name()
    {
        return 'rs_nama';
    }

    public function getFieldNameAttribute()
    {
        return $this->{$this->field_name()};
    }

    public function fieldSearching()
    {
        return $this->field_name();
    }

    public function has_ruangan()
    {
        return $this->belongsToMany(Ruangan::class, 'rs_dan_ruangan', Rs::field_primary(), Ruangan::field_primary());
    }

    public function has_jenis()
    {
        return $this->hasMany(Jenis::class, Jenis::field_rs_id(), $this->field_primary());
    }
}
