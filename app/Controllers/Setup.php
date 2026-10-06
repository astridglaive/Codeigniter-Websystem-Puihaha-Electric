<?php

namespace App\Controllers;

use App\Models\UserModel;

class Setup extends BaseController
{
    public function index()
    {
        $users = new UserModel();

        if ($users->countAllResults() > 0) {
            return redirect()->to(site_url('login'))->with('success', 'Administrator setup is already complete.');
        }

        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'username' => 'required|min_length[4]|max_length[100]|alpha_numeric_punct',
                'full_name' => 'required|min_length[3]|max_length[150]',
                'password' => 'required|min_length[8]',
                'confirm_password' => 'required|matches[password]',
            ];

            if (! $this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $users->insert([
                'username' => trim((string) $this->request->getPost('username')),
                'full_name' => trim((string) $this->request->getPost('full_name')),
                'password' => password_hash((string) $this->request->getPost('password'), PASSWORD_DEFAULT),
            ]);

            return redirect()->to(site_url('login'))->with('success', 'Administrator account created. You can now log in.');
        }

        return view('auth/setup', ['title' => 'First-Time Setup']);
    }
}
