<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public $timestamps = false;
    use HasFactory;

    public function userRel() {
        return $this->hasMany(User::class, "room", "id");
    }
    public function keyRel() {
        return $this->hasMany(Key::class, "room", "id");
    }
}
