<?php
namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Product::with('category')->get()->map(function ($product) {
            return [
                'name'        => $product->name,
                'description' => $product->description,
                'price'       => $product->price,
                'category'    => $product->category->name ?? 'N/A',
            ];
        });
    }

    public function headings(): array
    {
        return ['name', 'description', 'price', 'category'];
    }
}
