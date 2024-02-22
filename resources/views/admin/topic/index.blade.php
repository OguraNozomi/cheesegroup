@extends('layouts.admin')
@section('title', 'トピック一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>トピック一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('admin.topic.add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
            <div class="col-md-8">
                <form action="{{ route('admin.topic.index') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">タイトル</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}">
                        </div>
                        <div class="col-md-2">
                            @csrf
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="list-topic col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="5%">操作</th>
                                <th width="5%">公開</th>
                                <th width="5%">ID</th>
                                <th width="10%">更新日時</th>
                                <th width="20%">タイトル</th>
                                <th width="50%">本文</th>
                                 <th width="5%">削除</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $topic)
                                <tr>
                                    <td>
                                        <div>
                                            <a href="{{ route('admin.topic.edit', ['id' => $topic->id]) }}">編集</a>
                                        </div>
                                    </td>
                                    <td style=white-space: nowrap>
                                        <div>
                                             
                                             <form action="{{ route('admin.topic.changeflag', ['id' => $topic->id]) }}" method="post" enctype="multipart/form-data">
                                                  @csrf
                                                  <?php if ($topic->release_flag == 0) { ?>
                                                    <input type="submit" class="btn btn-primary" value="非公開">
                                                    <?php }else{ ?>
                                                    <input type="submit" class="btn btn-primary" value="公開">
                                                    <?php } ?>
                                             </form>
                                        </div>
                                    </td>
                                    <th>{{ $topic->id }}</th>
                                     <th>{{ $topic->updated_at }}</th>
                                    <td>{{ Str::limit($topic->title, 100) }}</td>
                                    <td>{!! nl2br(Str::limit(htmlspecialchars($topic->body), 30)) !!}</td>
                                     <td>
                                        <div>
                                           <a href="{{ route('admin.topic.delete', ['id' => $topic->id]) }}">削除</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection