<?php

namespace App\Controllers;

class About extends BaseController
{
    public function index(): string
    {
        return view('public/about', [
            'title' => 'About Us - Puihaha Electric',
            'page' => 'about',
        ]);
    }
}
