<?php

namespace App\Exports;

use App\Models\ContactUs;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ContactExport implements FromArray, WithHeadings
{


    public function array(): array
    {
        $list = [];
        $contacts = ContactUs::get();
        foreach ($contacts as $contact) {
            $list[] = [
                'id' => $contact->id,
                'user_name' => $contact->user_name,
                'phone' => $contact->phone,
                'email' => $contact->email,
                'order_id' => $contact->order_id ? $contact->order_id : '',
                'msg' => $contact->msg,
            ];
        }

        return $list;
    }

    public function headings(): array
    {
        return [
            'ID',
            'User Name',
            'Phone',
            'Email',
            'Order',
            'Message',
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
