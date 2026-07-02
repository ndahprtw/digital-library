<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BookExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    private int $no = 1;

    /**
     * Mengambil data dari database
     */
    public function collection()
    {
        return Book::with('category')->get();
    }

    /**
     * Judul kolom
     */
    public function headings(): array
    {
        return [
            'No',
            'Judul',
            'Kategori',
            'Penulis',
            'Penerbit',
            'Tahun Terbit',
            'Stok',
        ];
    }

    /**
     * Mengatur isi setiap baris
     */
    public function map($book): array
    {
        return [
            $this->no++,
            $book->judul,
            $book->category->nama_kategori,
            $book->penulis,
            $book->penerbit,
            $book->tahun_terbit,
            $book->stok,
        ];
    }

    /**
     * Styling Excel
     */
    public function styles(Worksheet $sheet)
    {
        // Header
        $sheet->getStyle('A1:G1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => [
                    'argb' => 'FFFFFF',
                ],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => '28A745',
                ],
            ],
        ]);

        // Border seluruh tabel
        $sheet->getStyle('A1:G' . $sheet->getHighestRow())
            ->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                    ],
                ],
            ]);

        // Rata tengah vertikal
        $sheet->getStyle('A:G')
            ->getAlignment()
            ->setVertical(Alignment::VERTICAL_CENTER);

        // Nomor urut rata tengah
        $sheet->getStyle('A:A')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Tahun rata tengah
        $sheet->getStyle('F:F')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Stok rata tengah
        $sheet->getStyle('G:G')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Tinggi header
        $sheet->getRowDimension(1)->setRowHeight(25);
    }
}