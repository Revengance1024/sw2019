<?php

namespace Sw\Product;

use Sw\DatabaseInterface;
use Sw\TestDatabase;

abstract class AbstractProduct
{
    const TABLE = 'products';

    protected $id;
    protected $sku;
    protected $name;
    protected $price;

    /**
     * @var DatabaseInterface
     */
    protected $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function setData(
        string $sku,
        string $name,
        float $price,
        array $attribute
    ) {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
    }

    protected function saveToDb(string $attribute)
    {
        $data = [
            'sku' => $this->sku,
            'name' => $this->name,
            'price' => $this->price,
            'attribute' => $attribute
        ];

        $this->connection->insert(
            self::TABLE,
            $data
        );
    }

    public abstract function save();

    public abstract function load($sku);
}
