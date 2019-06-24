<?php

use Illuminate\Database\Seeder;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Article::class,100)->create()->each(function($article){
            $user = App\User::inRandomOrder()->first();
            $article->user_id = $user->id;
            $article->save();
        });
    }
}
