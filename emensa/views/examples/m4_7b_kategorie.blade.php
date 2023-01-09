@extends("layout")

@section("content")
    @php
        $i=1;
        $font_weight = 'normal';
    @endphp
    <ul>
    @forelse($data as $kategorie)

        @php
            $i++;
            if($i %2 == 1){
                $font_weight = 'bold';
            } else{
                $font_weight = "normal";
            }
        @endphp
            <li style="font-weight: {{$font_weight}}">{{$kategorie['name']}}</li>
        @empty
        <li>Keine Daten vorhanden.</li>
    @endforelse
    </ul>
@endsection