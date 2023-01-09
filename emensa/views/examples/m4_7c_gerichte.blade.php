@extends("layout")

@section("content")

    <ul>
    @forelse($data as $gericht)
        <li>{{$gericht['name']}}, {{$gericht['preis_intern']}}</li>
    @empty
        <li>Es sind keine Gerichte vorhanden</li>
    @endforelse
    </ul>
@endsection