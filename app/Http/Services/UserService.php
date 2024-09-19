<?php

namespace App\Http\Services;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public static function createUserToken($data_length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $data_length; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

    public static function validate($request)
    {
        $validation = $request->validated();

        // $validation['token'] = self::createUserToken(30);

        $validation['admin'] = $request->has('admin') ? 1 : 0;
        $validation['missing_notification'] = $request->has('missing_notification') ? 1 : 0;
        $validation['share_name'] = $request->has('share_name') ? 1 : 0;
        $validation['share_other_contact'] = $request->has('share_other_contact') ? 1 : 0;
        $validation['share_contact'] = $request->has('share_contact') ? 1 : 0;
        $validation['share_address'] = $request->has('share_address') ? 1 : 0;
        $validation['share_vet_info'] = $request->has('share_vet_info') ? 1 : 0;

        return $validation;
    }

    public static function getNextId($table)
    {
        $id = DB::select("SHOW TABLE STATUS LIKE '" . $table . "'");
        $next_id = $id[0]->Auto_increment;

        return $next_id;
    }

    public static function createDefaultUser()
    {
        try {
            DB::beginTransaction();

            $user = new User;

            $next_id = self::getNextId('users');

            $user->name = 'default_user_' . $next_id;
            $user->email = 'default_user_' . $next_id . '@sape.com';
            $user->password = Hash::make('password');
            $user->status = 0;
            $user->save();

            $pet = new Pet;
            $pet->user_id = $user->id;
            $pet->name = 'default_owner_' . $user->id . '_pet';
            $pet->type = 1;
            $pet->token = self::createUserToken(30);
            $pet->status = 0;
            $pet->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }

        return $user;
    }
}
