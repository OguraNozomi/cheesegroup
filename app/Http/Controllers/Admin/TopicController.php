<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


//DB利用追加
use App\Models\Topic;

//ログイン情報
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    public function add()
    {
        return view('admin.topic.create');
    }

    public function create(Request $request)
    {
        // 以下を追記
        // Validationを行う
        $this->validate($request, Topic::$rules);

        $topic = new Topic;
        $form = $request->all();

        // フォームから画像が送信されてきたら、保存して、$topic->photo1 に画像のパスを保存する
        if (isset($form['image1'])) {
            $path = $request->file('image1')->store('public/image');
            $topic->photo_1 = basename($path);
        } else {
            $topic->photo_1 = null;
        }

        if (isset($form['image2'])) {
            $path = $request->file('image2')->store('public/image');
            $topic->photo_2 = basename($path);
        } else {
            $topic->photo_2 = null;
        }

        if (isset($form['image3'])) {
            $path = $request->file('image3')->store('public/image');
            $topic->photo_3 = basename($path);
        } else {
            $topic->photo_3 = null;
        }

        //フラグ非公開0
         $topic->release_flag = 0;

        
        //更新データ　
        $topic->user_id = Auth::id();
        //$topic->user_id = '2';
        $topic->user_name = Auth::user()->name;
        //$topic->user_name = 'taro';
        

        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // フォームから送信されてきたimageを削除する
        unset($form['image1']);
        unset($form['image2']);
        unset($form['image3']);

        // データベースに保存する
        $topic->fill($form);
        $topic->save();

        //return redirect('admin/topic/create');
        return redirect('admin/topic');
    }

    // トピック一覧
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            // 検索されたら検索結果を取得する
            $posts = Topic::where('title', $cond_title)->latest('updated_at')->get();
        } else {
            // それ以外はすべてのトピックを取得する
            //$posts = Topic::all();
            $posts = Topic::latest('updated_at')->get();
        }
        return view('admin.topic.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }

    //編集
    public function edit(Request $request)
    {
        // Topic Modelからデータを取得する
        $topic = Topic::find($request->id);
        if (empty($topic)) {
            abort(404);
        }
        return view('admin.topic.edit', ['topic_form' => $topic]);
    }

    //更新
    public function update(Request $request)
    {
        // Validationをかける
        $this->validate($request, Topic::$rules);
        // topic Modelからデータを取得する
        $topic = Topic::find($request->id);
        // 送信されてきたフォームデータを格納する
        $topic_form = $request->all();
       
        //削除
        if ($request->remove1 == 'true') {
            $topic_form['photo_1'] = null;
        } elseif ($request->file('image1')) {   //変更
            $path = $request->file('image1')->store('public/image');
            $topic_form['photo_1'] = basename($path);
        } else {
            $topic_form['photo_1'] = $topic->photo_1;
        }
        
        if ($request->remove2 == 'true') {
            $topic_form['photo_2'] = null;
        } elseif ($request->file('image2')) {   //変更
            $path = $request->file('image2')->store('public/image');
            $topic_form['photo_2'] = basename($path);
        } else {
            $topic_form['photo_2'] = $topic->photo_2;
        }
        
          if ($request->remove3 == 'true') {
            $topic_form['photo_3'] = null;
        } elseif ($request->file('image3')) {   //変更
            $path = $request->file('image3')->store('public/image');
            $topic_form['photo_3'] = basename($path);
        } else {
            $topic_form['photo_3'] = $topic->photo_3;
        }

        unset($topic_form['image1']);
        unset($topic_form['image2']);
        unset($topic_form['image3']);
        unset($topic_form['remove1']);
        unset($topic_form['remove2']);
        unset($topic_form['remove3']);
        unset($topic_form['_token']);
        
        //更新者　
        $topic_form['user_id'] = Auth::id();
        $topic_form['user_name'] = Auth::user()->name;

        // 該当するデータを上書きして保存する
        $topic->fill($topic_form)->save();

        return redirect('admin/topic');
    }

    //公開フラグ変更
    public function changeflag(Request $request)
    {
    
        // topic Modelからデータを取得する
        $topic = Topic::find($request->id);
        // データを格納する
        //$topic_form = $topic->all();
       
      //フラグ変更
      if($topic->release_flag == 0){
          $topic->release_flag = 1;
      }else{
          $topic->release_flag = 0;
      }
      
       
        //更新者　
        $topic->user_id = Auth::id();
        $topic->user_name = Auth::user()->name;

        // 該当するデータを上書きして保存する
        $topic->save();

        return redirect('admin/topic');
    }
    
    //削除
     public function delete(Request $request)
    {
        // 該当するTopic Modelを取得
        $topic = Topic::find($request->id);

        // 削除する
        $topic->delete();

        return redirect('admin/topic/');
    }
    
    
}
