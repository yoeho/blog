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

    @forelse ($authors as $author)
    @if($author->role->name != 'admin' && $author->name != 'Unknown')
      <div class="scale shadow my-4">
        <div class="card" style="width: 18rem;height: 350px;">
        <div class="card-body">
          <div class="card-subtitle mb-2 text-primary text-right">
            <i class="fa fa-clock-o" style="font-size:20px"></i>&nbsp;&nbsp;{{\Carbon\Carbon::parse($author->created_at)->diffForHumans()}}
          </div>
          <img src="https://www.pngkey.com/png/detail/230-2301779_best-classified-apps-default-user-profile.png" alt="" class="img-fluid mb-3">
          <h5 class="card-title mb-3 text-center">
            <strong>{{$author->name}}</strong>
          </h5>
          @Auth
          @if(Auth::user()->role->name == 'admin')
          <a href="{{route('author-delete',$author->id)}}" class="card-link btn btn-danger">Delete</a>
          @endif
          @endAuth
          <a href="" class="card-link btn btn-info float-right">Readmore</a>
        </div>
      </div>
      </div>
      @endif

      @empty
      <div class="jumbotron col-sm-12 mt-5">
        <h1 class="display-4">No data available !!</h1>
        <p class="text-info">You can also bo a star author. Gettion Start Now.</p>
        <hr class="my-4">
        <a href="" class="btn btn-info float-right">Add Status</a>
      </div>
    @endforelse
  </div>
  <div class="my-5 mx-auto-1">
    {{ $authors->links() }}
  </div>

</div>

  @endsection
