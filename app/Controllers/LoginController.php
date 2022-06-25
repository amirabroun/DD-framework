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

        if (!$this->recaptchaVerify($admin->grecaptcha)) {
            $this->failRecaptchaVerify();
        }

        if (!$admin = Admin::doLogin($admin->username, $admin->password)) {
            $this->failAdminLogin();
        }

        $this->successAdminLogin($admin);
    }

    public function logOut()
    {
        if (isset($_SESSION['_admin_log_'])) {
            unset($_SESSION['_admin_log_']);
        }

        redirect()->route('/login/secret/' . md5(secretKey('secret_login')));
    }

    private function successAdminLogin(object $admin)
    {
        $_SESSION['_admin_log_'] = [
            'id' => $admin->id,
            'first_name' => $admin,
            'last_name' => $admin->last_name,
            'full_name' => "{$admin->first_name} {$admin->last_name}",
        ];

        $this->apiResponse
            ->setTitle($_SESSION['_admin_log_']['full_name'] . ' عزیز')
            ->setMessage('شما با موفقیت وارد شدید!')
            ->setStatus(200)
            ->sweetAlert();
    }

    private function failAdminLogin()
    {
        $this->apiResponse
            ->setTitle('ورود ناموفق')
            ->setMessage('اطلاعات وارد شده نامعتبر است!')
            ->setStatus(404)
            ->sweetAlert();
    }

    private function failRecaptchaVerify()
    {
        $this->apiResponse
            ->setTitle('ورود ناموفق')
            ->setMessage('لطفا ثابت کنید که ربات نیستید!')
            ->setStatus(404)
            ->sweetAlert();
    }
}
