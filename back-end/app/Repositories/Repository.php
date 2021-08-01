<?php


namespace App\Repositories;


use Illuminate\Pagination\LengthAwarePaginator;

class Repository
{

    private $response_array = [
        'total',
        'lastPage',
        'perPage',
        'currentPage',
        'items',
    ];

    /**
     * @param LengthAwarePaginator $collect
     * @return mixed
     */
    protected function doArrayForPagination(LengthAwarePaginator $collect)
    {
        foreach ($this->response_array as $key)
            $result[$key] = $collect->$key();

        return $result;
    }

}
