<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb">
    <head>
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
        <script>
            $(function () {
                $("#slider-range").slider({
                    range: true,
                    min: 1,
                    max: 100000000,
                    values: [1, 100000000],
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
                                <li class="active"><a href="http://stuweb.cms.gre.ac.uk/~me324/sowa/level3/level3Scaffolding.php">Level 3 : PHP web services</a></li>
                                <li><a href="http://stu-nginx.cms.gre.ac.uk/~me324/sowa/level4/level4Scaffolding.php">Level 4 : Portal search</a></li>
                                <li><a href="http://stu-nginx.cms.gre.ac.uk/~me324/sowa/level5/level5.php">Level 5 : Portal result display</a></li>
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
            <h3>Level 3 : PHP web services</h3>
            <form method="post" action="level3RetrieveData.php" target="_blank">
                <div class="form-group">
                    <label for="bedroom">Bedroom:</label>
                    <input type="number" class="form-control" id="bedroom" name="bedroom">
                </div>
                <div class="form-group">
                    <label for="location">Location:</label>
                    <input type="text" class="form-control" id="location" name="location">
                </div>
                <div class="form-group">
                    <label for="min">Min £:</label>
                    <input type="number" class="form-control" id="min" name="min">
                </div>
                <div class="form-group">
                    <label for="max">Max £:</label>
                    <input type="number" class="form-control" id="max" name="max">
                </div>
                <div class="form-group">
                    <p>
                        <label for="amount">Price Range:</label>
                        <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
                    </p>
                    <div id="slider-range"></div>
                </div>
                <div class="form-group">
                    <label for="pageSize">Page Size:</label>
                    <input type="number" class="form-control" id="pageSize" name="pageSize" value="10">
                </div>
                <div class="form-group">
                    <label for="pageNumber">Page Number:</label>
                    <input type="number" class="form-control" id="pageNumber" name="pageNumber" value="1">
                </div>
                <div class="form-group">
                    <label for="propertyId">Property ID:</label>
                    <input type="number" class="form-control" id="max" name="propertyId">
                </div>
                <button type="submit" class="btn btn-default" name="search">Submit</button>
            </form>
        </div>
    </body>
</html>
