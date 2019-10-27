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
        factory('App\User')->times(10)->create(['user_level' => 1])
            ->each(function($user){
                $article = factory('App\Article')->make();
                $user->articles()->save($article);
            });
    factory('App\Article')->times(5)->create();
    }
}
