<x-admin-master>
  @section('content')
      <h1>Create</h1>

      <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label>Title</label>
          <input type="text" class="form-control" name="title" placeholder="Enter Title">
        </div>
        <div class="form-group">
          <label>File</label>
          <input type="file" class="form-control-file" name="post_image">
        </div>
        <div class="form-group">
          <textarea name="body" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <button class="btn btn-primary">Submit</button>
      </form>
  @endsection
</x-admin-master>