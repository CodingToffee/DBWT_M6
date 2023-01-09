@extends("layout")

@section("content")
    Der Wert von ?name lautet: {{$request->query["name"]}}
@endsection