@extends('layouts.front')

@section('content')
<div class="bg-img">
 <img src="storage/image/jISG9onrgx8bOkIrLEN1MwXzDfY4bpFvLdOZexvO.jpg" class="img-fluid" alt="">
 </div>
 <div class="greeting">
 <h2>ごあいさつ</h2>
 <h3>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</h3>
 </div>
 
 <h2>最新情報</h2>
  <div class="container grid">
  
   @foreach($posts as $post)
  <div class="img__card">
    @if ($post->photo_1)
     <img src="{{ secure_asset('storage/image/' . $post->photo_1) }}" alt="" class="img-item">
    @endif
    <p class="img-txt"> {{ Str::limit($post->title, 150) }}</p>
    <div class="date">
       {{ $post->updated_at->format('Y年m月d日') }}
     </div>
  </div>
  @endforeach
 
 </div>
@endsection