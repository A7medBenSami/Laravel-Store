  @extends('layouts/dashboard/dblayout')


  @section('title','Add New')
  @section('breadcrumb')
  @parent
    <li class="breadcrumb-item active">Add New</li>
  @endsection

  @section('content')

  <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data" >
@csrf
      @include('dashboard.products_form',[
    'button_label' =>'Create'
])

</form>

  @endsection
