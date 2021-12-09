<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(app('config')->get('address-book.database.connection'))
            ->create(app('config')->get('address-book.database.table'), function (Blueprint $table)
            {
                $table->id();
                $table->efficientUuid('uuid')->index();
                $table->string('name')->nullable();
                $table->string('user_id')->nullable();
                $table->string('country')->nullable();
                $table->string('province')->nullable();
                $table->string('city')->nullable();
                $table->string('district')->nullable();
                $table->string('postal_code', 10)->nullable();
                $table->text('address')->nullable()->default(NULL);
                $table->tinyInteger('default')->nullable();
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
        Schema::connection(app('config')->get('address-book.database.connection'))->dropIfExists('address_books');
    }
}
