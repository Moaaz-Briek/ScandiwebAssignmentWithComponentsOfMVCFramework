<?php

class BookProduct extends Product
{
    public string $weight = '';

    public function productRules(): array
    {
        return [
            'weight' => [self::RULE_REQUIRED, self::RULE_FLOAT, self::RULE_NO_SPECIAL_CHARACTERS],
        ];
    }

    public function productLabels(): array
    {
        return [
            'weight' => 'Product Weight',
        ];
    }

    public function productAttributes(): array
    {
        return ['weight'];
    }
}