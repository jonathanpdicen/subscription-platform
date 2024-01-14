<?php

use App\Enums\PostStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('website_id')
                ->constrained();
            $table->string('title');
            $table->text('description');
            $table->enum('status', PostStatusEnum::values())
                ->default(PostStatusEnum::DRAFT->value);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
