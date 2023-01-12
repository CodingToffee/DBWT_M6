<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gericht.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/zahlen.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/newsletter.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/authentification.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/bewertung.php');

/* Datei: controllers/HomeController.php */
class HomeController
{
    public function index(RequestData $request) {
        return view('home', ['rd' => $request ]);
    }
    
    public function debug(RequestData $request) {
        return view('debug');
    }

    public function emensa(RequestData  $rd){
        update_besucher();
        $gerichte = zufaellige_gerichte();
        $allerge_codes = codes_from_zufaellige_gerichte($gerichte);

        $zahlen_gerichte = db_zahlen_gerichte();
        $zahlen_anmeldungen = db_zahlen_anmeldungen();
        $zahlen_besucher = db_zahlen_besucher();


        return view('emensa.index', [
            'rd' => $rd,
            'gerichte' => $gerichte,
            'allerge_codes' => $allerge_codes,
            'zahlen_gerichte' => $zahlen_gerichte,
            'zahlen_anmeldungen' => $zahlen_anmeldungen,
            'zahlen_besucher' => $zahlen_besucher
        ]);
    }
    public function newsletter(RequestData $rd){

        $msgs = anmelden($rd);
        $erfolgreich = false;
        if(count($msgs) == 0){
            $erfolgreich =true;
        }

        $gerichte = zufaellige_gerichte();
        $allerge_codes = codes_from_zufaellige_gerichte($gerichte);

        $zahlen_gerichte = db_zahlen_gerichte();
        $zahlen_anmeldungen = db_zahlen_anmeldungen();
        $zahlen_besucher = db_zahlen_besucher();


        return view('emensa.index', [
            'rd' => $rd,
            'erfolgreich' => $erfolgreich,
            'msgs' => $msgs,
            'gerichte' => $gerichte,
            'allerge_codes' => $allerge_codes,
            'zahlen_gerichte' => $zahlen_gerichte,
            'zahlen_anmeldungen' => $zahlen_anmeldungen,
            'zahlen_besucher' => $zahlen_besucher
        ]);
    }

    function home(RequestData $rd) {
        if (!isset($_SESSION['login_ok']) || !$_SESSION['login_ok']) {
            $_SESSION['target'] = '/home';
            header('Location: /anmeldung');
            return;
        }
        else {
            $gerichte = zufaellige_gerichte();
            $allerge_codes = codes_from_zufaellige_gerichte($gerichte);

            $zahlen_gerichte = db_zahlen_gerichte();
            $zahlen_anmeldungen = db_zahlen_anmeldungen();
            $zahlen_besucher = db_zahlen_besucher();


            return view('emensa.index', [
                'rd' => $rd,
                'gerichte' => $gerichte,
                'allerge_codes' => $allerge_codes,
                'zahlen_gerichte' => $zahlen_gerichte,
                'zahlen_anmeldungen' => $zahlen_anmeldungen,
                'zahlen_besucher' => $zahlen_besucher
            ]);
        }
        /*

        */
    }

    function anmeldung() {
        $msg = $_SESSION['login_result_message'] ?? null;
        return view('emensa.anmeldung_werbeseite', ['msg' => $msg]);
    }

    function verifizierung(RequestData $rd) {
        $email = $rd->query['email'] ?? false;
        $password = $rd->query['password'] ?? false;
        // Überprüfung Eingabedaten

        $data = auth($password,$email);
        $_SESSION['login_result_message'] = "";
        if ( $data != null) {
            $_SESSION['login_ok'] = true;
            $_SESSION['cookie'] = $data["name"];
            $_SESSION['benutzer_id'] = $data['id'];
            $target = $_SESSION['target'];
            header('Location: ' . $target);
        } else {
            $_SESSION['login_result_message'] =
                'Name oder Passwort falsch';
            header('Location: /anmeldung');
        }
    }

    function bewertung() {
        if (!isset($_SESSION['login_ok']) || !$_SESSION['login_ok']) {
            $_SESSION['target'] = '/bewertung';
            header('Location: /anmeldung');
            return;
        }
        else {
            $id = $_GET['gerichtid'];
            $_SESSION['gerichtid'] = $id;
            $data = gericht_bewertung($id);
            $bewertungen = letzte_30();
            return view('emensa.bewertung',[
                'gerichtid' => $id,
                'name' => $data['name'],
                'bildname' => $data['bildname'],
                'bewertungen' => $bewertungen
            ]);
        }
    }

    function bewertung_verarbeitung(RequestData $rd) {
        $bemerkung = $rd->query['bemerkung'];
        $sternebewertung = $rd->query['sternebewertung'];
        echo $_SESSION['benutzer_id'];
        if (strlen($bemerkung) < 5) {
            $_SESSION['error_message'] =
                'Die Bemerkung muss mindestens 5 Zeichen lang sein.';
            header('Location: /bewertung');
        }
        else {
            safe_bewertung($sternebewertung,$bemerkung,$_SESSION['benutzer_id'],$_SESSION['gerichtid']);
            $gerichte = zufaellige_gerichte();
            $allerge_codes = codes_from_zufaellige_gerichte($gerichte);

            $zahlen_gerichte = db_zahlen_gerichte();
            $zahlen_anmeldungen = db_zahlen_anmeldungen();
            $zahlen_besucher = db_zahlen_besucher();


            return view('emensa.index', [
                'rd' => $rd,
                'gerichte' => $gerichte,
                'allerge_codes' => $allerge_codes,
                'zahlen_gerichte' => $zahlen_gerichte,
                'zahlen_anmeldungen' => $zahlen_anmeldungen,
                'zahlen_besucher' => $zahlen_besucher
            ]);
        }
    }

    function meinebewertungen() {
        $benutzer_id = $_SESSION['benutzer_id'];
        echo $benutzer_id;
        $data = bewertungen_benutzer($benutzer_id);
        return view('emensa.meinebewertungen',[
            'bewertungen' => $data
        ]);
    }


}