<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use Faker\Generator as Faker;

use App\User;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 15; $i++) {

          $newPost = new Post;

          $randomUser = User::inRandomOrder()->first();
          $newPost->user_id = $randomUser->id;

          $newPost->title = $faker->sentence(6, true);
          $newPost->slug = Str::of($newPost->title)->slug('-');
          $newPost->content = $faker->paragraph(30, true);

          $newPost->save();
        }
    }
}
