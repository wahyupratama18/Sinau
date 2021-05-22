<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\{Factories\HasFactory, SoftDeletes};
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,
        HasFactory,
        HasProfilePhoto,
        Notifiable,
        SoftDeletes,
        TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'phone_number',
        'tempatLahir',
        'tanggalLahir',
        'gender'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'tanggalLahir' => 'date'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'my_gender'
    ];


    /**
     * Genders Data
     * @var string[] $genders
    */
    private $genders = [1 => 'Laki-Laki', 2 => 'Perempuan'];


    /**
     * Is Student
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
    */
    public function student()
    {
        return $this->hasOne(Student::class)->where('active', 1);
    }


    /**
     * Is Teacher
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
    */
    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }


    /**
     * Get Gender Attribute
     * @return string
    */
    public function getMyGenderAttribute()
    {
        return $this->genders[$this->gender];
    }


    public function getGenders()
    {
        return $this->genders;
    }


}
