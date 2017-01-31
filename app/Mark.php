<?php

namespace App;

use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use ElasticquentTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mark_id', 'name'
    ];

    /**
     * Get the index name for the model.
     *
     * @return string
     */
    function getIndexName()
    {
        return 'mark';
    }

    public function model() {
        return $this->belongsTo('App\AutoModel');
    }

    public function filters() {
        return $this->hasMany('App\Filter');
    }
}
