@foreach($countries as $country)
    <option value="{{ $country->geoname }}">{{ $country->name }}</option>
@endforeach
