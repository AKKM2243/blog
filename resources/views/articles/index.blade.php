@extends('layouts.app')

@section('content')
    <div class="container" style="max-width: 1000">

        {{ $articles->links() }}

        @if(session("info"))
            <div class="alert alert-info">
                {{ session("info") }}
            </div>
        @endif

        @foreach ($articles as $article)
            <div class="card mb-3">
                <div class="card-body">
                    <h2 class="h4 card-title">
                        {{$article->title}}
                    </h2>
                    <small>

                        <b class="text-primary">
                            {{ $article->user->name}}
                        </b>

                        <b>Category:</b>
                        {{ $article->category->name }}
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{$article->created_at->diffForHumans()}}
                    </small>
                    <div>
                        {{$article->body}}
                    </div>
                    <div class="mt-1">
                        <a href="{{url("/articles/detail/$article->id")}}" class="card-link">View Detail</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
