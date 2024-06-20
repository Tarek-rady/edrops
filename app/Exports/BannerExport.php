<?php

namespace App\Exports;

use App\Models\Banner;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BannerExport implements FromArray, WithHeadings
{


    public function array(): array
    {
        $list = [];
        $banners = Banner::get();
        foreach ($banners as $banner) {
            $list[] = [
                'id' => $banner->id,
                'title_en' => $banner->title_en,
                'title_ar' => $banner->title_ar,
                'desc_en' => $banner->desc_en,
                'desc_ar' => $banner->desc_ar,
                'status' => $banner->status,
            ];
        }

        return $list;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Title (English)',
            'Title (Arabic)',
            'Description (English)',
            'Description (Arabic)',
            'Status',
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
