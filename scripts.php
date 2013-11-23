<?php
$db = mysql_connect('localhost', 'web145', '*tXm&2y0C*6R');
mysql_select_db('usr_web145_12', $db);
mysql_set_charset('utf8', $db);
$MESSAGE = "";
$kategorieID = -1;

if (isset($_POST['teilnehmen'])) {
    $name = $_POST['name'];
    $adresse = $_POST['adresse'];
    $ort = $_POST['ort'];
    $mail = $_POST['mail'];
    $mobile = $_POST['mobile'];
    $bname = isset($_POST['bname']) ? $_POST['bname'] : "";
    $salat = isset($_POST['salat']) ? $_POST['salat'] : "";
    $salat_nr = $_POST['salat_nr'] != "" ? $_POST['salat_nr'] : 0;
    $cupcake = isset($_POST['cupcake']) ? $_POST['cupcake'] : "";
    $cupcake_nr = $_POST['cupcake_nr'] != "" ? $_POST['cupcake_nr'] : 0;
    // Anmeldung eintragen
    mysql_query("insert into anmeldungen (name, adresse, mail, mobile, bname, salat, salat_nr, cupcake, cupcake_nr) values "
            . "('$name', '" . $adresse . ", " . $ort . "', '$mail', '$mobile', '$bname', '$salat', $salat_nr, '$cupcake', $cupcake_nr)");
    // Bestätigungsmail versenden
    $header = 'From: anmeldung@matthias-deborah.ch' . "\r\n" .
            'Reply-To: mattuke@gmail.com' . "\r\n" .
            'Bcc: mattuke@gmail.com,deborah.kueffer@bluewin.ch' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
    $beitrag = "";
    if ($salat_nr > 0 || $cupcake_nr > 0) {
        $beitrag = "Danke vielmals für deinen Beitrag:\n";
        if ($salat_nr > 0) {
            $beitrag .= "$salat für $salat_nr Personen";
        }
        if ($cupcake_nr > 0) {
            $beitrag .= "$cupcake_nr $cupcake";
        }
        $beitrag .= "\n\n";
    }
    $satz = "Wir freuen uns dass, du dabei bist.";
    if ($bname != "") {
        $satz = "Wir freund uns, dass du und $bname dabei seid.";
    }
    mail($mail, "Anmeldebestätigung", "Hallo $name \n\nYeah - $satz\n\n" . $beitrag . "Herzliche Grüsse\nDas Brautpaar\nMatthias & Deborah", $header);
    // Meldung
    $MESSAGE = "Vielen Dank für deine Anmeldung. Du erhälst in Kürze ein Bestätigungsmail.";
} else if (isset($_POST['wunschID'])) { // Formular vollständig ausgefüllt
    $mail = $_POST['mail'];
    $betrag = $_POST['betrag'];
    $name = $_POST['name'];
    $wunschID = $_POST['wunschID'];

    $res = mysql_query("select * from wunschliste where ID = $wunschID");

    if ($wunsch = mysql_fetch_assoc($res)) { //WunschID valide
        $kategorieID = $wunsch['kategorie'];

        if (!empty($mail) && !empty($betrag) && !empty($name)) {
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
                        'Bcc: mattuke@gmail.com,deborah.kueffer@bluewin.ch' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
                $beitrag = "";
                if ($wunsch['ziel'] > 1) {
                    $beitrag = " deinen Beitrag von $betrag.- an";
                }
                mail($mail, "Vielen Dank", "Hallo $name\n\nWir danken dir herzlich für" . $beitrag . " $wunschName.\n\n" .
                        "Überweisung an:\nPC 92-483818-4\nIBAN CH39 0900 0000 9248 3818 4\nMatthias Keller\nAchenbergstrasse 6\n5000 Aarau\n\nHerzliche Grüsse\nDas Brautpaar\nMatthias & Deborah", $header);
                // Popup zur Bestätigung
                $MESSAGE = "Vielen Dank f\u00fcr deinen Geschenk!";
            } else {
                $MESSAGE = "Der eingegebene Betrag scheint etwas gross zu sein.";
            }
        } else {
            $MESSAGE = "Hast du alle Felder ausgefüllt?";
        }
    } else {
        $MESSAGE = "Jetzt ist anscheinend etwas schiefgelaufen. Versuchs doch noch einmal.";
    }
} else if (isset($_POST['Los!'])) {
    $MESSAGE = "Jetzt ist anscheinend etwas schiefgelaufen. Versuchs doch noch einmal.";
}
?>