
<div class="form-group">
    <label for="exampleInputEmail1">Category Name</label>
    <input type="text" class="form-control"  placeholder="Category Name" name = "name" value="{{$category->name}}">
</div>

<div class="form-group">
    <label for="exampleInputEmail1">Parent</label>
    <select type="text" class="form-control"  placeholder="Parent" name = "parent_id" >
        <option value="" >Primary Category</option>
        @foreach($parents as $parent)
            <option value="{{$parent->id}}" @selected($category->parent_id == $parent->id) >{{$parent->name}}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Category Description</label>
    <textarea class="form-control"  placeholder="Category Description" name = "description"  >{{$category->description}}</textarea>
</div>


<div class="form-group">
    <label for="exampleInputEmail1">Image</label>
    <input type="file" class="form-control"  name = "image">
</div>
@if($category ->image )
    <td><img src="{{ asset('storage/' . $category->image) }}" height="50" width="70"></td>
@else
    <td><img src="{{ asset('storage/upload/a.jpg') }}" height="50" width="70"></td>

@endif

<div class="form-check">
    <input class="form-check-input" type="radio" name="status" value="active" @checked($category->status == 'active') >
    <label class="form-check-label" >
        Active
    </label>
</div>

<div class="form-check">
    <input  class="form-check-input" type="radio" name="status" value="archived" @checked($category->status == 'archived') >
    <label class="form-check-label" >
        Archived
    </label>

</div>
<button type="submit"  class="btn btn-primary">{{$button_label}}</button>
