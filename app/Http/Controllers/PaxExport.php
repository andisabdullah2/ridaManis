<?php
namespace App\Http\Controllers;

use App\Pax;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class PaxExport implements FromCollection, WithHeadings, WithMapping
{
    protected $tanggal;

    public function __construct($tanggal = null)
    {
        $this->tanggal = $tanggal;
    }

    public function collection()
    {
        return Pax::when($this->tanggal, function ($query) {
            $query->whereDate('tanggal_berangkat', $this->tanggal);
        })->get();
    }

    public function headings(): array
    {
        return [
            'Kode Booking', 'Tanggal Issued', 'Tanggal Berangkat', 'Origin',
            'Arrival', 'PAX', 'Sub Class', 'GA Miles', 'Type of Trip',
            'Code Corp', 'POI', 'Email', 'Respon PNR'
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
    ];
}
}
