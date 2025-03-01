<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete();
        });
    }

    public function down(): void{
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign('posts_author_id_foreign');
            $table->dropColumn('author_id');
        });
    }
};
