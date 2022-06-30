<?php

namespace App\Controllers;

use App\Models\Admin;
use App\Requests\LoginRequest;
use App\Controllers\Controller;

class LoginController extends Controller
{

    public function adminLogin(LoginRequest $request)
    {
        $admin = $request->validated();

        if (!$admin = Admin::doLogin($admin->username, $admin->password)) {
            includePath()->view('auth.login', [
                'error' => 'Incurrect username or password'
            ]);
        }

        $_SESSION['_admin_log_'] = $admin;

        redirect()->route('/');
    }

    public function logOut()
    {
        if (isset($_SESSION['_admin_log_'])) {
            unset($_SESSION['_admin_log_']);
        }

        redirect()->route('/login/secret/' . md5(secretKey('secret_login')));
    }
}
