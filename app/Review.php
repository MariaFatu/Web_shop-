<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public $fillable = ['id','user_id', 'product_id', 'review', 'sentiment', 'score'];
    /**public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
        $table->increments('id');
        $table->integer("user_id", 11)->nullable();
        $table->integer("product_id", 11)->nullable();
        $table->string("review", 5000);
        $table->string("sentiment", 20)->nullable();
        $table->integer("scor", 11)->nullable();
        $table->timestamps();
    });
    }
 /**
 * Reverse the migrations.
 *
 * @return void
 */
    /**public function down()
    {
        Schema::dropIfExists('reviews');
    }
    
*/
}

