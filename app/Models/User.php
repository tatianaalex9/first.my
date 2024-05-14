<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'last_name',
        'birth_date',
        'gender',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Пользователь может отправить сообщение
    public function sent(): HasMany
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    // Пользователь также может получить сообщение
    public function received(): HasMany //received - полученный
    {
        return $this->hasMany(Message::class, 'recipient_id');
    }


    public function sendMessageTo($recipient, $content, $subject)
    {
        return $this->sent()->create([
            'recipient_id'  => $recipient,
            'subject'       => $subject,
            'content'       => $content,
        ]);   
    }
}
