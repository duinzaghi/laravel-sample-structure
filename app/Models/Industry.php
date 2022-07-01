<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(@OA\Xml(name="Industry"))
 */
class Industry extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'industries';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public static $rules = array(
        'name'=>'required',
    );

    public static $updateRules = array(
        'name'=>'required|sometimes',
    );

    /**
     * @OA\Property()
     * @var string
     */
    private $name;
}
