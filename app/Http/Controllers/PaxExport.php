<?php
namespace App\Http\Controllers;

use App\Pax;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use Carbon\Carbon;

class PaxExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    protected $tanggal;
    protected $q;
    protected $miles;
    public $responCounts ;

    public function __construct($tanggal = null, $q = null, $miles = null)
    {
        $this->tanggal = $tanggal;
        $this->q = $q;
        $this->miles = $miles;
    }

    public function collection()
    {
        $query = Pax::query();

        // Filter berdasarkan tanggal
        if ($this->tanggal) {
            $query->whereDate('tanggal_berangkat', $this->tanggal);
        }

        // Filter berdasarkan keyword pencarian
        if ($this->q) {
            $search = $this->q;
            $query->where(function ($q) use ($search) {
                $q->where('kode_booking', 'like', "%{$search}%")
                ->orWhere('origin', 'like', "%{$search}%")
                ->orWhere('arrival', 'like', "%{$search}%")
                ->orWhere('nomor', 'like', "%{$search}%")
                ->orWhere('ga_miles', 'like', "%{$search}%")
                ->orWhere('respon_pnr', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
            });
        }
        if ($this->miles === 'GA') {
            $query->where('ga_miles', '!=', 'NO DATA');
        }
        $data = $query->get();

        // Hitung jumlah per respon_pnr
        $this->responCounts = $data->groupBy('respon_pnr')->map->count()->toArray();

        return $data;
    }

    public function headings(): array
    {
        return [
            'Kode Booking', 'Tanggal Issued', 'Tanggal Berangkat', 'Origin',
            'Arrival', 'PAX', 'Sub Class', 'GA Miles', 'Type of Trip',
            'Code Corp', 'POI', 'Email', 'Respon PNR', 'Nomor Hp', 'Nomor Tiket'
        ];
    }

    public function map($pax): array
    {
        return [
            $pax->kode_booking,
            Carbon::parse($pax->tanggal_issued)->format('Y-m-d'),
            Carbon::parse($pax->tanggal_berangkat)->format('Y-m-d'),
            $pax->origin,
            $pax->arrival,
            $pax->pax,
            $pax->sub_class,
            $pax->ga_miles,
            $pax->type_of_trip,
            $pax->code_corp,
            $pax->poi,
            $pax->email,
            $pax->respon_pnr,
            $pax->nomor,
            $pax->nomor_tiket
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;

                // Hitung jumlah data utama
                $rowCount = count($sheet->getDelegate()->toArray());

                // Tambahkan judul rekap
                $sheet->setCellValue('A' . ($rowCount + 2), 'Rekap Jumlah Respon PNR');

                $currentRow = $rowCount + 3;
                foreach ($this->responCounts as $respon => $count) {
                    $sheet->setCellValue("A{$currentRow}", $respon);
                    $sheet->setCellValue("B{$currentRow}", $count);
                    $currentRow++;
                }
            },
        ];
    }
}
