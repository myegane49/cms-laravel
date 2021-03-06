<x-admin-master>
  @section('content')
    @if (Session::has('message'))
      <div class="alert alert-info">{{Session::get('message')}}</div>
    @endif

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Posts</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Owner</th>
                <th>Image</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Owner</th>
                <th>Image</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Delete</th>
              </tr>
            </tfoot>
            <tbody>
              @foreach ($posts as $post)
                <tr>
                  <td>{{$post->id}}</td>
                  <td>{{$post->user->name}}</td>
                  <td><a href="{{route('post.edit', $post->id)}}">{{$post->title}}</a></td>
                  <td><img src="{{$post->post_image}}" alt="post image" height="40px"></td>
                  <td>{{$post->created_at->diffForHumans()}}</td>
                  <td>{{$post->updated_at->diffForHumans()}}</td>
                  <td>
                    @can('view', $post)
                      <form action="{{route('post.destroy', $post->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                      </form>
                    @endcan
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    {{$posts->links()}}
  @endsection

  @section('scripts')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    {{-- <script src="{{ asset('js/demo/datatables-demo.js') }}"></script> --}}
  @endsection
</x-admin-master>