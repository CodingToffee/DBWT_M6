@extends('emensa.layout')

@section('title')
    Bewertung
@endsection

@section('main')
    <grid class="grid-main-element">
        <form method="post" action="/bewertung_verarbeitung">
            <label>Sternebewertung</label>
            <select name="sternebewertung" id="sternebewertung">
                <option value="sehr gut">Sehr gut</option>
                <option value="gut">gut</option>
                <option value="schlecht">Schlecht</option>
                <option value="sehr schlecht">Sehr schlecht</option>
            </select><br>
            <label>Bemerkung</label>
            <textarea id="bemerkung" name="bemerkung" rows="4" cols="50"></textarea><br>
            <input type="submit" value="Abschicken" name="submit">
        </form>
        <strong style="color: red">{{$_SESSION['error_message']}}</strong>

    </grid>

@endsection