<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;

use App\BlogPost;

use App\Subscriber;

use App\Comment;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use App\Http\Requests\StoreBlogPost;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $blogposts = BlogPost::paginate(9);
      $comments = Comment::all();
      // $blogposts = DB::table('blog_posts')->paginate(9);
      return view('blogposts.index',['blogposts'=>$blogposts,'comments'=>$comments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blogposts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogPost $request)
    {
      // $validateData = $request->validate();//old method clode

        // dd($request)

        // echo $request->title;
        // echo $request->author;
        // echo $request->content;

        // $blogPost = new BlogPost;
        // $blogPost->title = $request->title;
        // $blogPost->author = $request->author;
        // $blogPost->content = $request->content;
        // $blogPost->view = 0;
        // $blogPost->save();
        $file = $request->file('image');

        $file_name = uniqid().'_'.$request->image->getClientOriginalName();

        $file->move(public_path().'/image/author/',$file_name);

        BlogPost::create(['image'=>$file_name,'title'=>$request->title,'user_id'=>Auth::user()->id,'content'=>$request->content]);
        session()->flash('status',' ( Author -' .Auth::user()->name.' ) and '. ' ( Tilte -'.$request->title. ' ) are created now!!');
        $latestPost = DB::table('blog_posts')->orderBy('created_at','desc')->first();
        $subscribers = Subscriber:: all();
        $data = array('name'=>'Blog Application','author'=>Auth::user()->name,'title'=>$request->title,'content'=>$request->content,'id'=>$latestPost->id);
        foreach($subscribers as $subscriber){
        Mail::send('mails/mail', $data, function($message) use ($subscriber) {
          $message->to($subscriber->email, $subscriber->name)->subject
          ('HTML Testing Mail');
          $message->from('yoeholaravel@gmail.com','Blog Application');
        });
      }
        echo "HTML Email Sent. Check your inbox.";
        return redirect()->route('blog-posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $blogPost = BlogPost::find($id);

        BlogPost::where('id',$id)->update(['view'=>$blogPost->view+1]);
        return view('blogposts.show',['post'=>BlogPost::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('blogposts.edit',['post'=>BlogPost::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $file = $request->file('image');

        $file_name = uniqid().'_'.$request->image->getClientOriginalName();

        $file->move(public_path().'/image/author/',$file_name);
        
        BlogPost::where('id',$id)->update(['image'=>$file_name,'title'=>$request->title,'user_id'=>Auth::user()->id,'content'=>$request->content]);
        session()->flash('status',' ( Author -'. Auth::user()->name.' ) and '.' Title -'. $request->title. ' ) are updated now...!!');
        return redirect()->route('blog-posts.show',['blog_post'=>$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $blogPost = BlogPost::find($id);
      session()->flash('status-1',' ( User -'. Auth::user()->name.' ) and '. '( Title -'.$blogPost->title. ' ) are deleted now...!!');
      $blogPost->delete();
      return redirect()->route('blog-posts.index');
    }
}
