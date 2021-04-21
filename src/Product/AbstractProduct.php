<?php

namespace Sw\Product;

use Sw\DatabaseInterface;
use Sw\Helper\Serializer;
use Sw\TestDatabase;

abstract class AbstractProduct
{
    const TABLE_NAME = 'products';

    protected int $id;
    protected string $sku;
    protected string $name;
    protected float $price;
    protected array $attributes = [];

    /**
     * @var DatabaseInterface
     */
    protected $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    // TODO for Johnny (Task 2.1): Implement saving attributes in a separate table.
    //  Client wants to filter/sort by some of the attributes and current solution (serialize attributes,
    //  save as string) just doesn't let us do that.
    //  Make sure to update save() function if you implement this.
    //    public function saveAttributes()
    //    {}

    // TODO for Johnny (Task 2.2): after implementing saveAttributes(), don't forget to implement loadAttributes.
    //  When you implement this, don't forget to update load() function.
    //    public function loadAttributes()
    //    {}

    public function save()
    {
        $serializedAttribute = Serializer::serialize($this->attributes);

        $data = [
            'sku' => $this->sku,
            'name' => $this->name,
            'price' => $this->price,
            'attribute' => $serializedAttribute
        ];


        // TODO for Billy (Task 3):
        $this->connection->insert(
            self::TABLE_NAME,
            $data
        );
    }

    public function load() {

    }
}
