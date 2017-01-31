<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDefaultsToFiltersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('filters', function (Blueprint $table) {
            $table->integer('min_year')->default(0)->change();
            $table->integer('max_year')->default(0)->change();
            $table->integer('price_min')->default(0)->change();
            $table->integer('price_max')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('filters', function (Blueprint $table) {
            $table->integer('min_year')->change();
            $table->integer('max_year')->change();
            $table->integer('price_min')->change();
            $table->integer('price_max')->change();
        });
    }
}
