<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/authentification.php');

class AuthenticationController
{
    function anmeldung() {
        if($_SESSION['login_ok']) {
            header('Location: /home');
        }
        $msg = $_SESSION['login_result_message'] ?? null;
        return view('emensa.anmeldung_werbeseite', ['msg' => $msg]);
    }
    function abmelden() {
        session_unset();
        header('Location: /home');
    }

    function verifizierung(RequestData $rd) {
        $email = $rd->query['email'] ?? false;
        $password = $rd->query['password'] ?? false;
        // Überprüfung Eingabedaten

        $data = auth($password,$email);
        $_SESSION['login_result_message'] = "";
        if ( $data != null) {
            $_SESSION['login_ok'] = true;
            $_SESSION['cookie'] = $data['id'];
            header('Location: /home');
        } else {
            $_SESSION['login_result_message'] =
                'Name oder Passwort falsch';
            header('Location: /anmeldung');
        }
    }


}