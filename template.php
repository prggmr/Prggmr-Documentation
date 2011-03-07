<!html>
<html>
<head>
    <title>Prggmr - The PHP 5.3 Event Framework - Prggmr Guide</title>
    <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link href='http://fonts.googleapis.com/css?family=Droid+Sans:regular,bold&subset=latin' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz&subset=latin' rel='stylesheet' type='text/css'>
    <link href='css/stylesheet.css' rel='stylesheet' type='text/css' />
    <link rel="icon" href="images/favicon.png" />
    <link href="js/google-prettify/prettify.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/google-prettify/prettify.js"></script>
    <script type="text/javascript">

        //
        //var _gaq = _gaq || [];
        //_gaq.push(['_setAccount', 'UA-20593029-1']);
        //_gaq.push(['_setDomainName', 'none']);
        //_gaq.push(['_setAllowLinker', true]);
        //_gaq.push(['_trackPageview']);
        //
        //(function() {
        //  var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        //  ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        //  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        //})();

        function url(param) {
            param = param.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
            var regexS = "[\\?&]"+param+"=([^&#]*)";
            var regex = new RegExp( regexS );
            var results = regex.exec( window.location.href );
            if ( null === results ) {
                return null;
            } else {
                return results[1];
            }
        }

        function load(content) {
            $('div#left').fadeOut(function(){
                //$('body, html').animate({scrollTop: 0}, 750, function(){
                    $('div#left').html(content);
                    $('div#left').fadeIn();
                    parseLinks();
                    prettyPrint();
                //});
            });
        }

        function parseLinks() {
            $('a[rel=guide]').each(function(){
                var parsed = $(this).attr('parsed');
                // only parse a tags once ...
                if (!parsed) {
                    $(this).click(function(){
                        var href = $(this).attr('href');
                        // track google code
                        $.ajax({
                            url: href,
                            method: 'get',
                            success: function(result){
                                load(result);
                            }
                        });
                        return false;
                    });
                    $(this).attr('parsed', 'true');
                }
            });
        };

        function loadExample(title, page) {
            $('#example-background').fadeIn(function(){
                var body = $('#example-body');
                body.html(
                '<div id="close-button"><a href="#" onclick="$(\'#example-background\').click();">X</a></div>'+
                '<h2>' + title +'</h2><p id="example-content"><img src="images/ajax-loader.gif" /></p>'+
                '<p><a href="#" onclick="loadExample(\''+title+'\', \''+page+'\'); return false;">Run this example again!</a> | '+
                '<a href="examples/download_source.php?example='+page+'" target="_blank">Download this example</a> | '+
                '<a href="#" onclick="$(\'#example-background\').click();">Close this example</a></p>');
                body.fadeIn();
                $.ajax({
                    url: page,
                    method: 'get',
                    success: function(result){
                        $('#example-content').html(result);
                    }
                });
            });
        }

        $().ready(function(){
            //parseLinks();
            if (null !== url('page')) {
                $.ajax({
                    url: url('page'),
                    method: 'get',
                    success: function(result){
                        load(result);
                    }
                });
            }
            $('#autoload').click();
            $('#example-background').click(function(){
                $('#example-body').fadeOut(function(){
                    $(this).html('');
                    $('#example-background').fadeOut();
                });
                return false;
            });
            var nav = $('div#right');
            //$(window).scroll(function(){
            //        nav.stop();
            //        if ($('div#body').height() <= $(window).scrollTop() - 100) return true;
            //        if ($(window).scrollTop() === 0 || $(window).scrollTop() <= 75) {
            //            nav.animate({"marginTop": ($(window).scrollTop() + 10) + "px"}, 1000 );
            //        } else {
            //            nav.animate({"marginTop": ($(window).scrollTop() - 70) + "px"}, 1000 );
            //        }
            // });
        });

    </script>
</head>
<body onload="prettyPrint();">
    <div id="example-background">
    </div>
    <div id="example-body">
    </div>
    <div id="body">
        <section id="logo">
            <aside>
                0110
            </aside>
            <h1>
                Prggmr
                <span>
                    <a href="/index" id="autoload" rel="guide">i &#9829; code</a>
                </span>
            </h1>
            <p>
                A PHP 5.3 Event Framework developed by Nickolas Whiting
            </p>
        </section>
        <section id="content">
            <div class="clear"></div>
            <div id="right">
                <ul>
                    <li id="search">
                        <h3>
                            Search the Guide
                        </h3>
                        <input type="text" class="search" />
                    </li>
                    <li>
                        <h3>
                            The Basics
                        </h3>
                    </li>
                    <li>
                        <a href="/prggmr_intro" rel="guide">
                            What is Prggmr?
                        </a>
                    </li>
                    <li>
                        <a href="/eda" rel="guide">
                            Event Driven Architecture
                        </a>
                    </li>
                    <li>
                        <a href="/download_install" rel="guide">
                            Download &amp; Installation
                        </a>
                    </li>

                    <li>
                        <a href="/hello_events" rel="guide">
                            Hello Events Tutorial
                        </a>
                    </li>
                    <li>
                        <h3>
                            Prggmr Library
                        </h3>
                    </li>
                    <li>
                        <a href="/api_introduction" rel="guide">
                            Prggmr Introduction
                        </a>
                    </li>
                    <li>
                        <h4>
                            Event Publishing
                        </h4>
                    </li>
                    <li>
                        <a href="/api_introduction" rel="guide">
                            Publishing Introduction
                        </a>
                    </li>
                    <li>
                        <a href="/api_introduction" rel="guide">
                            Globally Publishing
                        </a>
                    </li>
                    <li>
                        <a href="/api_introduction" rel="guide">
                            Listenable Object
                        </a>
                    </li>
                    <li>
                        <a href="/api_introduction" rel="guide">
                            Event Object
                        </a>
                    </li>
                    <li>
                        <h4>
                            Event Subscriptions
                        </h4>
                    </li>
                    <li>
                        <a href="/api_introduction" rel="guide">
                            Subscription Introduction
                        </a>
                    </li>
                    <li>
                        <a href="/api_introduction" rel="guide">
                            Globally Subscribing
                        </a>
                    </li>
                    <li>
                        <a href="/api_introduction" rel="guide">
                            Event Object
                        </a>
                    </li>
                    <li>
                        <h4>
                            Event
                        </h4>
                    </li>
                    <li>
                        <a href="/api_introduction" rel="guide">
                            prggmr::listen
                        </a>
                    </li>
                    <li>
                        <a href="/api_introduction" rel="guide">
                            prggmr::trigger
                        </a>
                    </li>
                    <li>
                        <h3>
                            Sample Applications
                        </h3>
                    </li>
                    <li>
                        <a href="/student_tracker" rel="guide">
                            The Student Tracker
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            PHP Interactive Console
                        </a>
                    </li>
                   <!-- <li>
                        <a href="#">

                        </a>
                    </li>
                    <li>
                        <a href="#">
                            Prggmr Introduction
                        </a>
                    </li>-->
                    <!--<li>
                        <h3>
                            Best Practives
                        </h3>
                    </li>
                    <li>
                        <a href="#">
                            Event Driven Architecture
                        </a>
                    </li>-->
                </ul>
            </div>
            <div id="left">
                <?php echo $page_contents; ?>
            </div>
            <div class="clear"></div>
        </section>
    </div>
</body>
</html>
