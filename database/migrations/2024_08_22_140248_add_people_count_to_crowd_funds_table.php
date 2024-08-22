<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('crowd_funds', function (Blueprint $table) {
            $table->decimal('raised')->default(0);
            $table->integer('people_count')->default(0);
        });
    }

    public function down()
    {
        Schema::table('crowd_funds', function (Blueprint $table) {
            $table->dropColumn('raised');
            $table->dropColumn('people_count');
        });
    }
};
