<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Category;
class BlogController extends Controller
{
    public function index(){
        $articles = Article::orderBy('created_at','DESC')->published()->paginate(10);

        $categories = Category::orderBy('name','ASC')->get()->pluck('name','id');

        return view('blog.home')->with(compact('articles','categories'));
    }

    public function getArticle(Article $article){

        $categories = Category::orderBy('name','ASC')->get()->pluck('name','id');

        return view('blog.post')->with(compact('article','categories'));
    }

    public function getByCategory(Category $category){

        $categories = Category::orderBy('name','ASC')->get()->pluck('name','id');

        $articles = $category->articles()->orderBy('created_at','DESC')->paginate(5);

        return view('blog.home')->with(compact('articles','categories'));
    }


}
