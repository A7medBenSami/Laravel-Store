  @extends('layouts/dashboard/dblayout')


  @section('title','Add New')
  @section('breadcrumb')
  @parent
    <li class="breadcrumb-item active">Add New</li>
  @endsection

  @section('content')

  <form action="{{route('categories.store')}}" method="post" enctype="multipart/form-data" >
@csrf
      @include('dashboard.categories._form',[
    'button_label' =>'Create'
])

</form>

  @endsection
