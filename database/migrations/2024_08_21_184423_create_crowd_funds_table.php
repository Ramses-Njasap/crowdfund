<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrowdFundsTable extends Migration
{
    public function up()
    {
        Schema::create('crowd_funds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->timestamp('duration');
            $table->decimal('goal', 15, 2);
            $table->decimal('raised', 15, 2);
            $table->string('image');
            $table->text('short_story');
            $table->text('story');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('crowd_funds');
    }
}
