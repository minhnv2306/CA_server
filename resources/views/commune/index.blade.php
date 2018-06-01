@foreach($communes as $commune)
    <option value="{{$commune->xaid}}">{{ $commune->name }}</option>
@endforeach