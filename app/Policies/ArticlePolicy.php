<?php

namespace App\Policies;

use App\Article;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    public function view(User $user, Article $article){
        if($article->published == 1 || $article->user_id == $user->id){
            return true;
        }

        return false;

    }

    public function manage(User $user){
        return $user->user_level >0;
    }

    public function update(User $user, Article $article){
        return $article->user_id == $user->id;
    }
}
