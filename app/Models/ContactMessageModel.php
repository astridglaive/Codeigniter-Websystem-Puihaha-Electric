<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactMessageModel extends Model
{
    protected $table = 'contact_messages';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['name', 'email', 'phone', 'service_type', 'message'];
    protected $useTimestamps = true;
}
