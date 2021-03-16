<?php

namespace App\Repositories;

use App\Models\Golosina;
use App\Repositories\BaseRepository;

/**
 * Class GolosinaRepository
 * @package App\Repositories
 * @version March 15, 2021, 5:48 pm UTC
*/

class GolosinaRepository extends BaseRepository
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
        return Golosina::class;
    }
}
