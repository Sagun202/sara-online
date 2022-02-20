<?php

namespace Bsdev\Ecommerce\Imports;

use Bsdev\Ecommerce\Models\Product;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductsImport implements ToModel, WithProgressBar, WithHeadingRow, WithValidation
{
    use Importable;

    public function model(array $row)
    {
        if (!$row['sku']) {
            $row['sku'] = \Illuminate\Support\Str::random(15);
        }
        $seo = [];
        if ($row['meta_title']) {
            $seo['meta_title'] = $row['meta_title'];
        }
        if ($row['meta_description']) {
            $seo['meta_description'] = $row['meta_description'];
        }

        return new Product([
            'title' => $row['title'],
            'short_description' => $row['short_description'],
            'description' => $row['description'],
            'price' => $row['price'],
            'cost_price' => $row['cost_price'],
            'discount' => $row['discount'],
            'status' => $row['status'],
            'featured' => $row['featured'],
            'quantity' => $row['quantity'],
            'weight' => $row['weight'],
            'tags' => $row['tags'],
            'sku' => $row['sku'],
            'images' => [],
            'custom_fields' => [],
            'seo' => $seo,
            'attribute_ids' => [],
            'user_id' => auth()->id(),
        ]);
    }
    public function rules(): array
    {
        return [
            '*.title' => ['required', 'string', 'max:255'],
            '*.short_description' => ['nullable', 'string', 'max:1000'],
            '*.description' => ['nullable', 'string'],
            '*.price' => ['required', 'integer', 'min:1'],
            '*.cost_price' => ['required', 'integer', 'min:1'],
            '*.discount' => ['nullable', 'integer'],
            '*.status' => ['nullable', 'in:1,0'],
            '*.featured' => ['nullable', 'in:1,0'],
            '*.quantity' => ['required', 'integer', 'min:0'],
            '*.weight' => ['required', 'integer', 'min:0'],
            '*.tags' => ['nullable', 'string'],
            '*.sku' => ['nullable', 'string', 'unique:products,sku'],
            '*.meta_title' => ['nullable', 'string', 'max:255'],
            '*.meta_description' => ['nullable', 'string', 'max:2000'],

        ];
    }
}
