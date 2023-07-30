<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('travel', function (Blueprint $table) {
            $table->id();
            $table->enum('flyType', ['Solo Ida', 'Ida y vuelta', 'Multi-Destino']);
            $table->enum('class', [ 'Económica', 'Económica Premium', 'Negocios', 'Primera']);

            $table->integer('passengers');
            
            $table->enum('origin', ["Berlin","Paris","Oslo","Estocolmo","Habana","Washingtown",
                                    "Moscow","Budapest","Londres","Madrid"]);
            
            $table->date('dateOrigin');
            
            $table->enum('destiny', ["Berlin","Paris","Oslo","Estocolmo","Habana","Washingtown",
                                    "Moscow","Budapest","Londres","Madrid"]);

            $table->date('dateDestiny')-> nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travel');
    }
};
