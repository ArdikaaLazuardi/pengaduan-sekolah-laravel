<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Siswa extends Authenticatable
{
    use Notifiable;

    protected $table = 'siswas';

    protected $primaryKey = 'nis';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'nis',
        'nama',
        'kelas',
    ];

    public function aspirasis(): HasMany
    {
        return $this->hasMany(Aspirasi::class, 'nis', 'nis');
    }
}
