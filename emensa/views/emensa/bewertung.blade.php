@extends('emensa.layout')

@section('title')
    Bewertung
@endsection

@section('main')
    <grid class="grid-main-element">
        <form method="post" action="/verifizierung">
            <label>Sternebewertung</label>
            <select name="Sternebewertung" id="Sternebewertung">
                <option value="sehr_gut">Sehr gut</option>
                <option value="gut">gut</option>
                <option value="schlecht">Schlecht</option>
                <option value="sehr_schlecht">Sehr schlecht</option>
            </select><br>
            <label>Bemerkung</label>
            <input type="password" name="password"><br>
            <input type="submit" value="Abschicken" name="submit">
        </form>
        <strong style="color: red">{{$_SESSION['login_result_message']}}</strong>

    </grid>

@endsection