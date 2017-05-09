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
                                <li class="active"><a href="http://stu-nginx.cms.gre.ac.uk/~me324/sowa/level5/level5.php">Level 5 : Portal result display</a></li>
                                <li><a href="http://stu-nginx.cms.gre.ac.uk/~me324/sowa/level6/level6.php">Level 6 : XSLT</a></li>
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
            <h3>Level 5 : Portal Result Display</h3>
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
                $url = 'http://stuiis.cms.gre.ac.uk/me324/sowa/level2.asmx/level2?subBedroom=&subMin=&subMax=&subLocation=&subPropertyId=' . htmlspecialchars($_GET["propertyId"]) . '&pageNumber=&pageSize=';
                print $url;
                $xml = file_get_contents($url);
                $xmlDoc = new DOMDocument();
                $xmlDoc->loadXML($xml, LIBXML_NOBLANKS);
            }
            
            # Get property node
            $node = $xmlDoc->getElementsByTagName("property");
            
            # Print results
            foreach ($node as $node) {
                print "<table class='table'>";
                $title = $node->getElementsByTagName("title")->item(0)->nodeValue;
                $price = $node->getElementsByTagName("price")->item(0)->nodeValue;
                $bedroom = $node->getElementsByTagName("bedroom")->item(0)->nodeValue;
                $address = $node->getElementsByTagName("address")->item(0)->nodeValue;
                $location = $node->getElementsByTagName("location")->item(0)->nodeValue;
                $description = $node->getElementsByTagName("description")->item(0)->nodeValue;
                $kitchen = $node->getElementsByTagName("kitchen")->item(0)->nodeValue;
                $bathroom = $node->getElementsByTagName("bathroom")->item(0)->nodeValue;
                $livingRoom = $node->getElementsByTagName("livingRoom")->item(0)->nodeValue;
                $garage = $node->getElementsByTagName("garage")->item(0)->nodeValue;
                $carpet = $node->getElementsByTagName("carpet")->item(0)->nodeValue;
                $username = $node->getElementsByTagName("username")->item(0)->nodeValue;
                $email = $node->getElementsByTagName("email")->item(0)->nodeValue;
                $image = $node->getElementsByTagName("imageData")->item(0)->nodeValue;
                print "<tr><td rowspan='7' width='10%'><img height='200' width='200' src='" . $image . "'></img></td></tr>";
                print "<tr><th colspan='2'>" . $title . "</th></tr>";
                print "<tr><td><b>Property ID : </b>" . $node->getAttribute('propertyId') . "</td><td><b>Database : </b>" . $node->getAttribute('db') . "</td></tr>";
                print "<tr><td colspan='2'><b>Address : </b>" . $address . "</td></tr>";
                print "<tr><td colspan='2'><b>Price £: </b>" . $price . "</td></tr>";
                print "<tr><td colspan='2'><b>Location : </b>" . $location . "</td></tr>";
                print "<tr><td colspan='2'><b>No. Bedroom : </b>" . $bedroom . "</td></tr>";
                print "<tr><td colspan='3'><b>Description : </b>" . $description . "</td></tr>";
                print "<tr><td colspan='3'><b>Addtional Information</b></td></tr>";
                print "<tr>";
                print "<td><b>Living Room : </b>" . $livingRoom . "</td>";
                print "<td><b>Kitchen : </b>" . $kitchen . "</td>";
                print "<td><b>Bathroom : </b>" . $bathroom . "</td>";
                print "</tr>";
                print "<tr>";
                print "<td><b>Garage : </b>" . $garage . "</td>";
                print "<td colspan='2'><b>Carpet : </b>" . $carpet . "</td>";
                print "</tr>";
                print "<tr><td colspan='3'><b>Addtional Images</b></td></tr>";
                $image1 = $node->getElementsByTagName("imageData");
                print "<tr><td colspan='4'>";
                foreach ($image1 as $image1) {
                    print "<img height='200' width='200' src='" . $image1->nodeValue . "'>";
                }
                print "</td></tr>";
                print "<tr><td colspan='3'><b>Map</b></td></tr>";
                print "<tr><td colspan='3'><img style='width: 100%; height: auto;' src='https://maps.googleapis.com/maps/api/staticmap?center=" . $address . "&amp;zoom=15&amp;size=800x200&amp;maptype=roadmap&amp;markers=size:mid%7Ccolor:red%7C" . $address . "'></img></td></tr>";
                print "<tr><td colspan='3'><b>Contact Details</b></td></tr>";
                print "<td><b>Username : </b>" . $username . "</td>";
                print "<td><b>Email : </b>" . $email . "</td>";
                print "</table>";
            }
            ?>
        </div>
    </body>
</html>                         