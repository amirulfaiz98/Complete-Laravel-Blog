@extends('layouts.home');

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/blog-home.css')}}">
@endpush

@section('content')
<div class="col-md-8">
    <h1 class="my-4">Blog Post
      <small></small>
    </h1>
    @foreach ($articles as $article)
        <!-- Blog Post -->
        <div class="card mb-4">
        {{-- <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap"> --}}
        <div class="card-body">
            <h2 class="card-title">{{$article->title}}</h2>
            <p class="card-text">{{ Str::limit($article->body,2) }}</p>
            <a href="{{ route('blog:post',$article)}}" class="btn btn-primary">Read More &rarr;</a>
        </div>
        <div class="card-footer text-muted">
            Posted on {{ $article->created_at}} by
            <a href="#">{{$article->author}}</a>
            @can('update', $article)
                <br><a href="{{route('articles:edit',$article)}}">Edit</a>
            @endcan
        </div>
        </div>
    @endforeach

    <!-- Pagination -->
    <ul class="pagination justify-content-center mb-4">
            <li class="page-item">
              <a class="page-link" href="{{ $articles->previousPageUrl()}}">&larr; Older</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="{{ $articles->nextPageUrl()}}">Newer &rarr;</a>
            </li>
    </ul>
</div>
@endsection
