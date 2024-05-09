<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class peminjaman extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function buku(): BelongsTo
    {
        return $this->belongsTo(buku::class);
    }

    public function detailbuku(): BelongsTo
    {
        return $this->belongsTo(detailbuku::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(user::class);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(user::class);
    }
}
