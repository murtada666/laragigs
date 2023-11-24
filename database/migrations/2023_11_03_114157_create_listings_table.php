<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            // constrained(): This method is part of Laravel's fluent migration system and is used to specify that the 'user_id' column is a foreign key that references the 'id' column in another table. By default, Laravel assumes that the foreign key column name follows the convention of appending "_id" to the referenced table's singular name ('user' in this case).
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            // It will store the path to the logo.
            $table->string('logo')->nullable(); // Nullable as it can be empty.
            $table->string('tags');
            $table->string('company');
            $table->string('location');
            $table->string('email');
            $table->string('website');
            $table->longText('description');    
            $table->timestamps();
        });
    }

    /*
        - To make a relationship between tables: 
            * First in the many side part(in this case is listing) we need to add a foreignId to migration of that table of (many) side.
            * second we need to make a function with (belongsTo) inside it in the many side model(check listing model).
            * Third we need to make function 
    */

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
