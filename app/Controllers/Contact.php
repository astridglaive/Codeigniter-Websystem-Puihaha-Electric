<?php

namespace App\Controllers;

use App\Models\ContactMessageModel;

class Contact extends BaseController
{
    public function index()
    {
        if ($this->request->getMethod() === 'POST') {
            return $this->submitForm();
        }

        return view('public/contact', [
            'title' => 'Contact Us - Puihaha Electric',
            'page' => 'contact',
        ]);
    }

    private function submitForm()
    {
        $rules = [
            'name' => 'required|min_length[2]|max_length[100]',
            'email' => 'required|valid_email|max_length[255]',
            'phone' => 'required|min_length[7]|max_length[20]',
            'service_type' => 'required|max_length[50]',
            'message' => 'required|min_length[10]|max_length[1000]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $model = new ContactMessageModel();
        $model->insert([
            'name' => trim((string) $this->request->getPost('name')),
            'email' => trim((string) $this->request->getPost('email')),
            'phone' => trim((string) $this->request->getPost('phone')),
            'service_type' => (string) $this->request->getPost('service_type'),
            'message' => trim((string) $this->request->getPost('message')),
        ]);

        return redirect()->to(site_url('contact'))->with('success', 'Thank you for your message! We will contact you within 24 hours.');
    }
}
