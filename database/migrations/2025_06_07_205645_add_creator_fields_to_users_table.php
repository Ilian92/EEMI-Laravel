<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('bio')->nullable()->after('username');
            $table->string('profile_picture')->nullable()->after('bio');
            $table->string('banner_image')->nullable()->after('profile_picture');
            $table->decimal('subscription_price', 8, 2)->default(0)->after('banner_image');
            $table->boolean('is_creator')->default(false)->after('subscription_price');
            $table->timestamp('creator_since')->nullable()->after('is_creator');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['bio', 'profile_picture', 'banner_image', 'subscription_price', 'is_creator', 'creator_since']);
        });
    }
};