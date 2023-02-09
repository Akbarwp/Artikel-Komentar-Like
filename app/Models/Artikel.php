<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $table = "artikels";

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function totalKomentar()
    {
        return $this->hasMany(Komentar::class)->count();
    }
}
