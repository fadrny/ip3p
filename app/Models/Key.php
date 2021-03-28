<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Key extends Model
{
    public $timestamps = false;
    use HasFactory;

    public function roomRel() {
        return $this->belongsTo(Room::class, "room", "id");
    }
    public function userRel() {
        return $this->belongsTo(User::class, "employee", "id");
    }
}
