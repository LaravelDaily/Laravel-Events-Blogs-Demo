<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPostsTable extends Migration
{
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedInteger('sport_id')->nullable();
            $table->foreign('sport_id', 'sport_fk_1315619')->references('id')->on('sports');
            $table->unsignedInteger('event_id')->nullable();
            $table->foreign('event_id', 'event_fk_1315620')->references('id')->on('events');
        });

    }
}
