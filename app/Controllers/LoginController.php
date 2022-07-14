<?php

namespace App\Controllers;

use App\Models\Admin;
use App\Requests\LoginRequest;
use App\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * @param LoginRequest $request
     * @return void
     */
    public function adminLogin(LoginRequest $request)
    {
        $admin = $request->validated();

        if (!$admin = Admin::login($admin->username, $admin->password)) {
            includePath()->view('auth.login', [
                'error' => 'Incurrect username or password'
            ]);
        }

        $_SESSION['_admin_log_'] = $admin;

        redirect()->route('/');
    }

    /**
     * Unless Session
     *
     * @return void
     */
    public function logOut()
    {
        if (isset($_SESSION['_admin_log_'])) {
            unset($_SESSION['_admin_log_']);
        }

        redirect()->route('/');
    }
}
