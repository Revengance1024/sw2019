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
                $config['db_user'],
                $config['db_pass'],
                $config['db_name']
            );
        }

        return $this->connection;
    }

    /**
     * @param $table string
     * @param $data array
     * @throws Exception
     */
    public function insert(string $table, array $data)
    {
        if (!array_key_exists('sku', $data)) {
            throw new Exception('Missing sku');
        }

        /**
         * DON'T DO THIS. USE BIND
         */
        $this->getConnection()->query(
            sprintf(
                'INSERT INTO %s (sku, name, price, attribute) ' .
                'VALUES ("%s", "%s", %s, "%s")',
                $table,
                $data['sku'],
                $data['name'],
                $data['price'],
                $data['attribute'] ?? ''
            )
        );
    }

    public function select(string $table, string $sku)
    {
        /**
         * DON'T DO THIS. USE BIND
         */
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
