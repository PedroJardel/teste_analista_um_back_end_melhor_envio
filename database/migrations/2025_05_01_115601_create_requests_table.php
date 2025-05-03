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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('method');
            $table->string('url');
            $table->integer('status_code');
            $table->string('consumer_id');
            $table->string('service_id');
            $table->string('route_id');
            $table->string('client_ip');
            $table->integer('latency_proxy');
            $table->integer('latency_gateway');
            $table->integer('latency_request');

            $table->foreign('consumer_id')->references('id')->on('consumers')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('service_id')->references('id')->on('services')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('requests', function (Blueprint $table) {
            $table->dropForeign(['consumer_id']);
            $table->dropForeign(['service_id']);
        });

        Schema::dropIfExists('requests');
    }
};
