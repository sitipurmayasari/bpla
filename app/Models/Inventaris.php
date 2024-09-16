<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventaris extends Model
{
    use SoftDeletes;
    protected $table = "inventaris";
    protected $fillable = ["kode_barang","nama_barang","harga","kode_bmn","jenis_barang","jumlah_barang","sinonim",
                            "tanggal_diterima","merk","no_seri","lokasi","penanggung_jawab","spesifikasi","satuan_id",
                            "file_user_manual","file_ika","file_trouble","file_foto","status_barang","kind","link_video","file_sert","file_evakali"
                        ];
    protected $dates = ['deleted_at'];

   
}
