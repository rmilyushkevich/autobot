<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AutoModel extends Model
{
    protected $table = 'models';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function marks() {
        return $this->hasMany('App\Model');
    }

    public function filters() {
        return $this->hasMany('App\Filter');
    }
}
