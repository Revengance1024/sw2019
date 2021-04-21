<?php

namespace Sw;

interface DatabaseInterface
{
    public function getConfig();

    public function insert(string $table, array $columns, array $data);

    public function select(string $table, string $sku);
}
