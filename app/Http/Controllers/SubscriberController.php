<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Subscriber;

use Mail;

use Illuminate\Support\Facades\DB;

use App\Http\Requests\StoreSubscriber;

class SubscriberController extends Controller
{

    public function store(StoreSubscriber $request)
    {
      $subsuriber = Subscriber::where('email', '=', $request->email)->first();

      if($subsuriber === null) {
        $character = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $pin = mt_rand(10,99).$character[rand(0,strlen($character) - 1)].mt_rand(10,99).$character[rand(0,strlen($character) - 1)];
        $confirmation_code = str_shuffle($pin);
        Subscriber::create(['name'=>$request->name,'email'=>$request->email,'confirmation_code'=>$confirmation_code]);
        session()->flash('status-2','HTML Email Sent. Check your inbox.');
        $data = array('name'=>'Blog Application','username'=>$request->name,'email'=>$request->email,'confirmation_code'=>$confirmation_code);
          Mail::send('mails/subscriber_mail', $data, function($message) use ($request) {
            $message->to($request->email, $request->name)->subject
            ('HTML Testing Mail');
            $message->from('yoeholaravel@gmail.com','Blog Application');
          });
      }else{
        session()->flash('status-3',' Your subscribe has been already!!');
      }
      return redirect()->route('blog-posts.index');

    }

    public function confirmation()
    {
      return view('mails.confirmation-form');
    }

    public function mail_confirmation(Request $request){
      $confirmation_code = $request->digit1.$request->digit2.$request->digit3.$request->digit4.$request->digit5.$request->digit6;

      $subscriber = Subscriber::where('confirmation_code', '=', $confirmation_code)->first();
      if ($subscriber === null) {
        echo "Fail";
         // user doesn't exist
        return view('mails.confirmation-form');
      }

      else {
        Subscriber::where('email', '=', $subscriber->email)->update(['confirmation_code'=>'confirm', 'status'=>true]);
        $data = array('email'=>$subscriber->email,'name'=>$subscriber->name);
        session()->flash('status-4',' Your subscribe has been successful!!');
        Mail::send('mails.confirmation_success', $data, function($message) use ($subscriber) {
           $message->to($subscriber->email,$subscriber->name)->subject
              ('Subscription Success');
           $message->from('yoeholaravel@gmail.com','ITVisionHub Feed Zone');
        });

        echo "Check your mail";
        return redirect()->route('blog-posts.index');
      }
    }
}
