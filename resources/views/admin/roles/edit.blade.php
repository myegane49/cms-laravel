<x-admin-master>
  @section('content')
    <h1>Edit Role: {{$role->name}}</h1>

    @if (session()->has('message'))
        <div class="alert alert-info col-sm-12">{{session()->get('message')}}</div>
    @endif

    <div class="row">
      <div class="col-sm-4">
        <form action="{{route('roles.update', $role->id)}}" method="post">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" value="{{$role->name}}" name="name">
          </div>
    
          <button class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        @if ($permissions->isNotEmpty())
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Permissions</h6>
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
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Options</th>
                      <th>Id</th>
                      <th>Name</th>
                      <th>Slug</th>
                      <th>Delete</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($permissions as $permission)
                      <tr>
                        <td><input type="checkbox"
                          @foreach ($role->permissions as $role_permission)
                              @if ($role_permission->slug == $permission->slug)
                                  checked
                              @endif
                          @endforeach
                        ></td>                       
                        <td>{{$permission->id}}</td>
                        <td><a href="">{{$permission->name}}</a></td>
                        <td>{{$permission->slug}}</td>
                        <td>
                          <form action="" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Delete</button>
                          </form>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        @endif
        
      </div>
    </div>
  @endsection
</x-admin-master>