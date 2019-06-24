<?php

use Illuminate\Database\Seeder;

class PhotoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Photo::class,300)->create()->each(function($photo){
            $article = App\Article::inRandomOrder()->first();
            $photo->article_id = $article->id;
            $photo->save();
        });
    }
}
