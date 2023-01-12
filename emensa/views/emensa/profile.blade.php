@extends('emensa.layout')

@section('title')
    {{$benutzer['name']}}
@endsection

@section('main')
    <grid class="grid-main-element">

        <table>
            <tr>
                <th>Email</th>
                <th>Anzahl Anmeldungen</th>
                <th>Letzte Anmeldeung</th>
                <th>Letzte fehlende Anmeldung</th>
                <th>ist Admin</th>
            </tr>
            <tr>
                <td>{{$benutzer['email']}}</td>
                <td>{{$benutzer['anzahlanmeldungen']}}</td>
                <td>{{$benutzer['letzteanmeldung']}}</td>
                <td>{{$benutzer['letzterfehler']}}</td>
                <td>{{$benutzer['admin']}}</td>
            </tr>

        </table>

    </grid>

@endsection