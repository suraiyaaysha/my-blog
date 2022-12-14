@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                 <div class="row">
                    <div class="col-8">
                        <h1 class="display-one">Our Blog!</h1>
                        <p>Enjoy reading our posts. Click on a post to read!</p>
                    </div>
                    <div class="col-4">
                        <p>Create new Post</p>
                        {{-- <a href="/blog/create/post" class="btn btn-primary btn-sm">Add Post</a> --}}


                        {{-- // suraiya --}}
                        @if (Auth::check())
                            <a href="/blog/create/post" class="btn btn-primary btn-sm">Add Post</a>
                        @else
                            <a href="/login" class="btn btn-primary btn-sm">Add Post</a>
                        @endif
                        {{-- // suraiya --}}


                    </div>
                </div>                
                @forelse($posts as $post)
                    <ul>
                        <li>
                            <a href="./blog/{{ $post->id }}">{{ ucfirst($post->title) }}</a>
                                <img src="{{ asset($post->photo) }}" alt="post photo here" width="200" height="100">
                                  {{-- <img src= "{{Storage::get('public/images/', $post->photo) }}" alt="Card image cap"> --}}

                        </li>
                    </ul>
                @empty
                    <p class="text-warning">No blog Posts available</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection