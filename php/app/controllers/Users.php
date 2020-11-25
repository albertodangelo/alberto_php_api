<?php

class Users extends Controller {

    public function __construct () {
        $this->userModel = $this->model('User');
    }

    public function register() {

        // Prüft ob das Formular verschickt wurde oder ob die Seite 
        // normal aufgerufen wurde
        if($_SERVER['REQUEST_METHOD'] == 'POST' ) {
            
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

          
            // Das Formular wird validiert
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
            ];

            
            // Validiert den Namen
            if( empty($data['name'])) {
                $data['name_err'] = "Das Feld Name darf nicht leer sein.";
            }
            // Validiert das Email
            if( empty($data['email'])) {
                $data['email_err'] = "Das Feld Email darf nicht leer sein.";
            } else {

                if($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = "Benutzer ist bereits registriert.";
                } 
            }
            // Validiert das Password
            if( empty($data['password'])) {
                $data['password_err'] = "Das Feld Passwort darf nicht leer sein.";
            } elseif(strlen([$data['password']] < 6)) {
                $data['password_err'] = "Das Passwort muss mindestens 6 Zeichen beinhalten.";
            }
            // Validiert das Password
            if( empty($data['confirm_password'])) {
                $data['confirm_password_err'] = "Das Feld Passwort bestätigen darf nicht leer sein.";
            } elseif( $data['password'] !== $data['confirm_password']) {
                
                $data['confirm_password_err'] = "Die Passwörter stimmen nicht überein";
            }
            
            // Wenn keine Fehler mehr vorhanden sind, wird
            // der User gespeichert
            if( empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) ) {
                
                // die("Keine Fehler");

                // zuerst wird das Passwort gehashed
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                if($this->userModel->register($data)) {
                    flash('register_success', 'Du wurdest registriert und kannst dich nun anmelden.');
                    redirect('users/login');
                    
                } else {
                    die("etwas ist schief gegangen");
                }

            } 

            $this->view('users/register', $data);

        } else {

            // Die initialen Wert für das Anmeldeformular
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            $this->view('users/register', $data);
        }

    }
    
    public function login() {

        // Prüft ob das Formular verschickt wurde oder ob die Seite 
        // normal aufgerufen wurde
        if($_SERVER['REQUEST_METHOD'] == 'POST' ) {
            // Das Formular wird verarbeitet
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Das Formular wird validiert
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => '',
            ];
             // Validiert den Namen
             if( empty($data['email'])) {
                $data['email_err'] = "Das Feld E-Mail darf nicht leer sein.";
            }
             if( empty($data['password'])) {
                $data['password_err'] = "Das Feld Passwort darf nicht leer sein.";
            }

            // Prüfen, ob es den User überhaupt gibt 
            if( $this->userModel->findUserByEmail($data['email'])) {
                // User gefunden
            } else {
                // Load view with error
               $data['email_err'] = "Der Benutzer wurde nicht gefunden.";
            }

            // Prüfen, dass keine Fehler angezeigt werden
            if(  empty($data['email_err']) && empty($data['password_err']) ) {
                
                //die("Keine Fehler");
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if($loggedInUser) {
                    // Session wird geprüft
                    // die("SUCCESS");
                    $this->createUserSession($loggedInUser);
                } else {

                    $data['password_err'] = "Das Passwort is falsch.";
                    // Der View mit den FEHLERN wird aktualisiert
                    $this->view('users/login', $data);
                }
            
            } else {

                // Den View mit den FEHLERN wird aktualisiert
                $this->view('users/login', $data);

            };

        } else {

            // Die initialen Wert für das Anmeldeformular
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => '',
            ];

            $this->view('users/login', $data);
        }

    }

    public function createUserSession($loggedInUser) {

        
        $_SESSION['user_id'] = $loggedInUser->id;
        $_SESSION['user_email'] = $loggedInUser->email;
        $_SESSION['user_name'] = $loggedInUser->name;
        redirect('posts/index');
    }

    public function logout() {

        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();
        redirect('users/login');
    }

    

}