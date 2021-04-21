<?php

namespace Sw;

use Exception;

class RealDatabase implements DatabaseInterface
{
    const CONFIG_FILE = 'db-config.ini';

    protected $config;

    protected $connection;

    public function getConfig()
    {
        if ($this->config === null) {
            $cwd = getcwd();
            $this->config = parse_ini_file($cwd . '/' . self::CONFIG_FILE);
        }

        return $this->config;
    }

    protected function getConnection()
    {
        if ($this->connection === null) {
            $config = $this->getConfig();

            $this->connection = mysqli_connect(
                $config['db_host'],
                $config['db_username'],
                $config['db_password'],
                $config['db_name']
            );
        }

        return $this->connection;
    }

    /**
     * TODO for Billy (Task 4): Update insert to protect from SQL injection.
     *  We let our intern write this. As expected, you will have to rewrite it.
     *  Focus on values, columns should only be defined in code, so no need to change them.
     *
     * @param $table string
     * @param array $columns
     * @param $data array
     * @throws Exception
     */
    public function insert(string $table, array $columns, array $data)
    {
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $data[$key] = '"' . $value . '"';
            }
        }

        $this->getConnection()->query(
            sprintf(
                'INSERT INTO %s (%s) VALUES (%s)',
                $table,
                implode(',', $columns),
                implode(',', $data)
            )
        );
    }

    public function select(string $table, string $sku)
    {
        $data = $this->getConnection()->query(
            sprintf(
                'SELECT * FROM %s WHERE sku = "%s"',
                $table,
                $sku
            )
        );

        return $data->fetch_assoc();
    }
}
