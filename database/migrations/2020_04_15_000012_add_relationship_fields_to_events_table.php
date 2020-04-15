<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEventsTable extends Migration
{
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->unsignedInteger('sport_id')->nullable();
            $table->foreign('sport_id', 'sport_fk_1315609')->references('id')->on('sports');
            $table->unsignedInteger('region_id')->nullable();
            $table->foreign('region_id', 'region_fk_1315610')->references('id')->on('regions');
            $table->unsignedInteger('charity_id')->nullable();
            $table->foreign('charity_id', 'charity_fk_1315611')->references('id')->on('charities');
            $table->unsignedInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_1315615')->references('id')->on('users');
        });

    }
}
