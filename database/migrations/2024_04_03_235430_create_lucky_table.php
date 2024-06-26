<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('lucky', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lucky_number');
            $table->unsignedBigInteger('winning_number');
            $table->foreignIdFor(User::class)->constrained();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lucky');
    }
};
