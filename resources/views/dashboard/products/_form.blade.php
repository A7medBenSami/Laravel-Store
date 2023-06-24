
<div class="form-group">
    <label for="exampleInputEmail1">Product Name</label>
    <input type="text" class="form-control"  placeholder="product Name" name = "name" value="{{$product->name}}">
</div>

<div class="form-group">
    <label for="exampleInputEmail1">Category</label>
    <select type="text" class="form-control"  placeholder="Parent" name = "parent_id" >
        <option value="" >Primary product</option>
        @foreach($parents as $parent)
            <option value="{{$parent->id}}" @selected($product->parent_id == $parent->id) >{{$parent->name}}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">product Description</label>
    <textarea class="form-control"  placeholder="product Description" name = "description"  >{{$product->description}}</textarea>
</div>


<div class="form-group">
    <label for="exampleInputEmail1">Image</label>
    <input type="file" class="form-control"  name = "image">
</div>
@if($product ->image )
    <td><img src="{{ asset('storage/' . $product->image) }}" height="50" width="70"></td>
@else
    <td><img src="{{ asset('storage/upload/a.jpg') }}" height="50" width="70"></td>

@endif

<div class="form-check">
    <input class="form-check-input" type="radio" name="status" value="active" @checked($product->status == 'active') >
    <label class="form-check-label" >
        Active
    </label>
</div>

<div class="form-check">
    <input  class="form-check-input" type="radio" name="status" value="archived" @checked($product->status == 'archived') >
    <label class="form-check-label" >
        Archived
    </label>

</div>
<button type="submit"  class="btn btn-primary">{{$button_label}}</button>
