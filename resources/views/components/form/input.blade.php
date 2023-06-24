<input type="{{$type}}" name="{{$name}}" @class([
    'form-control',
    'is-invalid'=>@error->has('$name')
])
value="{{old('name',$value)}}">
@error('name')
<div class="invalid-feedback">
    {{$message}}

</div>
@enderror
