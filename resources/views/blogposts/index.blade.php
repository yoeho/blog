@extends('layouts.master')
@section('title','Blog Posts')
@section('content')

<div class="padding-5">

  <div style="display: flex;flex-wrap: wrap;flex-direction: row;justify-content: space-around;">

    @if(session()->has('status'))
    <div class="col-md-12 my-3">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Congratulations ..!</strong>{{session()->get('status')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
    </div>
    @endif

    @if(session()->has('status-1'))
    <div class="col-md-12 my-3">
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Congratulations ..!</strong>{{session()->get('status-1')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
    </div>
    @endif

    @if(session()->has('status-2'))
    <div class="col-md-12 my-3">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{session()->get('status-2')}}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
    </div>
    @endif

    @if(session()->has('status-3'))
    <div class="col-md-12 my-3">
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
    <strong>{{session()->get('status-3')}}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
    </div>
    @endif

    @if(session()->has('status-4'))
    <div class="col-md-12 my-3">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Congratulations ..!</strong>{{session()->get('status-4')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
    </div>
    @endif
    @if(Auth::user())
    <button type="button" class="btn btn-danger fixed-top fixed-top-1 ml-2" data-toggle="modal" data-target="#staticBackdrop">
      SUBSCRIBE
    </button>
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Subscribe to my side</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            @if($errors->any())
            @foreach($errors->all() as $error)

            <p class="text-danger">{{$error}}</p>

            @endforeach
            @endif
            <form action="{{url('subscribers')}}" method="post">
              @csrf
              <div class="form-group">
                <label for="exampleInputPassword1">Name</label>
                <input type="text" class="form-control" name="name" id="exampleInputPassword1" placeholder="name" value="{{old('name')}}">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="email" value="{{old('email')}}">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
              </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
          </div>
        </div>
      </div>
    </div>
    @endif
    @forelse ($blogposts as $blogpost)
      <div class="scale shadow my-4">
        <div class="card" style="width: 18rem;height: 450px;">
        <div class="card-body">
          <div class="card-subtitle mb-2 text-primary text-right">
            <i class="fa fa-clock-o" style="font-size:20px"></i>&nbsp;&nbsp;{{\Carbon\Carbon::parse($blogpost->created_at)->diffForHumans()}}
          </div>
          <div class="card-image mb-2">
            @if($blogpost->image != Null)
            <img class="image" src="{{asset('image/author/'.$blogpost->image)}}" class="img-fluid">
            @else
            <img class="image" src="https://images.unsplash.com/photo-1484821582734-6c6c9f99a672?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60" class="img-fluid">
            @endif
          </div>
          <h5 class="card-title mb-3">
            <strong>{{$blogpost->title}}</strong>
          </h5>
          <h6 class="card-subtitle mb-3">
            (Author- {{$blogpost->user->name}})
          </h6>
          <p class="card-text my-3">
            {{substr($blogpost->content,0,40)}} ...
          </p>
          <a href="" class="card-link btn btn-warning">View-{{$blogpost->view}}</a>
          <a href="{{route('blog-posts.show',['blog_post'=>$blogpost->id])}}" class="card-link btn btn-info float-right">Readmore</a>
        </div>
      </div>
      </div>
      @empty
      <div class="jumbotron col-sm-12 mt-5">
        <h1 class="display-4">No data available !!</h1>
        <p class="text-info">You can also bo a star author. Gettion Start Now.</p>
        <hr class="my-4">
        <a href="{{route('blog-posts.create')}}" class="btn btn-info float-right">Add Status</a>
      </div>
    @endforelse
  </div>
  <div class="my-5 mx-auto-1">
    {{ $blogposts->links() }}
  </div>

</div>

  @endsection
