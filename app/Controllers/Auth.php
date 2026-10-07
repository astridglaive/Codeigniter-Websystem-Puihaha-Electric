<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\User;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('isLoggedIn') === true) {
            return redirect()->to(site_url('dashboard'));
        }

        return view('auth/login', ['title' => 'Staff Login']);
    }

    public function attemptLogin()
    {
        $rules = [
            'username' => 'required|max_length[255]',
            'password' => 'required|max_length[255]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $username = trim((string) $this->request->getPost('username'));
        $password = (string) $this->request->getPost('password');
        $staffUser = (new UserModel())->where('username', $username)->first();
        $customerUser = (new User())->where('email', $username)->where('is_active', 1)->first();
        $user = $staffUser ?? $customerUser;

        if ($user === null || ! password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()
                ->with('error', 'Invalid email/username or password.');
        }

        session()->regenerate(true);
        session()->set([
            'isLoggedIn' => true,
            'userId'     => $user['id'],
            'username'   => $user['username'] ?? $user['email'],
            'fullName'   => $user['full_name'] ?? trim($user['first_name'] . ' ' . $user['last_name']),
        ]);

        $destination = session()->get('redirectAfterLogin') ?: site_url('dashboard');
        session()->remove('redirectAfterLogin');

        return redirect()->to($destination)->with('success', 'Welcome back, ' . ($user['full_name'] ?? trim($user['first_name'] . ' ' . $user['last_name'])) . '!');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to(site_url('login'))->with('success', 'You have been logged out.');
    }
}
