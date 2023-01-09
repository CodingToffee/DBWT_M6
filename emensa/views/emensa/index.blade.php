
@extends("emensa.layout")

@section("title", "Hauptseite")

@section('main')
    <div class="grid-main-element">
        <img src="img/alte-mensa-bratquadrat_0.jpg" alt="Mense Blau">
    </div>

    <div class="grid-main-element" id="info">
        <div  class="border">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores doloremque, hic neque qui rem tempora ullam! A, cupiditate delectus eligendi enim et, expedita illo itaque magni nihil non quisquam totam.</p>

        </div>

    </div>
    <div class="grid-main-element" id="speisen">

        <h1>Köstlichkeiten, die Sie erwarten</h1>
        <table class="border">
            <tr>
                <th>Name</th>
                <th>Preis intern</th>
                <th>Preis extern</th>
            </tr>
            @forelse($gerichte as $gericht)
                <tr>
                    <td>{{$gericht['name']}}
                        @if($gericht['code'] != "")
                            <span style="color: #D8000C">({{$gericht['code']}})</span>
                        @endif

                    </td>
                    <td>{{$gericht['preis_intern']}}</td>
                    <td>{{$gericht['preis_extern']}}</td>
                </tr>
            @empty
                keine gerichte in der Datenbank
            @endforelse
        </table>

        <ul>
            @forelse($allerge_codes as $allerge_code)
                <ul>{{$allerge_code['name']}}, {{$allerge_code['code']}}</ul>
            @empty
            @endforelse
        </ul>
    </div>

    <div class="grid-main-element" id="zahlen">
        <h1>E-Mensa in Zahlen</h1>
        <h3> {{$zahlen_besucher[0]}} Besuche</h3>

        <h3> {{$zahlen_anmeldungen[0]}} Anmeldungen zum Newsletter</h3>
        <h3> {{$zahlen_gerichte[0]}} Speisen</h3>
    </div>
    <div class="grid-main-element" id="kontakt">
        <h1>Intersse geweckt? Wir informieren Sie!</h1>
        <a href="/wunschgericht">Dein Wunschgericht bei uns melden</a>
        <br>
        <form method="post" action="/newsletter" id="kontakt_form">

            <label >Ihr Name:</label>
            <input type="text" placeholder="Vorname" name="Name" value="{{$rd->query["Name"]}}">
            <label>Ihr Email:</label>
            <input type="text" name="Email" value="{{$rd->query["Email"]}}">
            <label>Newsletter bitte in:</label>
            <select name="lan" >
                <option value="D" <?php if($rd->query["lan"] == "D")echo "selected";?>>
                    Deutsch
                </option>
                <option value="E" <?php if($rd->query["lan"] == "E")echo "selected";?>>Englisch</option>
            </select>
            <br>

            <input class="check" type="checkbox" name="ds" <?php if($rd->query["ds"] == "on")echo "checked";?> >
            Den Datenschutzbestimmungen stimme ich zu

            <input id="submit" type="submit" name="submit" value="Zum Newsletter anmleden">


        </form>
        @if(isset($erfolgreich) && $erfolgreich == false)
            <p class='error'> Errors :</p>
            <ul>
                @foreach($msgs as $msg)
                    <li class="error">{{$msg}}</li>
                @endforeach
            </ul>

        @elseif(isset($erfolgreich) && $erfolgreich == true)
            <p style='color: green'> {{$rd->query["Name"]}}, Deine Daten wurden erfolgeich gespeichert!</p>
        @endif
    </div>
    <div class="grid-main-element" id="wichtig">
        <h1>Das ist uns wichtig</h1>
        <ul>
            <li>Beste frische Saisonale Zutaten</li>
            <li>Ausgewagene abweckslungsreiche Gerichte</li>
            <li>Sauberkeit</li>
            <li>Freundlichkeit gegenüber den Mitarbeitern</li>
        </ul>
        <br>
        <br>
    </div>
@endsection


@section("footer")
    @if(isset($erfolgreich))
    <script>
        const element = document.getElementById("wichtig");
        element.scrollIntoView({behavior: "smooth"});
    </script>
    @endif
    <ul>
        <li>(c) E-Mensa GmbH</li>
        <li>Majd Bousaad & Nicolas Harrje</li>
        <li style="color: #6bd3ec">Impressum</li>
    </ul>
@endsection




