<?php

namespace App\Controllers;

class Services extends BaseController
{
    public function index(): string
    {
        return view('public/services', [
            'title' => 'Our Services - Puihaha Electric',
            'page' => 'services',
        ]);
    }
}
