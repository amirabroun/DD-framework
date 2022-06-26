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
            $this->apiResponse->setStatus(404)->setTitle('ورود ناموفق')
                ->setMessage('اطلاعات وارد شده نامعتبر است!')
                ->sweetAlert();
        }

        $_SESSION['_admin_log_'] = $admin;
        $this->apiResponse->setStatus(200)
            ->setTitle("$admin->first_name $admin->last_name  عزیز")
            ->setMessage('شما با موفقیت وارد شدید!')
            ->sweetAlert();
    }

    public function logOut()
    {
        if (isset($_SESSION['_admin_log_'])) {
            unset($_SESSION['_admin_log_']);
        }

        redirect()->route('/login/secret/' . md5(secretKey('secret_login')));
    }
}
