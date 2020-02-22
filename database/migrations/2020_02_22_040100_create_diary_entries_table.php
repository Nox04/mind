<?php

use App\Enums\MoodsEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiaryEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diary_entries', function (Blueprint $table) {
            // Schema
            $table->bigIncrements('id');
            $table->date('entry_date');
            $table->enum('mood', MoodsEnum::getValues());
            $table->text('content')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            // Relationships
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diary_entries');
    }
}
