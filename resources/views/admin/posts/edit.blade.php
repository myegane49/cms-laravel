<x-admin-master>
  @section('content')
      <h1>Edit the Post</h1>

      <form action="{{route('post.update', $post->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
          <label>Title</label>
          <input type="text" class="form-control" name="title" placeholder="Enter Title" value="{{$post->title}}">
        </div>
        <div class="form-group">
          <div><img height="100px" src="{{$post->post_image}}" alt="post image"></div>
          <label>File</label>
          <input type="file" class="form-control-file" name="post_image">
        </div>
        <div class="form-group">
          <textarea name="body" cols="30" rows="10" class="form-control">{{$post->body}}</textarea>
        </div>
        <button class="btn btn-primary">Submit</button>
      </form>
  @endsection
</x-admin-master>