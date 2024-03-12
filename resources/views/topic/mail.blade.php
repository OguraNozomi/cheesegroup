@extends('layouts.front')

@section('content')

 <div class="container">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <h2 style="text-align:center">問い合わせ</h2>
                <form action="{{ route('topic.sendmail') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                             <label>氏名<br>
                            <input type="text" class="form-control" name="name"></label>
                    </div>
                    <div class="form-group row" >
                            <label >メールアドレス<br>
                           <input type="email" class="form-control" name="email"></label>
                    </div>
                    <div class="form-group row">
                             <label >題名<br>
                           <input type="text" class="form-control" name="subject"></label>
                    </div>
                    <div class="form-group row">
                             <label for="body">メッセージ本文<br>
                            <textarea class="form-control" name="body" rows="20"></textarea></label>
                   
                    </div>
                   
                    @csrf
                    <input type="submit" class="btn btn-primary" value="送信">
                </form>
            </div>
        </div>
    </div>
@endsection