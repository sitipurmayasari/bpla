<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bpla extends Model
{
    protected $table = "bpla";
    protected $fillable = ['inventaris_id','user_id','labory_id','dates','activity','time_start','time_end','description'
];

    public function barang()
    {
        return $this->belongsTo(Inventaris::class,'inventaris_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function lab()
    {
        return $this->belongsTo(Labory::class,'labory_id','id');
    }

}
