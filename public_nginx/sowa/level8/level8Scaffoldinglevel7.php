<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Service Oriented Web Applications</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link href="../common/css.css" rel="stylesheet" type="text/css"/>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
            // Reset fields
            function reset() {
                document.getElementById("bedroom").value = '';
                document.getElementById("location").value = '';
                document.getElementById("min").value = '1';
                document.getElementById("max").value = '100000000';
                document.getElementById("propertyId").value = '';
                document.getElementById("pageNumber").value = '1';
                document.getElementById('sortby').value = 'title';
                document.getElementById('orderby').value = 'ascending';
                document.getElementById('pageSize').value = '10';   
                query();
            }

            // AJAX - https://www.w3schools.com/php/php_ajax_php.asp
            function query() {
                var bedroom = document.getElementById("bedroom").value;
                var location = document.getElementById("location").value;
                var min = document.getElementById("min").value;
                var max = document.getElementById("max").value;
                var sortby = document.getElementById("sortby").value;
                var orderby = document.getElementById("orderby").value;
                var propertyId = document.getElementById("propertyId").value;
                var pageNumber = document.getElementById("pageNumber").value;
                var pageSize = document.getElementById("pageSize").value;
                
                // Create XMLHttpRequest object
                var xmlhttp = new XMLHttpRequest();
                
                // Process results
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {

                        var obj = JSON.parse(xmlhttp.responseText);
                        
                        // Disable or enable next button
                        if(obj.properties.length == 0){
                             document.getElementById("next").className = "glyphicon glyphicon-forward btn btn-default btn-sm disabled";
                        } else {
                            document.getElementById("next").className = "glyphicon glyphicon-forward btn btn-default btn-sm";
                        }
                        
                        // Disable or enable previous button
                        if(pageNumber == 1){
                             document.getElementById("previous").className = "glyphicon glyphicon-backward btn btn-default btn-sm disabled";
                        } else {
                            document.getElementById("previous").className = "glyphicon glyphicon-backward btn btn-default btn-sm";
                        }

                        var html = "";
                        
                        // print results
                        for (var i = 0, len1 = obj.properties.length; i < len1; i++) {
                            var p = obj.properties[i];
                            html += `
                            <table class='table'>     
                            <tr><td rowspan='7' width='10%'><img height='200' width='200' src='${p.images[0].imageData}'></td></tr>
                            <tr><th colspan='2'>${p.title}</th></tr>
                            <tr><td><b>Property ID : </b>${p.propertyId}</td><td><b>Database : </b>${p.db}</td></tr>
                            <tr><td colspan='2'><b>Address : </b>${p.address}</td></tr>
                            <tr><td colspan='2'><b>Price £: </b>${p.price}</td></tr>
                            <tr><td colspan='2'><b>Location : </b>${p.location}</td></tr>
                            <tr><td colspan='2'><b>No. Bedroom : </b>${p.bedroom}</td></tr>
                            <tr><td colspan='4'><b>Description : </b>${p.description}</td></tr>  
                            <tr><td><button type='button' class='btn btn-default' id='${p.db}' onclick='moreInformation(${p.propertyId},"${p.db}");'>More Information!</button></td></tr>
                            </table>`;                                  
                        }
                        document.getElementById("invoice").innerHTML = html;
                    }
                };
                
                // Send request
                xmlhttp.open("GET", "http://stu-nginx.cms.gre.ac.uk/~me324/sowa/level8/level8getData.php?bedroom=" + bedroom
                        + "&min=" + min + "&max=" + max + "&location=" + location + "&pageNumber=" + pageNumber + "&sortby=" + sortby + "&orderby=" + orderby + "&pageSize=" + pageSize + "&propertyId=" + propertyId, true);
                xmlhttp.send();
            }

            // Slider - https://jqueryui.com/slider/#range
            $(function () {
                $("#slider-range").slider({
                    range: true,
                    min: 1,
                    max: 100000000,
                    values: [1, 100000000],
                    slide: function (event, ui) {
                        query();
                        $("#min").val(ui.values[ 0 ]);
                        $("#max").val(ui.values[ 1 ]);
                        $("#amount").val("Â£" + ui.values[ 0 ] + " - Â£" + ui.values[ 1 ]);
                    }
                });
                $("#amount").val("£" + $("#slider-range").slider("values", 0) + " - Â£" + $("#slider-range").slider("values", 1));
                $("#min").val($("#slider-range").slider("values", 0));
                $("#max").val($("#slider-range").slider("values", 1));
            });

            // Get next page
            function next() {
                var value = parseInt(document.getElementById('pageNumber').value, 10);
                value = isNaN(value) ? 0 : value;
                value++;
                document.getElementById('pageNumber').value = value;
                query();
            }

            // Get previous page
            function previous() {
                var value2 = parseInt(document.getElementById('pageNumber').value, 10);
                value2 = isNaN(value2) ? 0 : value2;
                value2--;

                if (value2 == 0) {
                    value2 = 1;
                }
                document.getElementById('pageNumber').value = value2;
                query();
            }

            // Get more information content 
            function moreInformation(a, b) {
                location.replace("http://stu-nginx.cms.gre.ac.uk/~me324/sowa/level8/level8MoreInformationLevel7.php?propertyId=" + a + "&db=" + b);               
            }          
        </script>
        <style>
            .outerPad { top: 10px;  }
            .innerPad { padding:10px; }
        </style>
    </head>
    <body onload="query();">
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
                                <li><a href="http://stu-nginx.cms.gre.ac.uk/~me324/sowa/level5/level5.php">Level 5 : Portal result display</a></li>
                                <li><a href="http://stu-nginx.cms.gre.ac.uk/~me324/sowa/level6/level6.php">Level 6 : XSLT</a></li>
                                <li><a href="http://stu-nginx.cms.gre.ac.uk/~me324/sowa/level7/level7.php">Level 7 : Ajax portal</a></li>
                                <li class="active"><a href="http://stu-nginx.cms.gre.ac.uk/~me324/sowa/level8/level8.php">Level 8 : JSON</a></li>
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
            <div class="row">
                <div class="col-sm-12">
                    <h3>Level 8 : JSON - Extended Solution to Level 7 <button data-toggle="collapse" data-target="#demo" class="btn btn-default btn-sm">Advance Search</button></h3>
                    <div id="demo" class="collapse">
                        <form action=""> 
                            <div class="row">
                                <div class="col-sm-4 innerPad">
                                    <label for="propertyId">Property ID:</label>
                                    <input type="number" class="form-control" id="propertyId" name="propertyId" onkeyup="query()" autocomplete="off">
                                </div>
                                <div class="col-sm-4 innerPad">
                                    <label for="bedroom">Bedroom:</label>
                                    <input type="number" class="form-control" id="bedroom" name="bedroom" onkeyup="query()" autocomplete="off">
                                </div>
                                <div class="col-sm-4 innerPad">
                                    <label for="location">Location:</label>
                                    <input type="text" class="form-control" id="location" name="location" onkeyup="query()" autocomplete="off">
                                </div>

                                <div class="col-sm-4 innerPad">
                                    <label for="min">Min Â£:</label>
                                    <input type="number" class="form-control" id="min" name="min" onchange="query()" autocomplete="off">
                                </div>
                                <div class="col-sm-4 innerPad">
                                    <label for="max">Max Â£:</label>
                                    <input type="number" class="form-control" id="max" name="max" onchange="query()" autocomplete="off">
                                </div>
                                <div class="col-sm-4 innerPad">
                                    <label for="amount">Price Range:</label>
                                    <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
                                    <div id="slider-range"></div>
                                </div>
                            </div>
                            <div class="form-group hidden">
                                <label for="pageNumber">Page Number:</label>
                                <input type="text" class="form-control" id="pageNumber" name="pageNumber" onchange="query()" value="1">
                            </div>                
                        </form>
                    </div>
                </div>
                <div class="col-sm-4 innerPad">
                    <label for="sortby">Sort By:</label>
                    <select name="sortby" class="form-control" id="sortby" onchange="query()">
                        <option value="title" selected>Title</option>
                        <option value="propertyId">Property ID</option>
                        <option value="price">Price</option>
                        <option value="bedroom">Bedroom</option>
                    </select>
                </div>
                <div class="col-sm-4 innerPad">
                    <label for="orderby">Order By:</label>
                    <select name="orderby" class="form-control" id="orderby" onchange="query()">
                        <option value="ascending" selected>Ascending</option>
                        <option value="descending">Descending</option>
                    </select>
                </div>
                <div class="col-sm-4 innerPad">
                    <label for="pageSize">Page Size:</label>
                    <select name="pageSize" class="form-control" id="pageSize" onchange="query()" >
                        <option value="10" selected>10</option>
                        <option value="20">20</option>
                    </select>
                </div>
                <div class="col-sm-12 innerPad">
                    <span id="previous" class="glyphicon glyphicon-backward btn btn-default btn-sm"onclick="previous();"> Previous</span>
                    <span id="next" class="glyphicon glyphicon-forward btn btn-default btn-sm" onclick="next();"> Next</span>
                    <span class="glyphicon glyphicon-refresh btn btn-default btn-sm" onclick="reset();"> Reset</span>
                </div>
                <div class="col-sm-12 innerPad">
                    <span id="invoice"></span>
                </div>
            </div>
        </div>
    </body>
</html>