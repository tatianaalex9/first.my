<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            //->foreign Поле sender_id ссылается на поле `id` таблицы `users`
            $table->bigInteger('sender_id')->foreign('sender_id')->references('id')->on('users');
            $table->bigInteger('recipient_id')->foreign('recipient_id')->references('id')->on('users');//получатель
            $table->string('subject', 250)->nullable();//тема
            $table->text('content')->nullable();
            $table->timestamps(); 
            $table->boolean('activity')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
