<?php

class Product extends Model
{
    public string $sku = '';
    public string $name = '';
    public string $price = '';
    public string $type = '';

    public function rules(): array
    {
        // TODO: Implement rules() method.
        $baseRules =  [
            'sku' => [self::RULE_REQUIRED, self::RULE_NO_SPECIAL_CHARACTERS, self::RULE_UNIQUE],
            'name' => [self::RULE_REQUIRED, self::RULE_NO_SPECIAL_CHARACTERS],
            'price' => [self::RULE_REQUIRED, self::RULE_NO_SPECIAL_CHARACTERS, self::RULE_FLOAT],
            'type' => [self::RULE_REQUIRED, self::RULE_NO_SPECIAL_CHARACTERS, self::RULE_STRING],
        ];
        $rules = [];
        if (method_exists($this, 'productRules')){
            $rules = $this->productRules() ?? [];
        }
        return array_merge($baseRules,  $rules);
    }

    public function labels(): array
    {
        $baseLabels = [
            'sku' => 'Product Sku',
            'name' => 'ProductName',
            'price' => 'Product Price',
            'type' => 'Product Type',
        ];
        $labels = [];
        if (method_exists($this, 'productLabels')){
            $labels = $this->productLabels() ?? [];
        }
        return array_merge($baseLabels, $labels);
    }

    public function tableName(): string
    {
        // TODO: Implement tableName() method.
        return 'products';
    }

    public function attributes(): array
    {
        $baseAttributes =  ['sku', 'name', 'price', 'type'];
        $attributes = [];
        if (method_exists($this, 'productAttributes')){
            $attributes = $this->productAttributes() ?? [];
        }
        return array_merge($baseAttributes, $attributes);
    }
}