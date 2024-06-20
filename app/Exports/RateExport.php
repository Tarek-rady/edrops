<?php

namespace App\Exports;

use App\Models\Rate;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RateExport implements FromArray, WithHeadings
{


    public function array(): array
    {
        $list = [];
        $rates = Rate::get();
        foreach ($rates as $rate) {
            $list[] = [
                'id' => $rate->id,
                'product' => $rate->product_id ? $rate->product->name : '',
                'order' => $rate->order_id ? $rate->order->code : '',
                'rate' => $rate->rate,
                'user' => $rate->user_id ? $rate->user->name : $rate->user_name,
            ];
        }

        return $list;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Product',
            'Order',
            'Rate',
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
