﻿<?php
    $db = mysql_connect('localhost', 'web145', '*tXm&2y0C*6R');    
    mysql_select_db('usr_web145_12', $db);
    $MESSAGE = "";
    $kategorieID = -1;

    if (isset($_POST['mail']) && isset($_POST['betrag']) && isset($_POST['wunschID'])) { // Formular vollständig ausgefüllt
        $mail = $_POST['mail'];
        $betrag = $_POST['betrag'];
        $wunschID = $_POST['wunschID'];

        $res = mysql_query("select * from wunschliste where ID = $wunschID");
            
        if ($wunsch = mysql_fetch_assoc($res)) { //WunschID valide
            $kategorieID = $wunsch['kategorie'];
            $offen = $wunsch['ziel'] - $wunsch['bisher'];
            if ($betrag <= $offen) { // Betrag in Bereich?
                $neu = $betrag + $wunsch['bisher'];
                // Wunsch aktualisieren
                mysql_query("update wunschliste set bisher = $neu where ID = $wunschID");
                $wunschName = $wunsch['name'];
                // Geschenk eintragen
                mysql_query("insert into schenkende (wunsch, betrag, mail) values ($wunschID, $betrag, '$mail')");
                // Bestätigungsmail versenden
                $header = 'From: wunschliste@matthias-deborah.ch' . "\r\n" .
                    'Reply-To: mattuke@gmail.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
                mail($mail, "Vielen Dank", "Vielen Dank f\u00fcr deinen Beitrag von CHF $betrag an \"$wunschName\"!", $header);
                // Popup zur Bestätigung
                $MESSAGE = "Vielen Dank f\u00fcr deinen Beitrag von CHF $betrag an \"$wunschName\"!";
            } else {
                $MESSAGE = "Der eingegebene Betrag scheint etwas gross zu sein.";
            }            
        } else {
            $MESSAGE = "Jetzt ist anscheinend etwas schiefgelaufen. Versuchs doch noch einmal.";
        } 
    } else if (isset($_POST['Los!'])) {
        $MESSAGE = "Jetzt ist anscheinend etwas schiefgelaufen. Versuchs doch noch einmal.";
    }
      
?>