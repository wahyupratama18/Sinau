<?php
namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * Create User
 */
trait CreateUser
{

    /**
     * Create New User Instance
     * @param int|null $id
     * @param string $name
     * @param string $email
     * @param string $pob
     * @param mixed $dob
     * @param int $num
     * @param string $addr
     * @param mixed|null $pass
     * @return mixed
    */
    public static function createNew(
        int $id = null,
        string $name,
        string $email,
        string $pob,
        $dob,
        int $num,
        string $addr,
        $pass = null
    ) {
        return User::updateOrCreate(
            ['id' => $id],
            [
                'name' => $name,
                'email' => $email,
                'tempatLahir' => $pob,
                'tanggalLahir' => $dob,
                'phone_number' => $num,
                'address' => $addr,
                'password' => $pass ?? Hash::make(date('dmY', strtotime($dob)))
            ]
        )->id;
    }
}
