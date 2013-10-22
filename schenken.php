<?php
    $db = mysql_connect('localhost', 'web145', '*tXm&2y0C*6R');    
    mysql_select_db('usr_web145_12', $db);

    if (isset($_POST['mail']) && isset($_POST['betrag']) && isset($_POST['wunschID'])) {
        $mail = $_POST['mail'];
        $betrag = $_POST['betrag'];
        $wunschID = $_POST['wunschID'];

        $res = mysql_query("select * from wunschliste where ID = $wunschID");
        if ($wunsch = mysql_fetch_assoc($res)) {
            $offen = $wunsch['ziel'] - $wunsch['bisher'];
            $betrag = $betrag > $offen ? $offen : $betrag;
            $neu = $betrag + $wunsch['bisher'];
            mysql_query("update wunschliste set bisher = $neu where ID = $wunschID");
            $wunschName = $wunsch['name'];
            echo <<<EOD
            Vielen Dank für deinen Beitrag von CHF $betrag an "$wunschName"!
EOD;
        } else {
            header('Location: error.html');
        } 
    } else {
        header('Location: error.html');
    }
      
?>