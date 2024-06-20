<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OrderExport implements FromArray, WithHeadings
{


    public function array(): array
    {
        $list = [];
        $orders = Order::where('type' , 'order')->get();
        foreach ($orders as $order) {
            $list[] = [
                'id' => $order->id,
                'code' => $order->code,
                'user_name' => $order->user_id ? $order->user->name : $order->user_name,
                'user_phone' => $order->user_id ? $order->user->phone : $order->user_phone,
                'email' => $order->user_id ? $order->user->email : $order->email,
                'address' => $order->address,
                'addres_details' => $order->addres_details,
                'status' => $order->status->name,
                'date_order' => $order->date_order,
                'total' => $order->total,
                'total_discount' => $order->total_discount,
                'total_after_discount' => $order->total_after_discount,
            ];
        }

        return $list;
    }

    public function headings(): array
    {
        return [
            'ID',
            'code',
            'user_name',
            'user_phone',
            'email',
            'address',
            'addres_details',
            'status',
            'date_order',
            'total',
            'total_discount',
            'total_after_discount',
           

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
