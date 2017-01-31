<?php

namespace App;

use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    use ElasticquentTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'mark_id', 'model_id', 'min_year', 'max_year', 'price_min', 'price_max'
    ];

    protected $mappingProperties = [
        'mark' => [
            'properties' => [
                'name' => [
                    'type' => 'string'
                ]
            ]
        ],
        'model' => [
            'properties' => [
                'name' => [
                    'type' => 'string'
                ]
            ]
        ],
        'min_year' => [
            'type' => 'integer'
        ],
        'max_year' => [
            'type' => 'integer'
        ]
    ];

    /**
     * Get the index name for the model.
     *
     * @return string
     */
    function getIndexName()
    {
        return 'filter';
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function mark()
    {
        return $this->belongsTo('App\Mark');
    }

    public function model()
    {
        return $this->belongsTo('App\AutoModel');
    }

    public function setPriceMinAttribute($value)
    {
        $this->attributes['price_min'] = $value * 100;
    }

    public function getPriceMinAttribute($value)
    {
        return $value / 100;
    }

    public function setPriceMaxAttribute($value)
    {
        $this->attributes['price_max'] = $value * 100;
    }

    public function getPriceMaxAttribute($value)
    {
        return $value / 100;
    }
}
