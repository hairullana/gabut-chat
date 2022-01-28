<?php

namespace App\Models;

use App\Models\Message;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Conversation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function message() {
        return $this->hasMany(Message::class);
    }

    public function user() {
        return $this->hasMany(User::class);
    }
}
