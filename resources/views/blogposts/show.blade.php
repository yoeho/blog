@extends('layouts.master')
@section('title','View Post')
@section('content')

<div class="padding-5 container-1">
  @if(session()->has('status'))
  <div class="my-3">
  <div class="alert alert-primary alert-dismissible fade show" role="alert">
  <strong>Congratulations ..!</strong>{{session()->get('status')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  </div>
  @endif
  @if($post->image !=Null)
    <img src="{{asset('image/author/'.$post->image)}}" class="image-1">
  @else
    <img src="https://images.unsplash.com/photo-1484821582734-6c6c9f99a672?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60" alt="" class="image-1">
  @endif
  <h1 class="text-primary">{{$post->title}}</h1>
  <p class="text-danger">Author -( {{$post->user->name}} ) and View - {{$post->view-1}}</p>
  <p>{{$post->content}}</p>

  <span class="font-weight-bold">Comments</span>
    <div class="form-group my-3">
      @foreach($post->comments as $comment)
      <span class="float-left text-primary">{{$comment->user->name}}</span>
      <span class="float-right text-primary">{{$comment->created_at->diffForHumans()}}</span>
      <input type="text" class="form-control my-1" value="{{$comment->description}}" readonly>
      @endforeach
    </div>
  <form action="{{url('comments')}}" method="post">
  @csrf
    @if(Auth::user())
    <input name="blog_post_id" type="hidden" value="{{$post->id}}">
    <div class="form-row my-5">
      <div class="col-sm-11">
        <input type="text" class="form-control" name="description" placeholder="Enter Your Comment">
      </div>
      <div class="col-sm-1">
        <button type="submit" class="btn btn-info float-right" name="button">Done</button>
      </div>
    </div>
    @endif
  </form>

  <div class="row my-3">
    <div class="col-sm-12">
      <a href="{{url('blog-posts')}}" class="float-right btn btn-success my-4">Back</a>
      @if(Auth::user())
        @if(Auth::user()->role->name == 'admin')
        <!---Start Admin Permision -->
      <form action="{{url('blog-posts/'.$post->id)}}" method="post">
      @csrf
      <input name="_method" type="hidden" value="DELETE">

      <a href="{{route('blog-posts.edit',['blog_post'=>$post->id])}}" class="float-right btn btn-info my-4 mr-5">Edit</a>

      <button type="submit" class="float-left btn btn-danger my-4" name="button">Delete</button>
      </form>
      <!--- End Admin Permision -->
        @endif

        @endif
    </div>
  </div>

</div>

@endsection
