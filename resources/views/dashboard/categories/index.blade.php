  @extends('layouts/dashboard/dblayout')


  @section('title','Categories')
  @section('breadcrumb')
  @parent
    <li class="breadcrumb-item active">Categories</li>
  @endsection

  @section('content')
  <div>
    <a href="{{route('categories.create')}}" class="btn btn-sm btn-outline-success">Add New</a>
  </div>
  <br>
  @if('session'()->has('success'))
      <div class="alert alert-primary" role="alert">
          {{session('success')}}
      </div>
  @endif
  <table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">Image</th>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Parent</th>
      <th scope="col">Created At</th>
      <th colspan="2"></th>
    </tr>
  </thead>
  <tbody>
    @forelse($categories as $category)
    <tr>
        @if($category ->image )
            <td><img src="{{ asset($category->image_url) }}" height="50" width="70"></td>
        @else
            <td><img src="{{ asset('storage/upload/a.jpg') }}" height="50" width="70"></td>

        @endif
      <td >{{$category->id}}</td>
      <td>{{$category->name}}</td>
      <td>{{$category->parent_name}}</td>
      <td>{{$category->created_at}}</td>


     <td><a href="{{route('categories.edit',$category->id)}}" class="btn btn-sm btn-outline-success">Edit</a></td>
     <td>
        <form action="{{route('categories.destroy',$category->id)}}" method="post">
            @csrf
            <input type="hidden" name="_method" value="delete">
            @method('delete')
            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>

        </form>

     </td>
     @empty
     <td colspan="7">No Categories</td>
@endforelse
    </tr>



  </tbody>
</table>
{{$categories ->withQueryString()-> links()}}
  @endsection
