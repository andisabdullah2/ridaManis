<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Kandidat;
 
class Pemilihan extends Model
{
    //
    protected $table = 'pemilihan';

    protected $fillable = [
        'kandidat_id',
        'user_id',
    ];

    public $timestamps = false;
    public function kandidat()
    {
        return $this->belongsTo(Kandidat::class, 'kandidat_id');
    }
}

