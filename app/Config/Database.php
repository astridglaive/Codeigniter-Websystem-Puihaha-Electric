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
        'DBDebug' => false,
        'charset' => 'utf8',
        'DBCollat' => '',
        'swapPre' => '',
        'schema' => 'public',
        'port' => 5432,
        'failover' => [],
        'dateFormat' => [
            'date' => 'Y-m-d',
            'datetime' => 'Y-m-d H:i:s',
            'time' => 'H:i:s',
        ],
    ];

    public function __construct()
    {
        $this->default['hostname'] = getenv('PGHOST') ?: getenv('database.default.hostname') ?: 'localhost';
        $this->default['username'] = getenv('PGUSER') ?: getenv('database.default.username') ?: 'postgres';
        $this->default['password'] = getenv('PGPASSWORD') ?: getenv('database.default.password') ?: '';
        $this->default['database'] = getenv('PGDATABASE') ?: getenv('database.default.database') ?: 'postgres';
        $this->default['port'] = (int) (getenv('PGPORT') ?: getenv('database.default.port') ?: 5432);
        $this->default['schema'] = getenv('PGSCHEMA') ?: getenv('database.default.schema') ?: 'public';
        $this->default['sslmode'] = getenv('PGSSLMODE') ?: 'require';
    }
}
