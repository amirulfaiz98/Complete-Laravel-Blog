<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table= 'articles';

    protected $fillable =[
        'title', 'body', 'published'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    //define $article->author
    public function getAuthorAttribute(){
        return !is_null($this->user) ? $this->user->name : 'N/A';
    }

    //define $article->submitted_date
    public function getSubmittedDateAttribute(){
        return $this->created_at->format('d/m/Y');
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function scopePublished($query){
        return $query->where('published',1);
    }
}
