<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blood_transfer_center_id')->constrained()->onDelete('cascade');
            $table->enum('bloodType',['O-','O+','B-','B+','A-','A+','AB-','AB+']);
            $table->integer('stock');
            $table->integer('capacity');
            $table->integer('threshold');
            $table->timestamps();
            $table->unique(['blood_transfer_center_id','bloodType']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blood_stocks');
    }
};
