<?php

namespace Config;

use CodeIgniter\Database\Config;

class Database extends Config
{
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;
    public string $defaultGroup = 'default';

    public array $default = [
        'DSN' => '',
        'hostname' => '',
        'username' => '',
        'password' => '',
        'database' => 'postgres',
        'DBDriver' => 'Postgre',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug' => true,
        'charset' => 'utf8',
        'DBCollat' => '',
        'swapPre' => '',
        'schema' => 'public',
        'port' => 5432,
        'encrypt' => false,
        'strictOn' => false,
        'failover' => [],
        'dateFormat' => [
            'date' => 'Y-m-d',
            'datetime' => 'Y-m-d H:i:s',
            'time' => 'H:i:s',
        ],
    ];

    public function __construct()
    {
        parent::__construct();

        $databaseUrl = getenv('DATABASE_URL');
        $this->default['DBDriver'] = 'Postgre';
        $this->default['hostname'] = getenv('PGHOST') ?: 'localhost';
        $this->default['username'] = getenv('PGUSER') ?: 'postgres';
        $this->default['password'] = getenv('PGPASSWORD') ?: '';
        $this->default['database'] = getenv('PGDATABASE') ?: 'postgres';
        $this->default['port'] = (int) (getenv('PGPORT') ?: 5432);
        $this->default['schema'] = 'public';
        $this->default['sslmode'] = getenv('PGSSLMODE') ?: 'require';

        if (preg_match('/^db\.([a-z0-9]+)\.supabase\.co$/i', $this->default['hostname'], $matches)) {
            $this->default['hostname'] = getenv('PGPOOLER_HOST') ?: 'aws-0-ap-northeast-2.pooler.supabase.com';
            $this->default['port'] = (int) (getenv('PGPOOLER_PORT') ?: 5432);
            if ($this->default['username'] === 'postgres') {
                $this->default['username'] = 'postgres.' . $matches[1];
            }
        }

        if ($databaseUrl) {
            $parts = parse_url($databaseUrl);
            if (is_array($parts)) {
                $this->default['hostname'] = $parts['host'] ?? $this->default['hostname'];
                $this->default['username'] = isset($parts['user']) ? urldecode($parts['user']) : $this->default['username'];
                $this->default['password'] = isset($parts['pass']) ? urldecode($parts['pass']) : $this->default['password'];
                $this->default['database'] = isset($parts['path']) ? ltrim($parts['path'], '/') : $this->default['database'];
                $this->default['port'] = $parts['port'] ?? $this->default['port'];
            }
        }
    }
}
