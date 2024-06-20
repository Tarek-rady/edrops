<?php

namespace App\Exports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CategoryExport implements FromArray, WithHeadings
{


    public function array(): array
    {
        $list = [];
        $categories = Category::where('type' , 'category')->get();
        foreach ($categories as $category) {
            $list[] = [
                'id' => $category->id,
                'name_en' => $category->name_en,
                'name_ar' => $category->name_ar,
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
