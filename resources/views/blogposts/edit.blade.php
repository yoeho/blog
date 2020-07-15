@extends('layouts.master')
@section('title','Edit Post')
@section('content')
<div class="padding-5">
  <h4 class="display-4">Edit post</h4>

  @if($errors->any())
  @foreach($errors->all() as $error)

  <p class="text-danger">{{$error}}</p>

  @endforeach
  @endif

  <form action="{{route('blog-posts.update',['blog_post'=>$post->id])}}" method="post" enctype="multipart/form-data">

    @csrf
    <input type="hidden" name="_method" value="PUT">
    <div class="form-group row">
    <label for="inputTitle" class="col-sm-2 col-form-label text-primary">Title</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputTitle" name="title" placeholder="Title" value="{{$post->title}}">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputGroupFile01" class="col-sm-2 col-form-label text-primary">Upload Image</label>
    <div class="col-sm-10">
      <input type="file" class="custom-file-input" name="image" id="inputGroupFile01">
      <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
    </div>
  </div>

  <div class="form-group row">
    <label for="inputContent" class="col-sm-2 col-form-label text-primary">Content</label>
    <div class="col-sm-10">
      <textarea name="content" class="form-control" rows="8" cols="80">{{$post->content}}</textarea>
    </div>
  </div>
    <a href="{{route('blog-posts.show',['blog_post'=>$post->id])}}" class="btn btn-secondary">Cancle</a>
    <input type="submit" class="btn btn-info mb-5 float-right" value="Save">
  </form>
</div>
@endsection
