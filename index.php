<!DOCTYPE html>
<?php
    $db = mysql_connect('localhost', 'web145', '*tXm&2y0C*6R');    
    mysql_select_db('usr_web145_12', $db);

?>
<html>
    <head>
        <script src="js/jquery.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css" />
        <link rel="stylesheet" type="text/css" href="wuensche.css" />
        <script>
            $(function() {
                $('nav a').click(
                        function(event) {
                            $("#scrollBox").stop().animate(
                                    {
                                        scrollLeft: $($(this).attr('href')).parent(
                                                'section').offset().left
                                                + $('#scrollBox').scrollLeft()
                                                - $('#scrollBox').offset().left
                                    }, 2000);
                            event.preventDefault();
                        });
                $('.kategorie>.head').click(function() {
                    //			$('.kategorie>.body').slideUp();
                    $(this).parent('.kategorie').children('.body').slideToggle();
                });
                $('#wunschlisteContainer').click(function(event) {
                    if (event.originalEvent.srcElement == this) {
                        $("#wunschlisteContainer").hide();
                    }
                });
            });


            function showCategory(cat) {
                $("#wunschlisteContainer").show();
                $(".kategoriebody").hide();
                $("#" + cat).show();
                $(".kategorielink.selected").removeClass("selected");
                $("#" + cat + "link").addClass("selected");
            }
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
                        <a id="willkommen"><h1>Willkommen</h1></a>
                        asdfasd fasd fas df
                    </section>
                    <section class="img">
                        <img src="img/1.jpg">
                    </section>
                    <section class="text">
                        <a id="dertag"><h1>Alles zur Hochzeit</h1></a> 
                        Info zur Idee, dabeisein, so viel man mag und möchte
                        Ablauf des Tages
                        Ort, Zeit, und Zufahrt
                        Fest am Abend in der Region Aarau
                    </section>
                    <section class="img">
                        <img src="img/2.jpg">
                    </section>
                    <section class="text">
                        <a id="dabeisein"><h1>Anmeldeformular</h1></a> 
                        Teilnahme am ganzen Fest
                        Nach Anmeldung Mail mit Bestätigung und Hinweis dass Beiträge beim Brautfüh-rerteam 
                        Anmeldung Cupcakes oder Muffins (klein oder gross) Sorte.
                        Wir freuen uns auf die kreativen Dekos
                    </section>
                    <section class="img">
                        <img src="img/5.jpg">
                    </section>
                    <section class="text">
                        <a id="diehelden"><h1>Organisation</h1></a> 
                        Kurzüberblick Trauzeugen
                        Kurzüberblick OK 
                    </section>
                    <section class="img">
                        <img src="img/7.jpg">
                    </section>
                    <section class="text">
                        <a id="daspaar"><h1>Wer sind die 2?</h1></a>
                        Je noch dem was Gäst a Dessert oder Salat no chöne metbrenge :)
                        Gemäss separatem Exel.
                    </section>
                    <section class="img high">
                        <img src="img/15.jpg">
                    </section>
                    <section class="text high">
                        <a id="geschenke"><h1>W&uuml;nsche</h1></a>
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
                                echo "<div class=\"wunsch\">";
                                echo "<div class=\"title\">" . $wunsch['name'] . "</div>";
                                echo "<img src=\"img/placeholder.png\"/>";
                                echo "<div class=\"right\">";
                                echo "<div class=\"beschreibung\">" . $wunsch['beschreibung'] . "</div>";
                                echo "<div class=\"progressbar\"><div class=\"progress\" style=\"width: " . ($wunsch['bisher'] / $wunsch['ziel'] * 100) . "%\"></div></div>";
                                echo "</div>";                
                                echo "<div class=\"schenken\">";
                                echo "<form>Ich will <input type=\"number\" placeholder=\"Betrag\">CHF schenken.";
                                echo " Meine Mailadresse ist <input type=\"email\" placeholder=\"Mailadresse\">.";
                                echo "<input type=\"button\" value=\"Los!\"></form></div></div>";                                
                            }
                            
                            echo "</div>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
