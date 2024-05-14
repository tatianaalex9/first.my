<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Message extends Model
{
    use HasFactory;
    protected $fillable = ['subject', 'content', 'sender_id', 'recipient_id'];

    // Сообщение принадлежит отправителю
    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // Сообщение также принадлежит получателю   
    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    public static function getUserMessageByMessageId(int $messageId): Message
    {
        return Message::where('id', $messageId)
                        ->where('recipient_id', Auth::user()->id)
                        ->orWhere('sender_id', Auth::user()->id)
                        ->findOrFail($messageId);
    }
}
