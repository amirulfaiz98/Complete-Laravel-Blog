@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Articles Dashboard
                        <div class="float-right">
                                <a href="{{ route('articles:create') }}" class="btn btn-primary">New </a>
                            </div>
                </div>

                <div class="card-body">

                    <form class="form-inline" method="GET" action="{{ route('articles:search')}}">
                        <input type="text" id="search"
                                class="form-control mb-2"
                                placeholder="Search"
                                name="keyword"
                                value="{{ request()->get('keyword')}}">
                        <button type="submit" class="btn btn-primary mb-2">Search</button>
                    </form>
                    @if (session()->has('alert'))
                        <div class="alert {{ session()->get('alert-type')}}">
                            {{session()->get('alert')}}
                        </div>

                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Created</th>
                                <th>Submitted by</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $article)
                                <tr>
                                    <td>{{ $article->id}}</td>
                                    <td>{{ $article->title}}</td>
                                    <td>{{ $article->submitted_date}}</td>
                                    <td>{{ $article->author}}</td>
                                    <td>
                                        <a href="{{ route('articles:edit',$article)}}" class="btn btn-primary">Edit</a>
                                        <a href="{{ route('articles:delete',$article)}}" class="btn btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $articles->appends(['keyword' =>request()->get('keyword')])->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
