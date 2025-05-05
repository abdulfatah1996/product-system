<?php

use Illuminate\Support\Facades\Route;
use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Imports\ProductsImport;
use Carbon\Carbon;



Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', function () {
    $productsCount = \App\Models\Product::count();
    $categoriesCount = \App\Models\Category::count();
    $tagsCount = \App\Models\Tag::count();
    $latestProducts = \App\Models\Product::latest()->take(5)->get();
    $categories = \App\Models\Category::withCount('products')->get();

    $categoryNames = $categories->pluck('name');
    $productCounts = $categories->pluck('products_count');

    return view('admin.dashboard', compact('productsCount', 'categoriesCount', 'tagsCount', 'latestProducts','categoryNames', 'productCounts'));
})->name('admin.dashboard');

Route::resources([
    'products' => \App\Http\Controllers\ProductController::class,
    'categories' => \App\Http\Controllers\CategoryController::class,
    'tags' => \App\Http\Controllers\TagController::class,
]);


Route::get('/admin/export-excel', function () {
    $date = Carbon::now()->format('Y-m-d');
    $filename = "products_export_$date.xlsx";
    return Excel::download(new ProductsExport, $filename);
})->name('export.excel');
Route::get('/admin/export-pdf', function () {
    $products = \App\Models\Product::with('category')->get();
    $pdf = Pdf::loadView('pdf.products', compact('products'));
    $date = now()->format('Y-m-d');
    $filename = "products_export_$date.pdf";
    return $pdf->download($filename);
})->name('export.pdf');


Route::get('/import-products', function () {
    return view('admin.products.import-products');
})->name('import.products.form');

Route::post('/admin/import-products', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'file' => 'required|mimes:xlsx,xls'
    ]);

    Excel::import(new ProductsImport, $request->file('file'));

    return redirect()->back()->with('success', 'Products imported successfully!');
})->name('import.products');
