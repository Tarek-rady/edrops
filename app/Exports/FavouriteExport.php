<?php

namespace App\Exports;

use App\Models\Favourite;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class FavouriteExport implements FromArray, WithHeadings
{


    public function array(): array
    {
        $list = [];
        $favourites = Favourite::get();
        foreach ($favourites as $favourite) {
            $list[] = [
                'id' => $favourite->id,
                'product->name' => $favourite->product->name,
                'user->name' => $favourite->user->name,
            ];
        }

        return $list;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Product',
            'User',
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
