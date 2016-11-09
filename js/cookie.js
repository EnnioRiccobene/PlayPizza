$(
    function () {
        var ck = false;
        if ( document.cookie && document.cookie.match(/cookie=1/) ) {
            ck = true;
        }
         
        if ( ! ck ) {
            $("body").append(
                "<section id='cookie'>\
                    Questo sito utilizza cookie tecnici per offrirti una migliore esperienza di navigazione sul sito. Se vuoi saperne di più premi\
                    <a href='cookie.php'>questo link</a> oppure \
                    <a href='#' data-show='none' data-setc='closecookie'>Chiudi</a> questo avviso.\
                </section>"
            );
             
            $("#cookie").css({
                position: "fixed"
                , top: 0
                , left: 0
                , width: "100%"
                , background: "rgba(255,0,0,0.7)"
                , "z-index": 60
                , padding: "1em"
                , color: "white"
                , "text-align": "center"
                , "box-shadow": "0 .5em .5em rgba(0,0,0,.5)"
                , margin: 0
                , "min-height": 0
            });
             
            $("#cookie>a").css({
                "text-decoration": "none"
                , width: "8em"
                , background: "white"
                , color: "#black"
                , "border-radius": ".2em"
                , display: "inline-block"
                , "text-align": "center"
            });
             
            $("#cookie>a:first").css({
                background: "white"
            });
             
            $("a[data-setc='closecookie']").click(
                function (e) {
                    $("#cookie").remove();
                    document.cookie = [
                        encodeURIComponent('cookie'), '=1',
                        '; expires=Sat, 31 Dec 2050 00:00:00 UTC',
                        '; path=/'
                    ].join('');
                }
            );
        }
    }
);
