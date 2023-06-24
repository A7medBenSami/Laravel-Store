  @extends('layouts/dashboard/dblayout')


  @section('title','Products')
  @section('breadcrumb')
  @parent
    <li class="breadcrumb-item active">Products</li>
  @endsection

  @section('content')
  <div>
    <a href="{{route('products.create')}}" class="btn btn-sm btn-outline-success">Add New</a>
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
      <th scope="col">Category</th>
      <th scope="col">Store</th>
      <th scope="col">Created At</th>
      <th colspan="2"></th>
    </tr>
  </thead>
  <tbody>
    @forelse($products as $product)
    <tr>
        @if($product ->image )
            <td><img src="{{ asset($product->image_url) }}" height="50" width="70"></td>
        @else
            <td><img src="{{ asset('storage/upload/a.jpg') }}" height="50" width="70"></td>

        @endif
      <td >{{$product->id}}</td>
      <td>{{$product->name}}</td>
      <td>{{$product->category->name}}</td>
      <td>{{$product->store->name}}</td>
      <td>{{$product->created_at}}</td>


     <td><a href="{{route('products.edit',$product->id)}}" class="btn btn-sm btn-outline-success">Edit</a></td>
     <td>
        <form action="{{route('products.destroy',$product->id)}}" method="post">
            @csrf
            <input type="hidden" name="_method" value="delete">
            @method('delete')
            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>

        </form>

     </td>
     @empty
     <td colspan="7">No Products</td>
@endforelse
    </tr>



  </tbody>
</table>
{{$products ->withQueryString()-> links()}}
  @endsection
