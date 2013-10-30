<?php
    $db = mysql_connect('localhost', 'web145', '*tXm&2y0C*6R');    
    mysql_select_db('usr_web145_12', $db);
    $MESSAGE = "";
    $kategorieID = -1;

    if (isset($_POST['teilnehmen'])) {
        $name = $_POST['name'];
        $adresse = $_POST['adresse'];
        $mail = $_POST['mail'];
        $mobile = $_POST['mobile'];
        $bname = isset($_POST['bname']) ? $_POST['bname'] : "";
        $salat = isset($_POST['salat']) ? $_POST['salat'] : "";
        $salat_nr = isset($_POST['salat_nr']) ? $_POST['salat_nr'] : "";
        $cupcake = isset($_POST['cupcake']) ? $_POST['cupcake'] : "";
        $cupcake_nr = isset($_POST['cupcake_nr']) ? $_POST['cupcake_nr'] : "";
        // Anmeldung eintragen
        mysql_query("insert into anmeldungen (name, adresse, mail, mobile, bname, salat, salat_nr, cupcake, cupcake_nr) values " 
                . "('$name', '$adresse', '$mail', '$mobile', '$bname', '$salat', $salat_nr, '$cupcake', $cupcake_nr)");
        // Bestätigungsmail versenden
        $header = 'From: anmeldung@matthias-deborah.ch' . "\r\n" .
            'Reply-To: mattuke@gmail.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        mail($mail, "Anmeldebestätigung", "Hallo \n\nDu hast dich soeben mit folgenden Daten für unsere Hochzeitsfeier angemeldet:\n\n" .
                "Name(n): $name, $bname \n$adresse \n$mail \n$mobile \n\nSalat: $salat für $salat_nr Personen \nCupcakes: $cupcake_nr $cupcake" .
                "\n\nWir freuen uns schon jetzt dich zu sehen.", $header);        
        // Meldung
        $MESSAGE = "Vielen Dank für deine Anmeldung. Du erhälst in Kürze ein Bestätigungsmail.";
    } else if (isset($_POST['mail']) && isset($_POST['betrag']) && isset($_POST['wunschID'])) { // Formular vollständig ausgefüllt
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