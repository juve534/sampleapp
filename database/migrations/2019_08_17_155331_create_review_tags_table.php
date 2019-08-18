<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('review_id', false, true);
            $table->integer('tag_id', false, true);
            $table->timestamp('created_at')->nullable();
            $table->unique(['review_id', 'tag_id'], 'UNIQUE_IDX_REVIEW_TAG');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review_tags');
    }
}
