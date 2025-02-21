<?php

namespace NSO\Models;

use Illuminate\Database\Eloquent\Model;

class NinjaPart extends Model
{
    protected $table = "nj_part";
    protected $fillable = [
        "type",
        "part",
    ];

    protected function casts(): array
    {
        return [
            'part' => 'array',
        ];
    }
}
