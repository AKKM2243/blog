@extends('layouts.app')

@section('content')
    <div class="container" style="max-width: 1000">
            <div class="card mb-3 border-primary">
                <div class="card-body">
                    <h2 class="h3 card-title">
                        {{$article->title}}
                    </h2>
                    <b class="text-primary">
                        {{ $article->user->name}}
                    </b>
                    <b>Category:</b>
                    <span>
                        {{ $article->category->name}}
                    </span>
                    <small>
                        {{$article->created_at->diffForHumans()}}
                    </small>
                    <div style="">
                        {{$article->body}}
                    </div>
                    @auth
                        @can('delete-article', $article)
                            <div class="mt-4">
                                <a href="{{url("/articles/delete/$article->id")}}" class="btn btn-sm btn-outline-danger px-3">Delete</a>
                                <a href="{{url("/articles/edit/$article->id")}}" class="btn btn-sm btn-outline-info px-4">Edit</a>
                            </div>
                        @endcan
                    @endauth
                </div>
            </div>
            <ul class="list-group mt-4">
                <li class="list-group-item active">
                    Comments
                    ( {{ count($article->comments)}} )
                </li>
                @foreach ($article->comments as $comment )
                    <li class="list-group-item">
                        @auth
                            @can('delete-comment', $comment)
                                <a href="{{ url("/comments/delete/$comment->id") }}" class="btn-close float-end"></a>
                            @endcan
                        @endauth
                        <b class="text-primary">
                            {{ $comment->user->name}}
                        </b>
                        {{ $comment->content }}
                        <br>
                        <small>
                            {{$article->created_at->diffForHumans()}}
                        </small>
                    </li>

                @endforeach
            </ul>
            @auth
            <form action="{{ url("/comments/add")}}" method="POST" class="mt-3">
                @csrf
                <input type="hidden" name="article_id" value="{{ $article->id }}">
                <textarea name="content" class="form-control mb-2"></textarea>
                <button class="btn btn-secondary">Add Comment</button>
            </form>
            @endauth
    </div>
@endsection
