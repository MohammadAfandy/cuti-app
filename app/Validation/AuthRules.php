<?php

namespace App\Validation;
use App\Models\UserModel;

class AuthRules
{
    public function validateLogin(string $str, string $fields, array $data, string &$error = null)
    {
        $model = new UserModel();
        $user = $model->where('username', $data['username'])->first();

        if (!$user || !password_verify($data['password'], $user->password)) {
            $error = 'Incorrect username or password';
            return false;
        }

        return true;
    }
}
