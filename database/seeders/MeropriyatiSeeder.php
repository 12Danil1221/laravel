<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MeropriyatiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i <= 10; $i++) {
            Post::create([
                'name' => "Post Title $i",
                'description' => "Мероприятие Совещание $i",
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        }
    }
}