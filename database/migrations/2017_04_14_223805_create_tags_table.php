<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration {

    public function up() {
        Schema::create('tags', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->integer('is_master')->unsigned()->default(0);
          $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('tags');
    }

}
