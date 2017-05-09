<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Service Oriented Web Applications</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Service Oriented Web Applications</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1"/>      
        <!--AJAX-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>       
        <!--Common css-->
        <link href="../common/css.css" rel="stylesheet" type="text/css"/>
        <!--Common js-->
        <script src="../common/functions.js" type="text/javascript"></script>
        <!--Bootstrap https://www.w3schools.com/bootstrap/-->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>
            @media (min-width: 1200px) {
                .container{
                    max-width: 60em;
                }
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="http://stu-nginx.cms.gre.ac.uk/~me324/sowa/index.php">COMP1688 (2016/17)</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="http://stu-nginx.cms.gre.ac.uk/~me324/sowa/index.php"><span class="glyphicon glyphicon-tasks"></span> Home</a></li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-log-in"></span>  Levels <span class="caret"></span></a>
                            <ul class="dropdown-menu">                             
                                <li><a href="http://stu-nginx.cms.gre.ac.uk/~me324/sowa/level1/xml-dtd.xml" target="_blank">Level 1 : XML</a></li>
                                <li><a href="http://stuiis.cms.gre.ac.uk/me324/sowa/level2/level2Scaffolding.php">Level 2 : .NET web services</a></li>
                                <li><a href="http://stuweb.cms.gre.ac.uk/~me324/sowa/level3/level3Scaffolding.php">Level 3 : PHP web services</a></li>
                                <li><a href="http://stu-nginx.cms.gre.ac.uk/~me324/sowa/level4/level4Scaffolding.php">Level 4 : Portal search</a></li>
                                <li><a href="http://stu-nginx.cms.gre.ac.uk/~me324/sowa/level5/level5.php">Level 5 : Portal result display</a></li>
                                <li class="active"><a href="http://stu-nginx.cms.gre.ac.uk/~me324/sowa/level6/level6.php">Level 6 : XSLT</a></li>
                                <li><a href="#">Level 7 : Ajax portal</a></li>
                                <li><a href="#">Level 8 : JSON</a></li>
                                <li><a href="#">Level 9 : Mobile</a></li>
                                <li><a href="#">Level 10 : Report</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#"><span class="glyphicon glyphicon-user"></span>  By Elwyne Mabanglo</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="jumbotron text-center">
            <h1>Service Oriented Web Applications</h1>
            <p>COMP1688 (2016/17)</p> 
        </div>
        <div class="container">
            <h3>Level 6 : XSLT</h3>
            <button onclick="goBack()" class="btn btn-default">Go Back</button>
            <p></p>
            <script>
                // Back button
                function goBack() {
                    window.history.back();
                }
            </script>
            <?php
            # Get data from chosen property
            if (htmlspecialchars($_GET["db"]) == "BH") {
                $url = 'http://stuweb.cms.gre.ac.uk/~me324/sowa/level3/level3WebService.php?bedroom=&min=&max=&location=&pageNumber=&pageSize=&orderBy=location&propertyId=' . htmlspecialchars($_GET["propertyId"]);
                print $url;
                $xmlDoc = new DOMDocument();
                $xmlDoc->load($url);
            } else {
                $url = 'http://stuiis.cms.gre.ac.uk/me324/sowa/level2.asmx/level2?subBedroom=&subMin=&subMax=&subLocation=&pageNumber=&pageSize=&subPropertyId=' . htmlspecialchars($_GET["propertyId"]);
                print $url;
                $xml = file_get_contents($url);
                $xmlDoc = new DOMDocument();
                $xmlDoc->loadXML($xml, LIBXML_NOBLANKS);
            }
            
            # Transform XML to XSLT
            $xslt = new XSLTProcessor();
            $xslDoc = new DOMDocument();
            $xslDoc->load('moreInformation.xsl', LIBXML_NOCDATA);
            $xslt->importStylesheet($xslDoc);
            
            # Output results
            echo $xslt->transformToXML($xmlDoc);
            ?>
        </div>
    </body>
</html>