<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->foreignId('type_id')->constrained('publication_types');
            $table->foreignId('staff_id')->constrained('staffs')->onDelete('cascade');
            $table->string('publisher')->nullable();
            $table->year('year')->nullable();
            $table->string('journal_name')->nullable();
            $table->string('page')->nullable();
            $table->string('volume')->nullable();
            $table->string('issue')->nullable();
            $table->string('city')->nullable();
            $table->string('conference_publication_name')->nullable();
            $table->string('link')->nullable();


            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publication');
    }
}
