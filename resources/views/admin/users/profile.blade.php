<x-admin-master>
  @section('content')
      <h1>User Profile for: {{$user->name}}</h1>

      <div class="row">
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
      </div>

      <div class="row">
        <div class="col-sm-12">
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Options</th>
                      <th>Id</th>
                      <th>Name</th>
                      <th>Slug</th>
                      <th>Attach</th>
                      <th>Detach</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Options</th>
                      <th>Id</th>
                      <th>Name</th>
                      <th>Slug</th>
                      <th>Attach</th>
                      <th>Detach</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($roles as $role)
                        <tr>
                          <td><input type="checkbox"
                              @foreach ($user->roles as $user_role)
                                  @if ($user_role->slug == $role->slug)
                                      checked
                                  @endif
                              @endforeach
                            ></td>
                          <td>{{$role->id}}</td>
                          <td>{{$role->name}}</td>
                          <td>{{$role->slug}}</td>
                          <td>
                            <form action="{{route('user.role.attach', $user->id)}}" method="post">
                              @csrf
                              @method('PUT')
                              <input type="hidden" value="{{$role->id}}" name="role">
                              <button class="btn btn-primary"
                                @if ($user->roles->contains($role))
                                  disabled
                                @endif
                              >
                                Attach
                              </button>
                            </form>
                          </td>
                          <td>
                            <form action="{{route('user.role.detach', $user->id)}}" method="post">
                              @csrf
                              @method('PUT')
                              <input type="hidden" value="{{$role->id}}" name="role">
                              <button class="btn btn-danger"
                                @if (!$user->roles->contains($role))
                                  disabled
                                @endif
                              >
                                Detach
                              </button>
                            </form>
                          </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
  @endsection
</x-admin-master>