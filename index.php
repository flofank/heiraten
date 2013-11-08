<!DOCTYPE html>
<?php
    include('scripts.php');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="js/jquery.js"></script>
        <script src="js/jquery.mousewheel.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css" />
        <script>
            var wunschliste = false;
            
            function givemethemail() {
                var a = "sharon";
                var b = ".hunziger";
                var d = "gmx.ch";
                var y = "@";
                var x = "mailto";
                location.href= x + ":" + a + b + y + d;
            }
            
            function showSchenken(sender, id) {
                $(sender).fadeOut();
                $("#schenken" + id).slideDown();
            }

            function showCategory(cat) {
                $("#wunschlisteContainer").show();
                $(".kategoriebody").hide();
                $("#" + cat).show();
                $(".kategorielink.selected").removeClass("selected");
                $("#" + cat + "link").addClass("selected");
                wunschliste = true;
            }
            
            function selectNavLinks() {
                $("a").each(function(index, el) {$(el).removeClass("selected")});
                $("section.text").each(function(index, element) {
                    if ($(element).offset().left > 0 && $(element).offset().left < $("#scrollBox").width() - 200) {                            
                        $("a[href=#" + $(element).children("a").prop("id") + "]").addClass("selected");
                    }
                });
            }
            
            function hideWunschliste() {
                $("#wunschlisteContainer").hide();
                wunschliste = false;
            }
            
            $(function() {      
                selectNavLinks();          
                
                <?php
                    if ($kategorieID >= 0) {
                        echo "showCategory('kategorie" . $kategorieID . "');";
                    }                
                ?>
                
                $('nav a').click(function(event) {
                    $("#scrollBox").stop().animate(
                        {
                            scrollLeft: $($(this).attr('href')).parent(
                                'section').offset().left
                                + $('#scrollBox').scrollLeft()
                                - $('#scrollBox').offset().left
                                - $("html").width() / 2  + $("section").first().width() / 2 
                        }, 2000);
                    event.preventDefault();
                    console.log();
                });
                
                $("body").mousewheel(function(event, delta) {
                    if (!wunschliste) {
                        $("#scrollBox").scrollLeft($("#scrollBox").scrollLeft() - delta * 50);
                        event.preventDefault();                        
                    }
                });
                
                $("#scrollBox").scroll(function() {
                    selectNavLinks();
                });
                
                var message = '<?php echo $MESSAGE;?>';
                if (message != '') {
                    alert(message);
                }
            });
        </script>
    </head>
    <body>
        <header> </header>
        <nav>
            <a href="#willkommen">Willkommen</a>
            <a href="#dertag">Der Tag</a> 
            <a href="#dabeisein">Dabei sein</a> 
            <a href="#diehelden">Die Helden</a> 
            <a href="#daspaar">Das Paar</a> 
            <a href="#geschenke">Die Nachfrage</a>
        </nav>
        <div id="scrollBoxContainer">
            <div id="scrollBox">
                <div id="content">
                    <section class="img">
                        <img src="img/8.jpg">
                    </section>
                    <section class="text high">
                        <a id="willkommen"></a><h1>Willkommen</h1>
                        Herzlich Willkommen auf der Homepage rund um unsere Hochzeit. Wir freuen uns, dass du hier bist. Wir wünschen dir viel Spass beim Entdecken.<br/><br/>
                        Melde dich an, sei dabei am 24. Mai 2014.
                    </section>
                    <section class="img">
                        <img src="img/3.jpg">
                    </section>
                    <section class="text">
                        <a id="dertag"></a><h1>Alles zur Hochzeit</h1>
                        Wir freuen uns riesig darauf, zusammen mit euch unsere Hochzeit zu feiern. Hier eine grobe Übersicht zu unserem grossen Tag:<br/><br/>
                        <b>Samstag 24. Mai 2014</b><br/>
                        13:00 Trauung auf dem <a class="link" href="https://www.google.ch/maps/preview#!q=Auf+Kirchberg+1+K%C3%BCttigen" target="_blank">Kirchberg Küttigen</a> mit anschliessendem Apéro<br/>
                        17:00 Uhr Start der gemeinsamen Festaktivitäten Outdoor<br/>
                        Anschliessend Festessen und Feiern im Gemeindesaal Buchs<br/>
                        <br/>
                        Wir freuen uns über jedes Kind, das an der Trauung dabei ist, aber das Fest am Abend findet ohne Kinder statt.
                        <br/><br/>
                        Weitere Details werden im Verlauf des Tages bekannt gegeben. &#9786; Lass dich überraschen!
                    </section>
                    <section class="img high">
                        <img src="img/4.jpg">
                    </section>
                    <section class="text nobg">
                        <a id="dabeisein"></a><h1>Dabei sein</h1>
                        Wir möchten gerne unsere Freude mit dir teilen. Geniesse diesen Tag mit uns! Wir laden dich herzlich ein dabei zu sein.<br/><br/>
                        Du bist für den ganzen Tag eingeladen, aber DU entscheidest selbst, wie lange du dabei sein möchtest. Wenn du gerne nur zur Trauung und zum Apero kommst, kannst du das spontan und ohne Anmeldung tun. Noch mehr freuen wir uns, wenn du auch den Abend mit uns verbringst. Dafür bitten wir dich über das Formular nebenan anzumelden.<br/><br/> 
                        Dein Beitrag zum Salat- oder Cupcakes/Muffins-Buffet ist willkommen aber völlig freiwillig. Wir freuen uns auf kreative Dekorationen des Desserts und eine Vielfalt an Salaten.<br/><br/>
                        Dein Beitrag zum Programm kannst du bei Sharon Hunziker anmelden.
                    </section>
                    <section class="text high">
                        <h1>Anmeldung</h1>
                        <form action="index.php" method="post">
                            Ich bin am Abend dabei. </br>
                            <input type="text" name="name" style="width: 275px" required placeholder="Vorname, Name"/>
                            <input type="text" name="adresse" style="width: 275px" required placeholder="Adresse"/>
                            <input type="text" name="ort" style="width: 275px" required placeholder="PLZ, Ort"/>
                            <input type="email" name="mail" style="width: 275px" required placeholder="E-Mail"/>
                            <input type="text" name="mobile" style="width: 275px" required placeholder="Natel-Nr"/> </br></br>
                            Ich komme in Begleitung von: <input type="text" style="width: 275px" name="bname" placeholder="Vorname, Name"/> </br></br>
                            <hr/>
                            Ich bringe <input type="text" name="salat" style="width: 65px" placeholder="Salatsorte"/> für <input type="number" style="width: 40px" name="salat_nr"/> Personen. </br>
                            Ich bringe <input type="number" style="width: 40px" name="cupcake_nr"/> <input type="text" style="width: 95px"name="cupcake" placeholder="Cupcake-Sorte"/>. </br></br>
                            <input type="submit" name="teilnehmen" value="Teilnehmen"/>
                         </form>
                        
                    </section>
                    <section class="img">
                        <img src="img/5.jpg">
                    </section>
                    <section class="text high nobg">
                        <a id="diehelden"></a><h1>Organisation</h1>
                        Diese Freunde machen grosszügig unseren grossen Tag grossartig. Herzlichen DANK!<br/><br/>
                        <div class="person">
                            <img src="img/sharon.jpg"/>
                            <div class="text">Sharon Hunziker ist die Chefin des OK und Anlaufstelle bei allgemeinen Fragen.<br/><br/>
                                <a class="link" href="javascript:givemethemail()">sharon.hunziker(at)gmx.ch</a></div>
                        </div>
                    </section>
                    <section class="text high nobg">
                        <div class="person">
                            <img src="img/person_placeholder.jpg" alt="Beni Keller"/>
                            <div class="text">Beni Keller ist der Bruder und Trauzeuge von Matthias.</div>
                        </div>
                        <div class="person">
                            <img src="img/rahel.jpg" alt="Rahel Küffer"/>
                            <div class="text">Rahel Küffer ist die einzige Schwester der Braut und ihre Trauzeugin.</div>
                        </div>
                    </section>
                    <section class="text high nobg">
                        <div class="person">
                            <img src="img/sarah.jpg" alt="Sarah Fuhrer"/>
                            <div class="text">Sarah Fuhrer ist Deborah’s Freundin und ein Organisationstalent.</div>
                        </div>
                        <div class="person">
                            <img src="img/person_placeholder.jpg" alt="Alex Bedetti"/>
                            <div class="text">Alex Bedetti ist leidenschaftlicher Koch und ein Freund von Matthias.</div>
                        </div>
                    </section>
                    <section class="text high ">
                        <div class="person">
                            <img src="img/florian.jpg" alt="Florian Fankhauser"/>
                            <div class="text">Florian Fankhauser ist der Mitbewohner von Matthias und genialer Webentwickler.</div>
                        </div>
                        <div class="person">
                            <img src="img/person_placeholder.jpg" alt="Sandra Hersberger"/>
                            <div class="text">Sandra Hersberger ist unsere kreative Unterstützung und hat den tollen Flyer gestaltet.</div>
                        </div>
                    </section>
                    <section class="img">
                        <img src="img/7.jpg">
                    </section>
                    <section class="img high">
                        <img src="img/16.jpg">
                    </section>
                    <section class="text high">
                        <a id="daspaar"></a><h1>Die Braut</h1>
                        Mein Name ist Deborah. Ich mag mathematische Herausforderungen, daher studiere und unterrichte ich das. Ich bin oft in Aarau und Bern unterwegs. Ich liebe es Freundschaften zu pflegen und freue mich, wenn es dabei um Jesus geht.
                    </section>
                    <section class="img high">
                        <img src="img/17.jpg">
                    </section>
                    <section class="text high">
                        <h1>Der Bräutigam</h1>
                        Ich bin Matthias Keller. Das Studium zum Holzbauingenieur in Biel beschäftigt mich seit gut 2 Jahren. Nebenbei bin ich im Sommer immer wieder auf Beachvolley-Plätzen anzutreffen oder am Bier trinken. Ich koche gerne und sehne mich nach jesusmässiger Veränderung in dieser Welt.
                    </section>
                    <section class="img">
                        <img src="img/2.jpg">
                    </section>
                    <section class="text">
                        <h1>Unsere Geschichte</h1>
                        Vor einigen Jahren haben wir uns gegenseitig noch Körbe erteilt. Heute sind die Körbe gefüllt mit Überraschungsgeschenke für einander.<br/><br/>
                        In der Vineyard Aarau sind sich die 2 das erste Mal begegnet. Schon damals hat sich Deborah vorgestellt, dass Matthias ihr Mann werden könnte. Doch Matthias hatte kein Auge für eine Beziehung zu diesem Zeitpunkt.<br/><br/>
                        Durch das Jugendprojekt AarauUnited hat es sich ergeben, dass die 2 begannen Vision zu teilen. Man lernte sich kennen und schätzen. Die entstandene Freundschaft wurde immer tiefer.<br/><br/>
                        Im November 2011 entschieden sich die 2 für eine Beziehung miteinander, um herauszufinden, ob sie sich eine Ehe miteinander vorstellen können.<br/><br/>
                        Die romantische Verlobung auf dem Sälischlössli bei Olten im April 2013 befeierten die 2 anschliessend bei ihrem Italiener.
                    </section>
                    <section class="img">
                        <img src="img/9.jpg">
                    </section>
                    <section class="text high">
                        <a id="geschenke"></a><h1>W&uuml;nsche</h1>
                        Klicke auf eine dieser Kategorien. Wir danken für jeden Beitrag.<br/><br/>
                        <?php
                            $res = mysql_query("select * from kategorie order by id");
                            $kategorien = array();
                            while ($kategorie = mysql_fetch_assoc($res)) {
                                echo "<div class=\"kategorie\" onclick=\"showCategory('kategorie" . $kategorie['id'] . "')\">" . $kategorie['name'] . "</div>";
                            }
                        ?>
                    </section>
                    <section class="img high last">
                        <img src="img/15.jpg">
                    </section>
                </div>

            </div>
        </div>
        <footer></footer>  



        <!--
            Wunschliste Lightbox von hier an
        -->
        <div id="wunschlisteContainer" style="display: none">
            <div id="wunschliste" >
                <div id="kategorien">
                    <?php
                        $res = mysql_query("select * from kategorie order by id");
                        $kategorien = array();
                        while ($kategorie = mysql_fetch_assoc($res)) {
                            echo "<div class=\"kategorielink\" id=\"kategorie" . $kategorie['id'] . "link\" onclick=\"showCategory('kategorie" . $kategorie['id'] . "')\">" . $kategorie['name'] . "</div>";
                        }
                    ?>
                    <img style="float: right; cursor: pointer; margin-top: 4px" src="img/close_icon.png" onClick="hideWunschliste();"/>;
                </div>
                <div id="wuensche">
                    <?php                        
                        $res = mysql_query("select * from kategorie order by id");
                        $kategorien = array();
                        while ($kategorie = mysql_fetch_assoc($res)) {
                            $result = mysql_query("select * from wunschliste where kategorie = " . $kategorie['id'] . " order by id asc");
                            $wunschliste = array();
                            echo "<div id=\"kategorie" . $kategorie['id'] . "\" class=\"kategoriebody\"><div class=\"kategorietitle\">" . $kategorie['name'] . "</div>";
                            echo "<div class=\"beschreibung\">" . $kategorie['beschreibung'] . "</div>";
                            while ($wunsch = mysql_fetch_assoc($result)) {
                                $chf = $wunsch['ziel'] > 1 ? 'CHF' : '';
                                $stk = $wunsch['ziel'] > 1 ? 'Betrag' : '1';
                                $prozent = $wunsch['bisher'] / $wunsch['ziel'] * 100;
                                echo "<div class=\"wunsch\">";
                                echo "<img src=\"img/gift/" . $wunsch['bild'] . "\"/>";
                                echo "<div class=\"right\">";
                                echo "<div class=\"wunschtitle\">" . $wunsch['name'] . "</div>";
                                echo "<div class=\"beschreibung\">" . $wunsch['beschreibung'] . "</div>";
                                if ($prozent == 100) {
                                    echo "<input type=\"button\" class=\"schenken\" disabled value=\"Wunsch erf&uuml;llt\" class=\"schenken\" />";
                                } else {
                                    echo "<input type=\"button\" value=\"Schenken\" class=\"schenken\" onClick=\"showSchenken(this," . $wunsch['id'] . ")\"/>";
                                }
                                
                                echo "</div><div style=\"clear: both\"></div><div id=\"schenken" . $wunsch['id'] . "\" class=\"schenken\">";           
                                echo "$chf " . $wunsch['bisher'] . " von $chf " . $wunsch['ziel'] . " erreicht.";     
                                echo "<div class=\"progressbar\"><div class=\"progress\" style=\"width: " . ($prozent / 100 * (400 - 2)) . "px\"></div></div>";
                                echo "<form action=\"index.php\" method=\"post\">Ich will <input type=\"number\" class=\"schenken\" placeholder=\"$stk\" required name=\"betrag\" min=\"0\" max=\"" . ($wunsch['ziel'] - $wunsch['bisher']) . "\">$chf schenken.";
                                echo " Meine Mailadresse ist <input type=\"email\" name=\"mail\" class=\"schenken\" required placeholder=\"Mailadresse\">.";
                                echo "<input type=\"hidden\" name=\"wunschID\" value=\"" . $wunsch['id'] . "\"/><input type=\"submit\" class=\"schenken\" value=\"Los!\"></form></div></div>";                                
                            }
                            
                            echo "</div>";
                        }
                    ?>
                </div>
                <!--<div style="clear: both"></div>-->
            </div>
        </div>
        <footer>&copy; 2013 by Florian Fankhauser</footer>
    </body>
</html>
