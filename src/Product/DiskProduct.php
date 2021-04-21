<?php

namespace Sw\Product;

class DiskProduct extends AbstractProduct
{
    protected $memory;
    protected $formFactor;

    public function setData(
        string $sku,
        string $name,
        float $price,
        array $attribute
    ) {
        parent::setData($sku, $name, $price, $attribute);

        $this->memory = $attribute['memory'] ?? null;
        $this->formFactor = $attribute['formFactor'] ?? null;
    }

    public function save()
    {
        $attribute = $this->memory . '::' . $this->formFactor;

        $this->saveToDb($attribute);
    }

    public function load($sku)
    {
        $data = $this->connection->select(self::TABLE_NAME, $sku);

        if (!empty($data)) {
            $this->sku = $data['sku'];
            $this->name = $data['name'];
            $this->price = $data['price'];

            $attribute = explode('::', $data['attribute']);
            if (count($attribute) === 2) {
                $this->memory = $attribute[0];
                $this->formFactor = $attribute[1];
            }
        }
    }
}
