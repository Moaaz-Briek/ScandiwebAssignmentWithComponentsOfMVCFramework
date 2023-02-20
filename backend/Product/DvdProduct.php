<?php

class DvdProduct extends Product
{
    public string $size = '';

    public function productRules(): array
    {
        return [
            'size' => [self::RULE_REQUIRED, self::RULE_FLOAT, self::RULE_NO_SPECIAL_CHARACTERS],
        ];
    }

    public function productLabels(): array
    {
        return [
            'size' => 'Product Size',
        ];
    }

    public function productAttributes(): array
    {
        return ['size'];
    }
}