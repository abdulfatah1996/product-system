<?php
namespace App\Imports;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // العثور على التصنيف بالاسم
        $category = Category::firstOrCreate(['name' => $row['category']]);

        return new Product([
            'name'        => $row['name'],
            'description' => $row['description'] ?? null,
            'price'       => $row['price'],
            'category_id' => $category->id,
        ]);
    }
}
