<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @OA\Schema(@OA\Xml(name="User"))
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company',
        'email',
        'firstName',
        'lastName',
        'office',
        'phoneNumber',
        'zipCode',
        'state',
        'city',
        'address',
        'uuid',
        'role',
        'gender',
        'active',
        'disableLogin',
    ];

    public static $rules = array(
        'company'=>'required',
        'email'=>'required|email',
        'firstName'=>'required',
        'lastName'=>'required',
        'office'=>'required|digits:10',
        'phoneNumber'=>'required|digits:10',
        'zipCode'=>'required|digits:5',
        'state'=>'required',
        'city'=>'required',
        'address'=>'required',
        'uuid'=>'required',
        'role'=>'required',
        'active'=>'required',
    );

    public static $updateRules = array(
        'company'=>'required|sometimes',
        'email'=>'required|sometimes|email',
        'firstName'=>'required',
        'lastName'=>'required',
        'office'=>'required|digits:10',
        'phoneNumber'=>'required|digits:10',
        'zipCode'=>'required|digits:5',
        'state'=>'required',
        'city'=>'required',
        'address'=>'required',
        'uuid'=>'required|sometimes',
        'role'=>'required',
        'gender'=>'required',
        'active'=>'required',
        'disableLogin'=>'required',
    );

    /**
     * @OA\Property()
     * @var string
     */
    private $company;
    /**
     * @OA\Property()
     * @var string
     */
    private $email;
    /**
     * @OA\Property()
     * @var string
     */
    private $firstName;
    /**
     * @OA\Property()
     * @var string
     */
    private $lastName;
    /**
     * @OA\Property()
     * @var string
     */
    private $uuid;
    /**
     * @OA\Property()
     * @var string
     */
    private $office;
    /**
     * @OA\Property()
     * @var string
     */
    private $phoneNumber;
    /**
     * @OA\Property()
     * @var integer
     */
    private $zipCode;
    /**
     * @OA\Property()
     * @var string
     */
    private $state;
    /**
     * @OA\Property()
     * @var string
     */
    private $address;
    /**
     * @OA\Property()
     * @var string
     */
    private $city;
    /**
     * @OA\Property()
     * @var string
     */
    private $role;
    /**
     * @OA\Property()
     * @var boolean
     */
    private $gender;
    /**
     * @OA\Property()
     * @var boolean
     */
    private $active;
    /**
     * @OA\Property()
     * @var boolean
     */
    private $disableLogin;
}
