<?php

namespace NSO\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = "item";
    protected $fillable = [
        "id",
        "name",
        "type",
        "gender",
        "description",
        "level",
        "icon",
        "part",
        "fashion",
        "isUpToUp",
    ];
}
