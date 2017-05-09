<?php
# Reset Button, reset fields
if (isset($_GET['resetBtn'])) {
    $bedroom = $_GET["bedroom"] = "";
    $_GET["pageNumber"] = $pageNumber = 1;
    $_GET["propertyId"] = $propertyId = "";
    $_GET["pageSize"] = $pageSize = 10;
    $_GET["location"] = $location = "";
    $_GET["orderby"] = $orderby = "ascending";
    $_GET["sortby"] = $sortby = "title";
    $_GET["min"] = $min = 1;
    $_GET["max"] = $max = 100000000;
} else
# Reset Button not pressed get current value or reset fields
if (!isset($_GET['resetBtn'])) {
    if (!isset($_GET["bedroom"])) {
        $bedroom = $_GET["bedroom"] = "";
    } else {
        $bedroom = $_GET["bedroom"];
    }
    if (!isset($_GET["location"])) {
        $location = $_GET["location"] = "";
    } else {
        $location = $_GET["location"];
    }
    if (!isset($_GET["propertyId"])) {
        $propertyId = $_GET["propertyId"] = "";
    } else {
        $propertyId = $_GET["propertyId"];
    }
    if (!isset($_GET["pageNumber"])) {
        $pageNumber = $_GET["pageNumber"] = 1;
    } else {
        $pageNumber = $_GET["pageNumber"];
    }
    if (!isset($_GET["pageSize"])) {
        $pageSize = $_GET["pageSize"] = 10;
    } else {
        $pageSize = $_GET["pageSize"];
    }
    if (!isset($_GET["orderby"])) {
        $orderby = $_GET["orderby"] = "ascending";
    } else {
        $orderby = $_GET["orderby"];
    }
    if (!isset($_GET["sortby"])) {
        $sortby = $_GET["sortby"] = "title";
    } else {
        $sortby = $_GET["sortby"];
    }
    if (!isset($_GET["min"])) {
        $min = $_GET["min"] = 1;
    } else {
        $min = $_GET["min"];
    }
    if (!isset($_GET["max"])) {
        $max = $_GET["max"] = 100000000;
    } else {
        $max = $_GET["max"];
    }
}
?>
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
        <!--Bootstrap https://www.w3schools.com/bootstrap/-->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script>
            // Slider - https://jqueryui.com/slider/#range
            $(function () {
                $("#slider-range").slider({
                    range: true,
                    min: 1,
                    max: 100000000,
                    values: [<?php echo $min ?>, <?php echo $max ?>],
                    slide: function (event, ui) {
                        $("#min").val(ui.values[ 0 ]);
                        $("#max").val(ui.values[ 1 ]);
                        $("#amount").val("£" + ui.values[ 0 ] + " - £" + ui.values[ 1 ]);
                    }
                });
                $("#amount").val("£" + $("#slider-range").slider("values", 0) + " - £" + $("#slider-range").slider("values", 1));
                $("#min").val($("#slider-range").slider("values", 0));
                $("#max").val($("#slider-range").slider("values", 1));
            });
        </script>
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
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
                    <a class="navbar-brand" href="http://stu-nginx.cms.gre.ac.uk/~me324/sowa/index.php">COMP1688 (2016/17)</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li><a href="http://stu-nginx.cms.gre.ac.uk/~me324/sowa/index.php"><span class="glyphicon glyphicon-tasks"></span> Home</a></li>
                        <li class="dropdown active">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-log-in"></span>  Levels <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                               <li><a href="http://stu-nginx.cms.gre.ac.uk/~me324/sowa/level1/level1.php">Level 1 : XML</a></li>
                                <li><a href="http://stuiis.cms.gre.ac.uk/me324/sowa/level2/level2Scaffolding.php">Level 2 : .NET web services</a></li>
                                <li><a href="http://stuweb.cms.gre.ac.uk/~me324/sowa/level3/level3Scaffolding.php">Level 3 : PHP web services</a></li>
                                <li><a href="http://stu-nginx.cms.gre.ac.uk/~me324/sowa/level4/level4Scaffolding.php">Level 4 : Portal search</a></li>
                                <li class="active"><a href="http://stu-nginx.cms.gre.ac.uk/~me324/sowa/level5/level5.php">Level 5 : Portal result display</a></li>
                                <li><a href="http://stu-nginx.cms.gre.ac.uk/~me324/sowa/level6/level6.php">Level 6 : XSLT</a></li>
                                <li><a href="http://stu-nginx.cms.gre.ac.uk/~me324/sowa/level7/level7.php">Level 7 : Ajax portal</a></li>
                                <li><a href="http://stu-nginx.cms.gre.ac.uk/~me324/sowa/level8/level8.php">Level 8 : JSON</a></li>
                                <li><a href="http://stu-nginx.cms.gre.ac.uk/~me324/sowa/level9/level9.php">Level 9 : Mobile</a></li>
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
            <h3>Level 5 : Portal Result Display <button data-toggle="collapse" data-target="#collapse" class="btn btn-default btn-sm">Search</button></h3>
            <div id="collapse" class="collapse">
                <form method="get" action="level5.php">
                    <div class="form-group">
                        <label for="bedroom">Bedroom:</label>
                        <input type="text" class="form-control" id="bedroom" name="bedroom" value="<?php echo $bedroom ?>">
                    </div>
                    <div class="form-group">
                        <label for="location">Location:</label>
                        <input type="text" class="form-control" id="location" name="location" value="<?php echo $location ?>">
                    </div>
                    <div class="form-group">
                        <label for="min">Min £:</label>
                        <input type="text" class="form-control" id="min" name="min" value="<?php echo $min; ?>">
                    </div>
                    <div class="form-group">
                        <label for="max">Max £:</label>
                        <input type="text" class="form-control" id="max" name="max" value="<?php echo $max ?>">
                    </div>
                    <div class="form-group">
                        <p>
                            <label for="amount">Price Range:</label>
                            <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
                        </p>
                        <div id="slider-range"></div>
                    </div>
                    <div class="form-group">
                        <label for="sortby">Sort By:</label>
                        <select name="sortby" class="form-control" id="sortby">
                            <option value="title" <?php
                            if ($sortby == 'title') {
                                echo("selected");
                            }
                            ?>>Title</option>
                            <option value="propertyId" <?php
                            if ($sortby == 'propertyId') {
                                echo("selected");
                            }
                            ?>>Property ID</option>
                            <option value="price" <?php
                            if ($sortby == 'price') {
                                echo("selected");
                            }
                            ?>>Price</option>
                            <option value="bedroom" <?php
                            if ($sortby == 'bedroom') {
                                echo("selected");
                            }
                            ?>>Bedroom</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="orderby">Order By:</label>
                        <select name="orderby" class="form-control" id="orderby">
                            <option value="ascending" <?php
                            if ($orderby == 'ascending') {
                                echo("selected");
                            }
                            ?>>Ascending</option>
                            <option value="descending" <?php
                            if ($orderby == 'descending') {
                                echo("selected");
                            }
                            ?>>Descending</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="propertyId">Property ID:</label>
                        <input type="text" class="form-control" id="max" name="propertyId" value="<?php echo $propertyId ?>">
                    </div>
                    <div class="form-group hidden">
                        <label for="pageNumber">Page Number:</label>
                        <input type="text" class="form-control" id="pageNumber" name="pageNumber" value="<?php echo $pageNumber ?>">
                    </div>
                    <div class="form-group">
                        <label for="pageSize">Page Size:</label>
                        <select name="pageSize" class="form-control" id="pageSize">
                            <option value="10" <?php
                            if ($pageSize == '10') {
                                echo("selected");
                            }
                            ?>>10</option>
                            <option value="20" <?php
                            if ($pageSize == '20') {
                                echo("selected");
                            }
                            ?>>20</option>
                            <option value="30" <?php
                            if ($pageSize == '30') {
                                echo("selected");
                            }
                            ?>>30</option>
                            <option value="40" <?php
                            if ($pageSize == '40') {
                                echo("selected");
                            }
                            ?>>40</option>
                        </select>
                    </div>
                    <script>
                        function next() {
                            var value = parseInt(document.getElementById('pageNumber').value, 10);
                            value = isNaN(value) ? 0 : value;
                            value++;
                            document.getElementById('pageNumber').value = value;
                        }
                        function previous() {
                            var value2 = parseInt(document.getElementById('pageNumber').value, 10);
                            value2 = isNaN(value2) ? 0 : value2;
                            value2--;
                            if (value2 == 0) {
                                value2 = 1;
                            }
                            document.getElementById('pageNumber').value = value2;
                        }
                    </script>
                    <button type="submit" class="btn btn-default" name="search">Submit</button>
            </div>
        </div>
        <div class="container">
            <p></p>
            <button type="submit" onclick="previous()" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-backward"></span></button>                          
            <button type="submit" onclick="next()" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-forward"></span></button>
            <button type="submit"  class="btn btn-default btn-sm" name="resetBtn"><span class="glyphicon glyphicon-refresh"></span></button>
        </form>
        <p></p>
        <?php
        # php_form_validation - https://www.w3schools.com/php/php_form_validation.asp

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        # Get data & test input
        $location = test_input($_GET['location']);
        $orderby = test_input($_GET['orderby']);
        $sortby = test_input($_GET['sortby']);
        $min = test_input($_GET['min']);
        $max = test_input($_GET['max']);
        $bedroom = test_input($_GET['bedroom']);
        $propertyId = test_input($_GET['propertyId']);
        $pageSize = test_input($_GET['pageSize']);
        $pageNumber = test_input($_GET['pageNumber']);

        # Add data to array
        $isNumber = array($min, $max, $bedroom, $propertyId, $pageSize, $pageNumber);
        $isString = array($location, $orderby, $sortby);

        # Check are numbers are numeric
        foreach ($isNumber as $element) {
            if (!is_numeric($element) && $element != "") {
                echo "'{$element}' is NOT numeric", PHP_EOL;
                die('<directory/>');
            }
        }

        # Check valid characters
        foreach ($isString as $element) {
            if (preg_match("/[^a-zA-Z0-9 \-']|^$/", $element) && $element != "") {
                echo "'{$element}' is NOT numeric", PHP_EOL;
                die('<directory/>');
            }
        }

        # http_build_query - Generate URL-encoded query string - http://php.net/manual/en/function.http-build-query.php
        $args = array(
            'min' => $min,
            'max' => $max,
            'location' => $location,
            'propertyId' => $propertyId,
            'bedroom' => $bedroom,
            'propertyId' => $propertyId,
            'orderby' => $orderby,
            'sortby' => $sortby,
            'pageSize' => $pageSize,
            'pageNumber' => $pageNumber
        );

        # Apend args
        $queryString = http_build_query($args);
        $url = 'http://stu-nginx.cms.gre.ac.uk/~me324/sowa/level5/sort.php?' . $queryString;

        echo $url;

        # Get XML
        $xml1 = file_get_contents($url);
        $xmlDom1 = new DOMDocument();
        $xmlDom1->loadXML($xml1);

        # Get property node
        $node = $xmlDom1->getElementsByTagName("property");

        # Print results
        foreach ($node as $node) {
            print "<table class='table'>";
            $title = $node->getElementsByTagName("title")->item(0)->nodeValue;
            $price = $node->getElementsByTagName("price")->item(0)->nodeValue;
            $bedroom = $node->getElementsByTagName("bedroom")->item(0)->nodeValue;
            $address = $node->getElementsByTagName("address")->item(0)->nodeValue;
            $location = $node->getElementsByTagName("location")->item(0)->nodeValue;
            $description = $node->getElementsByTagName("description")->item(0)->nodeValue;
            $image = $node->getElementsByTagName("imageData")->item(0)->nodeValue;
            print "<tr><td rowspan='7' width='10%'><img height='200' width='200' src='" . $image . "'></td></tr>";
            print "<tr><th colspan='2'>" . $title . "</th></tr>";
            print "<tr><td><b>Property ID : </b>" . $node->getAttribute('propertyId') . "</td><td><b>Database : </b>" . $node->getAttribute('db') . "</td></tr>";
            print "<tr><td colspan='2'><b>Address : </b>" . $address . "</td></tr>";
            print "<tr><td colspan='2'><b>Price £: </b>" . $price . "</td></tr>";
            print "<tr><td colspan='2'><b>Location : </b>" . $location . "</td></tr>";
            print "<tr><td colspan='2'><b>No. Bedroom : </b>" . $bedroom . "</td></tr>";
            print "<tr><td colspan='4'><b>Description : </b>" . $description . "</td></tr>";
            print "<tr><td><a class='btn btn-default' href='http://stu-nginx.cms.gre.ac.uk/~me324/sowa/level5/moreInformation.php?propertyId=" . $node->getAttribute('propertyId') . "&db=" . $node->getAttribute('db') . "'>More Information</a></td></tr>";
            print "</table>";
        }
        ?>
    </div>
</body>
</html>
