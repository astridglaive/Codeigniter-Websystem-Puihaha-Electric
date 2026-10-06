<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'first_name', 'last_name', 'email', 'phone', 'address',
        'city', 'state', 'zip_code', 'password', 'user_type',
        'is_active', 'email_verified',
    ];
    protected $useTimestamps = true;
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data): array
    {
        if (isset($data['data']['password']) && ! str_starts_with($data['data']['password'], '$2y$')) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }

        return $data;
    }
}
