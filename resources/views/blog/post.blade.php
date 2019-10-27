@extends('layouts.home')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/blog-post.css')}}">
@endpush

@section('content')

      <!-- Post Content Column -->
      <div class="col-lg-8">

            <!-- Title -->
            <h1 class="mt-4">{{$article->title}}</h1>

            <!-- Author -->
            <p class="lead">
              by
              <a href="#">{{$article->author}}</a>
            </p>

            <hr>

            <!-- Date/Time -->
            <p>Posted on {{ $article->created_at}}</p>

            <hr>

            <!-- Preview Image -->
            {{-- <img class="img-fluid rounded" src="http://placehold.it/900x300" alt=""> --}}

            <hr>

            <!-- Post Content -->
            <p class="lead">{{$article->body}}</p>


            <hr>

            <!-- Comments Form -->
        <div class="card my-4">
            <h5 class="card-header">Leave a Comment:</h5>
            <div class="card-body">
                @auth
                    @can('manage','App\Article')
                        <form method="POST" action=" {{ route('articles:comment', $article)}}" >
                            @csrf
                            <div class="form-group">
                            <textarea class="form-control" rows="3" name="message"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    @endcan
                    @cannot('manage','App\Article')
                        You have to be admin or owner of post to comment.
                    @endcannot
                @else
                    <a href=" {{ url('/login')}}">Sign In</a> to comment.

                @endif
            </div>
          </div>

          <!-- Single Comment -->
          <h3 class="mb-4">Comments ({{$article->comments->count()}})</h3>
          @foreach ($article->comments as $comment)


            <div class="media mb-4">
                <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                <div class="media-body">
                  <h5 class="mt-0">{{ $comment->user->name}}</h5>
                  {{ $comment->message}}
                </div>
                {{ $comment->created_at->diffForHumans()}}
              </div>
            @endforeach

      </div>

@endsection


