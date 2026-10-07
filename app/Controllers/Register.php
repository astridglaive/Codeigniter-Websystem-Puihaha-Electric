<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\CustomerAccountModel;

class Register extends BaseController
{
    public function index(): string
    {
        return view('public/register', [
            'title' => 'Register - Puihaha Electric',
            'page' => 'register',
        ]);
    }

    public function create()
    {
        $rules = [
            'first_name' => 'required|min_length[2]|max_length[100]',
            'last_name' => 'required|min_length[2]|max_length[100]',
            'email' => 'required|valid_email|max_length[255]|is_unique[users.email]',
            'phone' => 'required|min_length[7]|max_length[20]',
            'address' => 'required|min_length[5]|max_length[255]',
            'city' => 'required|min_length[2]|max_length[100]',
            'state' => 'required|min_length[2]|max_length[50]',
            'zip_code' => 'required|min_length[4]|max_length[10]',
            'password' => 'required|min_length[8]',
            'confirm_password' => 'required|matches[password]',
            'terms' => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $db = db_connect();
        $db->transStart();

        $model = new User();
        $userId = $model->insert([
            'first_name' => trim((string) $this->request->getPost('first_name')),
            'last_name' => trim((string) $this->request->getPost('last_name')),
            'email' => trim((string) $this->request->getPost('email')),
            'phone' => trim((string) $this->request->getPost('phone')),
            'address' => trim((string) $this->request->getPost('address')),
            'city' => trim((string) $this->request->getPost('city')),
            'state' => trim((string) $this->request->getPost('state')),
            'zip_code' => trim((string) $this->request->getPost('zip_code')),
            'password' => (string) $this->request->getPost('password'),
            'user_type' => 'customer',
            'is_active' => 1,
            'email_verified' => 0,
        ], true);

        (new CustomerAccountModel())->insert([
            'account_number' => 'CUS-USER-' . $userId,
            'customer_name' => trim((string) $this->request->getPost('first_name')) . ' ' . trim((string) $this->request->getPost('last_name')),
            'address' => trim((string) $this->request->getPost('address')) . ', ' . trim((string) $this->request->getPost('city')) . ', ' . trim((string) $this->request->getPost('state')) . ' ' . trim((string) $this->request->getPost('zip_code')),
            'phone' => trim((string) $this->request->getPost('phone')),
            'email' => trim((string) $this->request->getPost('email')),
            'connection_type' => 'residential',
            'status' => 'active',
        ]);

        if ($db->transStatus() === false) {
            $db->transRollback();
            return redirect()->back()->withInput()->with('error', 'Registration could not be saved. Please try again.');
        }

        $db->transComplete();

        return redirect()->to(site_url('register'))->with('success', 'Registration successful! Your customer account was saved to the database.');
    }
}
