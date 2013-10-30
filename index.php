﻿<!DOCTYPE html>
<?php
    include('scripts.php');
?>
<html>
    <head>
        <script src="js/jquery.js"></script>
        <script src="js/jquery.mousewheel.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css" />
        <script>
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
                
                $('#wunschlisteContainer').click(function(event) {
                    if (event.originalEvent.srcElement == this) {
                        hideWunschliste();
                    }
                });   
                
                $("body").mousewheel(function(event, delta) {
                    $("#scrollBox").scrollLeft($("#scrollBox").scrollLeft() - delta * 50);
                    event.preventDefault();
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
                    <section class="text">
                        <a id="willkommen"></a><h1>Willkommen</h1>
                        asdfasd fasd fas df
                    </section>
                    <section class="img">
                        <img src="img/1.jpg">
                    </section>
                    <section class="text">
                        <a id="dertag"></a><h1>Alles zur Hochzeit</h1>
                        Info zur Idee, dabeisein, so viel man mag und möchte
                        Ablauf des Tages
                        Ort, Zeit, und Zufahrt
                        Fest am Abend in der Region Aarau
                    </section>
                    <section class="img">
                        <img src="img/2.jpg">
                    </section>
                    <section class="text nobg">
                        <a id="dabeisein"></a><h1>Dabei sein</h1>
                        Teilnahme am ganzen Fest
                        Nach Anmeldung Mail mit Bestätigung und Hinweis dass Beiträge beim Brautfüh-rerteam 
                        Anmeldung Cupcakes oder Muffins (klein oder gross) Sorte.
                        Wir freuen uns auf die kreativen Dekos
                    </section>
                    <section class="text high">
                        <h1>Anmeldung</h1>
                        <form action="index.php" method="post">
                            Ich bin am Abend dabei. </br>
                            <input type="text" name="name" style="width: 275px" required placeholder="Vorname, Name"/>
                            <input type="text" name="adresse" style="width: 275px" required placeholder="Adresse"/>
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
                        Kurzüberblick Trauzeugen
                        Kurzüberblick OK 
                    </section>
                    <section class="text high nobg">
                        <div class="person">
                            <img src="img/person_placeholder.jpg"/>
                            <div class="text">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam</div>
                        </div>
                        <div class="person">
                            <img src="img/person_placeholder.jpg"/>
                            <div class="text">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam</div>
                        </div>
                    </section>
                    <section class="text high nobg">
                        <div class="person">
                            <img src="img/person_placeholder.jpg"/>
                            <div class="text">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam</div>
                        </div>
                        <div class="person">
                            <img src="img/person_placeholder.jpg"/>
                            <div class="text">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam</div>
                        </div>
                    </section>
                    <section class="text high nobg">
                        <div class="person">
                            <img src="img/person_placeholder.jpg"/>
                            <div class="text">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam</div>
                        </div>
                        <div class="person">
                            <img src="img/person_placeholder.jpg"/>
                            <div class="text">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam</div>
                        </div>
                    </section>
                    <section class="text high">
                        <div class="person">
                            <img src="img/person_placeholder.jpg"/>
                            <div class="text">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam</div>
                        </div>
                    </section>
                    <section class="img">
                        <img src="img/7.jpg">
                    </section>
                    <section class="text">
                        <a id="daspaar"></a><h1>Wer sind die 2?</h1>
                        Je noch dem was Gäst a Dessert oder Salat no chöne metbrenge :)
                        Gemäss separatem Exel.
                    </section>
                    <section class="img high">
                        <img src="img/15.jpg">
                    </section>
                    <section class="text high">
                        <a id="geschenke"></a><h1>W&uuml;nsche</h1>
                        <?php
                            $res = mysql_query("select * from kategorie order by id");
                            $kategorien = array();
                            while ($kategorie = mysql_fetch_assoc($res)) {
                                echo "<div class=\"kategorie\" onclick=\"showCategory('kategorie" . $kategorie['id'] . "')\">" . $kategorie['name'] . "</div>";
                            }
                        ?>
                    </section>
                    <section class="img last high">
                        <img src="img/12.jpg">
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
                            
                            while ($wunsch = mysql_fetch_assoc($result)) {
                                $prozent = $wunsch['bisher'] / $wunsch['ziel'] * 100;
                                echo "<div class=\"wunsch\">";
                                echo "<div class=\"title\">" . $wunsch['name'] . "</div>";
                                echo "<img src=\"img/placeholder.png\"/>";
                                echo "<div class=\"right\">";
                                echo "<div class=\"beschreibung\">" . $wunsch['beschreibung'] . "</div>";
                                if ($prozent == 100) {
                                    echo "<input type=\"button\" class=\"schenken\" disabled value=\"Wunsch erf&uuml;llt\" class=\"schenken\" />";
                                } else {
                                    echo "<input type=\"button\" value=\"Schenken\" class=\"schenken\" onClick=\"showSchenken(this," . $wunsch['id'] . ")\"/>";
                                }
                                
                                echo "</div><div style=\"clear: both\"></div><div id=\"schenken" . $wunsch['id'] . "\" class=\"schenken\">";           
                                echo "CHF " . $wunsch['bisher'] . " von CHF " . $wunsch['ziel'] . " erreicht.";     
                                echo "<div class=\"progressbar\"><div class=\"progress\" style=\"width: " . ($prozent / 100 * (400 - 2)) . "px\"></div></div>";
                                echo "<form action=\"index.php\" method=\"post\">Ich will <input type=\"number\" class=\"schenken\" placeholder=\"Betrag\" required name=\"betrag\" min=\"0\" max=\"" . ($wunsch['ziel'] - $wunsch['bisher']) . "\">CHF schenken.";
                                echo " Meine Mailadresse ist <input type=\"email\" name=\"mail\" class=\"schenken\" required placeholder=\"Mailadresse\">.";
                                echo "<input type=\"hidden\" name=\"wunschID\" value=\"" . $wunsch['id'] . "\"/><input type=\"submit\" class=\"schenken\" value=\"Los!\"></form></div></div>";                                
                            }
                            
                            echo "</div>";
                        }
                    ?>
                </div>
            </div>
        </div>
        <footer>&copy; 2013 by Florian Fankhauser</footer>
    </body>
</html>
