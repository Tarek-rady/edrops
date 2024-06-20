<?php

namespace App\Exports;

use App\Models\Coupon;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CouponExport implements FromArray, WithHeadings
{


    public function array(): array
    {
        $list = [];
        $coupons = Coupon::get();
        foreach ($coupons as $coupon) {
            $list[] = [
                'id' => $coupon->id,
                'code' => $coupon->code,
                'type' => $coupon->type,
                'value' => $coupon->value,
                'cart_value' => $coupon->cart_value,
                'start_date' => $coupon->start_date,
                'expiry_date' => $coupon->expiry_date,
            ];
        }

        return $list;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Code',
            'Type',
            'Value',
            'Cart Value',
            'Start Date',
            'Expire Date',

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
