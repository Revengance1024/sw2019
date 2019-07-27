<?php

namespace Sw;

use Exception;

class TestDatabase implements DatabaseInterface
{
    protected $db = [];

    public function getConfig()
    {
        // TODO: Implement getConfig() method.
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

        $this->db[$table][$data['sku']] = $data;

        var_dump($this->db);
    }

    public function select(string $table, string $sku)
    {
        if (!isset($this->db[$table][$sku])) {
            return [];
        }

        return $this->db[$table][$sku];
    }
}