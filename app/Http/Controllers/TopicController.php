<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// 追記
use App\Models\Topic;

use App\Mail\Notification;
use Illuminate\Support\Facades\Mail;

class TopicController extends Controller
{
    //top
     public function top(Request $request)
    {
        //最新3件のみ
        //$posts = Topic::all()->sortByDesc('updated_at');
        $posts = Topic::where('release_flag', '1')->orderBy('updated_at', 'DESC')->take(6)->get();

        // topic/index.blade.php ファイルを渡している
        // また View テンプレートに headline、 posts、という変数を渡している
        return view('topic.top', ['posts' => $posts]);
        // return view('topic.top');
    }
    
    //　最新情報
    public function index(Request $request)
    {
        //$posts = Topic::all()->sortByDesc('updated_at');
        $posts = Topic::where('release_flag', '1')->orderBy('updated_at', 'DESC')->get();

        // topic/index.blade.php ファイルを渡している
        // また View テンプレートに headline、 posts、という変数を渡している
        return view('topic.index', ['posts' => $posts]);
        //return view('topic.index');
    }

    
    //プロフィール
     public function profile(Request $request)
    {
        
         return view('topic.profile');
    }
    
    //入会情報
     public function registration(Request $request)
    {
        
         return view('topic.registration');
    }
    
    //問い合わせ
     public function mail(Request $request)
    {
        
         return view('topic.mail');
    }
    
    //問い合わせ送信
     public function sendmail(Request $request)
    {
        $name = $request->get('name');
        $email =  $request->get('email');
        $subject = $request->get('subject');
        $body = $request->get('body');
        $mail_to = config('mail.sendto');
        
        Mail::to($mail_to)->send(new Notification($name, $email, $subject, $body) );
        
         return redirect('/');
    }
}
