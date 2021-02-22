<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Car
 * @package App\Models
 * @version February 8, 2021, 5:28 pm UTC
 *
 * @property \App\Models\User $idUser
 * @property integer $id_user
 * @property string $name
 * @property string $brand
 */
class Car extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'cars';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];
    public $timestamps = false;

    public $fillable = [
        'id_user',
        'name',
        'brand'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'id_user' => 'integer',
        'name' => 'string',
        'brand' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id_user' => 'required',
        'name' => 'required|string|max:25',
        'brand' => 'required|string|max:25'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function idUser()
    {
        return $this->belongsTo(\App\Models\User::class, 'id_user');
    }
}
