<?php

namespace App\Repositories;

use App\Models\golosina;
use App\Repositories\BaseRepository;

/**
 * Class golosinaRepository
 * @package App\Repositories
 * @version March 15, 2021, 5:33 pm UTC
*/

class golosinaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return golosina::class;
    }
}
