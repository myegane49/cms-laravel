<x-admin-master>
  @section('content')
      <h1>User Profile for: {{$user->name}}</h1>

      <div class="col-sm-6">
        <form method="post" action="{{route('user.update', $user->id)}}" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="mb-4"><img height="100px" src="{{$user->avatar}}" alt="user avatar"></div>
          <div class="form-group">
            <input type="file" class="form-control-file" name="avatar">
          </div>

          <div class="form-group">
            <label>Username</label>
            {{-- <input type="text" name="username" class="form-control {{$errors->has('username') ? 'is-invalid': ''}}" value="{{$user->username}}"> --}}
            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{$user->username}}">

            @error('username')
              <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>

          <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{$user->name}}">

            @error('name')
              <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>

          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{$user->email}}">

            @error('email')
              <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>

          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control">

            @error('password')
              <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>

          <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="password-confirm" class="form-control">

            @error('password-confirm')
              <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>

          <button class="btn btn-primary">Submit</button>
        </form>
      </div>
  @endsection
</x-admin-master>