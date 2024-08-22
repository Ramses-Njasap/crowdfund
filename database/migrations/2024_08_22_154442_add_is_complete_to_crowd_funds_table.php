<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsCompleteToCrowdfundsTable extends Migration
{
    public function up()
    {
        Schema::table('crowd_funds', function (Blueprint $table) {
            $table->boolean('is_complete')->default(false); // Adds a new boolean column with default value false
        });
    }

    public function down()
    {
        Schema::table('crowd_funds', function (Blueprint $table) {
            $table->dropColumn('is_complete');
        });
    }
};

