<?php


namespace App\Services;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Operations
{
    public static function decrytpId($value){
        //check if value is encrypted
        try {
            $id = Crypt::decrypt($value);
            return $value;
        } catch (DecryptException $e) {
            return redirect()->route('home');
        }

        return $id;
    }
}
