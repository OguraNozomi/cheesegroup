@extends('layouts.front')

@section('content')
 <h2>最新情報</h2>
    <div class="container">
        <hr color="#c0c0c0">
        <div class="row">
            <div class="posts mx-auto mt-3">
                @foreach($posts as $post)
                    <div class="post">
                        <div class="row">
                            <div class="text">
                                <div class="image text-center mt-4">
                                @if ($post->photo_1)
                                    <img src="{{ secure_asset('storage/image/' . $post->photo_1) }}">
                                @endif
                                </div>
                                <div class="title">
                                    {{ Str::limit($post->title, 150) }}
                                </div>
                                <div class="date">
                                    {{ $post->updated_at->format('Y年m月d日') }}
                                </div>
                                <div class="body mt-3">
                                    {{ Str::limit($post->body, 1500) }}
                                </div>
                            </div>
                           
                        </div>
                    </div>
                    <hr color="#c0c0c0">
                @endforeach
            </div>
        </div>
    </div>
    </div>

@endsection