<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PeminjamanLaptop extends Model
{

    use HasFactory;
    use SoftDeletes;
    protected $table = 'peminjaman_laptop';
    protected $primaryKey = 'id';
    public $timestamps = TRUE;
    protected $fillable = [
        'user_id',
        'laptop_id',
        'status_id',
        'tgl_pinjam',
        'tgl_kembali',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Relasi 'belongsTo': Satu Peminjaman terkait dengan satu Laptop
    public function laptop()
    {
        return $this->belongsTo(Laptop::class, 'laptop_id', 'id');
    }

    // public function status()
    // {
    //     return $this->belongsTo(Status::class, 'status_id', 'id');
    // }


}
