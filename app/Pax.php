<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pax extends Model
{
    // Nama tabel kalau perlu di-set
    protected $table = 'pax';

    protected $fillable = [
        'nama',
        'nomor',
        'email',
        'kode_booking',
        'nomor_tiket',
        'tanggal_issued',
        'flight_number',
        'tanggal_berangkat',
        'origin',
        'arrival',
        'pax',
        'sub_class',
        'ga_miles',
        'type_of_trip',
        'code_corp',
        'poi'   
    ];

    public $timestamps = false;
}
