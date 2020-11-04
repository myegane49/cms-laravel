<x-admin-master>
  @section('content')
    <h1>Edit Permission: {{$permission->name}}</h1>

    @if (session()->has('message'))
        <div class="alert alert-info col-sm-12">{{session()->get('message')}}</div>
    @endif

    <div class="row">
      <div class="col-sm-4">
        <form action="{{route('permissions.update', $permission->id)}}" method="post">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" value="{{$permission->name}}" name="name">
          </div>
    
          <button class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>

  @endsection
</x-admin-master>