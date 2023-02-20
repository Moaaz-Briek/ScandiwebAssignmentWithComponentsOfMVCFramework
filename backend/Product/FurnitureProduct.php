<?php

class FurnitureProduct extends Product
{
    public string $width = '';
    public string $height = '';
    public string $length  = '';

    public function productRules(): array
    {
        return [
            'width' => [self::RULE_REQUIRED, self::RULE_FLOAT, self::RULE_NO_SPECIAL_CHARACTERS],
            'height' => [self::RULE_REQUIRED, self::RULE_FLOAT, self::RULE_NO_SPECIAL_CHARACTERS],
            'length' => [self::RULE_REQUIRED, self::RULE_FLOAT, self::RULE_NO_SPECIAL_CHARACTERS],
        ];
    }

    public function productLabels(): array
    {
        return [
            'height' => 'Product Height',
            'width' => 'Product Width',
            'length' => 'Product Length',
        ];
    }

    public function productAttributes(): array
    {
        return ['height', 'width', 'length'];
    }
}