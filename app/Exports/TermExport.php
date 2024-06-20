<?php

namespace App\Exports;

use App\Models\Terms;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TermExport implements FromArray, WithHeadings
{


    public function array(): array
    {
        $list = [];
        $terms = Terms::get();
        foreach ($terms as $term) {
            $list[] = [
                'id'      => $term->id,
                'name_en' => $term->name_en,
                'name_ar' => $term->name_ar,
                'desc_en' => $term->desc_en,
                'desc_ar' => $term->desc_ar,
                'type' => $term->type->name,
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
            'Description (English)',
            'Description (Arabic)',
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
