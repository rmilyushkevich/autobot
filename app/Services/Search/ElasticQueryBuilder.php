<?php

namespace App\Services\Search;

class ElasticQueryBuilder
{
    private $query;

    private $mustQueries;
    private $filterQueries;

    public static function build()
    {
        return new self();
    }

    public function __construct()
    {
        $this->query = [
            'query' => [
                'bool' => []
            ]
        ];

        $this->mustQueries = [];
        $this->filterQueries = [];
    }

    public function match($field, $value)
    {
        $this->mustQueries[] = [
            'match' => [
                $field => $value
            ],

        ];

        return $this;
    }

    public function rangeFrom($field, $value)
    {
        $this->filterQueries[] = [
            'range' => [
                $field => [
                    'lte' => $value,
                ]
            ]
        ];

        return $this;
    }

    public function rangeTo($field, $value)
    {
        $this->filterQueries[] = [
            'range' => [
                $field => [
                    'gte' => $value,
                ]
            ]
        ];

        return $this;
    }

    public function make()
    {
        if (!empty($this->mustQueries)) {
            $this->query['query']['bool']['must'] = $this->mustQueries;
        }

        if (!empty($this->filterQueries)) {
            $this->query['query']['bool']['filter'] = [
                'bool' => [
                    'must' => $this->filterQueries
                ]
            ];
        }

        return $this->query;
    }
}