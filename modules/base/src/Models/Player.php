<?php

namespace NSO\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $table = "players";
    protected $fillable = [
        "id",
        "user_id",
        "server_id",
        "name",
        "gender",
        "clan",
        "class",
        "data",
        "point",
        "potential",
        "spoint",
        "skill",
        "equiped",
        "fashion",
        "bijuu",
        "map",
        "saveCoordinate",
        "head",
        "head2",
        "weapon",
        "body",
        "leg",
        "xu",
        "xuInBox",
        "yen",
        "numberCellBag",
        "numberCellBox",
        "bag",
        "box",
        "onCSkill",
        "onOSkill",
        "onKSkill",
        "mount",
        "effect",
        "friends",
        "enemies",
        "taskId",
        "task",
        "rewardPB",
        "event_point",
        "spending_point",
        "message",
        "giftcode_unpaid",
        "last_login_time",
        "last_logout_time",
        "online",
        "mask_box",
        "collection_box",
        "activated",
        "created_at",
        "updated_at",
        "luong",
        "amount_unpaid",
        "deleted_at"
    ];

    protected function casts(): array
    {
        return [
            'data' => 'array',
            'bag' => 'array',
            'box' => 'array',
            'equiped' => 'array',
            'skill' => 'array',
            'task' => 'array',
        ];
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function clazz(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Clazz::class, 'class');
    }

    public function headPart()
    {
        return $this->belongsTo(NinjaPart::class, 'head');
    }
}
