<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductExport implements FromArray, WithHeadings
{


    public function array(): array
    {
        $list = [];
        $products = Product::get();
        foreach ($products as $product) {
            $list[] = [
                'id' => $product->id,
                'name_en' => $product->name_en,
                'name_ar' => $product->name_ar,
                'price' => $product->price,
                'qty' => $product->qty,
                'category_id' => $product->category->name,
                'brand_id' => $product->brand_id ? $product->brand->name : '',
                'discount' => $product->discount,
                'viewer' => $product->viewer,
                'time' => $product->time,
            ];
        }

        return $list;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name (English)',
            'Name (Arabic)',
            'Price',
            'quantity',
            'Category',
            'Brand',
            'Discount',
            'Viewer',
            'Time',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1 => ['font' => ['bold' => true, 'size' => 50, 'italic' => true]],
        ];
    }
}
