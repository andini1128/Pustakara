<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Book extends Model
{
    protected $fillable = [
        'judul',
        'penulis',
        'kategori',
        'penerbit',
        'tahun_terbit',
        'stok',
        'deskripsi',
        'cover',
    ];

    public function favoredByUsers()
    {
        return $this->belongsToMany(User::class, 'favorite_books')->withTimestamps();
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function reviews()
    {
        return $this->hasMany(BookReview::class);
    }
}
