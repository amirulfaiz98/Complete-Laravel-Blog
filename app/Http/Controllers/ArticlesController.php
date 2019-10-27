<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as BaseRequest;

use App\Article;
use App\Category;
use App\Comment;

use App\Http\Requests\StoreArticleRequest as Request;
class ArticlesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function create(){
        $categories = Category::orderBy('name','ASC')->get()->pluck('name','id');
        return view('articles.create')->with(compact('categories'));
    }

    public function store(Request $request){

        //Method 1
        // $article = new Article();
        // $article->title = $request->get('title');
        // $article->body = $request->get('body');
        // $article->published = $request->get('published');
        // $article->save();

        //Method 2

        //$article = Article::create($request->only('title','body','published'));

        //Method 1
        // $user = auth()->user();
        // $article->user()->associate($user);
        // $article->save();

        //Method 2
        $user = auth()->user();
        $article = $user->articles()->create($request->only('title','body','published'));

        $article->categories()->sync($request->get('categories'));
        $article->save();

        //return redirect('/articles');
        return redirect()->route('articles:index')->with(['alert-type' => 'alert-success','alert'=> 'Your article saved']);
    }

    public function index(){
        $articles = Article::orderBy('created_at','DESC')->paginate(3);

        return view('articles.index')->with(compact('articles'));
    }

    public function edit(Article $article){
        $categories = Category::orderBy('name','ASC')->get()->pluck('name','id');
        return view('articles.edit')->with(compact('article','categories'));
    }

    public function update(Request $request, Article $article){

        $article->update($request->only('title','body','published'));

        $article->categories()->sync($request->get('categories'));
        $article->save();

        return redirect()->route('articles:index')->with(['alert-type' => 'alert-success','alert'=> 'Your article updated']);
    }

    public function delete(Article $article){
        $article->delete();
        return redirect()->route('articles:index')->with(['alert-type' => 'alert-danger','alert'=> 'Your article deleted']);
    }

    public function search(BaseRequest $request){
        $keyword = $request->get('keyword');

        $articles = Article::where('title','LIKE','%'.$keyword.'%')->paginate(3);
        return view('articles.index')->with(compact('articles'));
    }

    public function comment(BaseRequest $request, Article $article){
        $comment = new Comment();
        $comment->message = $request->get('message');
        $comment->article()->associate($article);
        $comment->user()->associate(auth()->user());
        $comment->save();



        return redirect()->route('blog:post',$article);
    }
}
