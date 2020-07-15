<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\BlogPost;

class AuthorController extends Controller
{
  public function viewAll(User $model)
  {
    $authors = $model::paginate(9);
    return view('authors.index',['authors'=>$authors]);
  }

  public function delete($id)
  {
    $posts = BlogPost::where('user_id','=',$id)->get();
    // return $posts;
      for($i=0;$i<count($posts);$i++)
      {
        // $blogPost = BlogPost::find($posts[$i]->id);
        BlogPost::find($posts[$i]->id)->delete();
      }
      User::find($id)->delete();
      return redirect()->route('authors');
  }
}
