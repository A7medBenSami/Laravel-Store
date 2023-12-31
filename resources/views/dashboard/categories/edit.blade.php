  @extends('layouts/dashboard/dblayout')


  @section('title','Edit Category')
  @section('breadcrumb')
  @parent
    <li class="breadcrumb-item active">Edit</li>
  @endsection

  @section('content')

  <form action="{{route('categories.update',$category->id)}}" method="post" enctype="multipart/form-data">
      @csrf
      @method('put')
      @include('dashboard.categories._form',[
      'button_label' =>'Update'
    ])

  </form>

  @endsection
