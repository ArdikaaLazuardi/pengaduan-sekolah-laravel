<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgressUpdate extends Model
{
    protected $fillable = [
        'aspirasi_id',
        'progress_persen',
        'catatan',
        'admin_id',
    ];

    public function aspirasi(): BelongsTo
    {
        return $this->belongsTo(Aspirasi::class);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }
}
