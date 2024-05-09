<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class detailbuku extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function buku(): BelongsTo
    {
        return $this->belongsTo(buku::class);
    }
}
