<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'completed',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
