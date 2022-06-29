<?php


use App\Models\User;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('price');
            $table->string('coupon')->default(null);
            $table->string('foodParty')->default(null);
            $table->string('ingredients');
            $table->string('foodCategory');
            $table->string('image');
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Restaurant::class);
            $table->timestamps();
            // $table->morphs('categoryable');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foods');
    }
};
