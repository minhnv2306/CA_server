@foreach($wards as $ward)
    <option value="{{$ward->maqh}}">{{ $ward->name }}</option>
@endforeach