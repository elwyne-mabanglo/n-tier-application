<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Service Oriented Web Applications</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src='https://code.responsivevoice.org/responsivevoice.js'></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="common/css.css" rel="stylesheet" type="text/css"/>
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
            <div class="row">
                <div class="col-sm-12">
                    <h3>
                        <a href="http://stu-nginx.cms.gre.ac.uk/~me324/sowa/level1/level1.php">Level 1 : XML</a>
                    </h3>
                    <p></p>
                    <div id="Level 1">                    
                        <p>
                            Design an XML language HAML that can be used to describe holiday accommodation
                            information. Create example XML documents with DTD and XML Schema files that can
                            validate these documents. Your design should be able to support lists of many properties with
                            few details and full details of a single property, including the contact details of the property
                            owner and images of the property. Consider how you will handle images in your design.
                        </p>
                        <p>
                            Note: Your XML schema should reflect a view of your databases rather than reproduce the
                            schema of your databases. Databases and XML files require rather different approaches to
                            data modelling and storage. How can you make effective use of XML attributes? Handling of
                            XML attributes in a database is not obvious, nor is handling relationships in XML. Do not
                            forget to include your DTD, XSD and example HAML files in your final report.
                        </p>
                    </div>
                </div>
                <div class="col-sm-12">
                    <h3>
                        <a href="http://stuiis.cms.gre.ac.uk/me324/sowa/level2/level2Scaffolding.php">Level 2 : .NET web services</a>
                    </h3>
                    <p></p>
                    <div id="Level 2">
                        <p>
                            Implement a database containing holiday accommodation offered in the Shoreham and
                            Worthing areas using the Microsoft SQL Server RDBMS provided by the department. This
                            data is to be made available as a number of .NET web methods using C# running from the
                            Microsoft IIS web server provided by the department. Your web services should implement
                            queries that accept search terms such as location, property id, property type (apartment, house,
                            villa, etc.), number of beds, price, keyword and so on, and return results in the form of a brief
                            format list of matches or full details of a single item, using the HAML language you created
                            in level 1.
                        </p>
                        <p>
                            Note: These web services should be able to cope with substring matches. Visual Studio
                            usually defaults to SOAP transport only (configuration dependant), which is a less than
                            optimal transport for XML data, and the scaffolding generated by Visual Studio will be of
                            little use to you. Testing and further levels will be significantly more straightforward if you
                            enable POST, GET and SOAP transports (Web.Config). Consider how your services will scale
                            with many thousands or millions of items in your database. Consider how your results may be
                            sorted.
                        </p>
                    </div>
                </div>
                <div class="col-sm-12">
                    <h3>
                        <a href="http://stuweb.cms.gre.ac.uk/~me324/sowa/level3/level3Scaffolding.php">Level 3 : PHP web services</a>
                    </h3>
                    <p></p>
                    <div id="Level 3">
                        <p>
                            Repeat level 2 for holiday accommodation in the Brighton and Hove areas using PHP running
                            from the Apache HTTP server and MySQL RDBMS provided by the department. While 
                            Visual Studio automatically generates scaffolding forms to test your .NET services you will
                            need to create scaffolding forms yourself to test your PHP services.
                        </p>
                        <p>
                            Note: This could be implemented using either SOAP or REST (you may wish to attempt both)
                            but it is not so easy to create interoperable SOAP services using PHP. Future levels will be
                            simpler if you create REST services and follow a similar approach to your .NET services.
                        </p>
                    </div>
                </div>
                <div class="col-sm-12">
                    <h3>
                        <a href="http://stu-nginx.cms.gre.ac.uk/~me324/sowa/level4/level4Scaffolding.php">Level 4 : Portal search</a>
                    </h3>
                    <p></p>
                    <div id="Level 4">
                        <p>
                            Using PHP running from the Nginx HTTP server provided by the department (not Apache, not
                            IIS) implement a means by which a single search for an property returns results from both
                            your .NET (Worthing and Shoreham) and your PHP (Hove and Brighton) web services
                            merged into a single XML document (where there are multiple results). You will need to
                            create scaffolding forms to demonstrate this search. Make sure that you have suitably similar
                            but different entries in your two databases so that you are able to easily demonstrate a search
                            that returns results merged from both databases.
                        </p>
                        <p>
                            Note: This level returns XML (HAML) and not a web page. The Nginx server has no database
                            connection capability. This portal obtains its data from the services you created in levels 2 and
                            3. This could be coded with loops and print statements but you are advised to use DOM
                            programming.
                        </p>
                    </div>

                </div>
                <div class="col-sm-12">
                    <h3>
                        <a href="http://stu-nginx.cms.gre.ac.uk/~me324/sowa/level5/level5.php">Level 5 : Portal result display</a>
                    </h3>
                    <p></p>
                    <div id="Level 5">
                        <p>
                            Extend, but do not replace, your solution to level 4 to create a holiday accommodation portal
                            website running from the Nginx server. A typical search should return a brief format list,
                            suitably displayed using DHTML with pagination to limit results to 10 or so results per page.
                            Each list format result should allow the user to click to see full details of the item including
                            pictures where available.
                        </p>
                        <p>
                            Note: Think of the merged services you implemented in level 4 as a data source, much the
                            same as a 3-tier architecture, except in this case the data arrives from your distributed
                            services. The user may wish the results to be sorted, for example, by date or location. It will
                            assist development and demonstration of your work if you include links from this site to all
                            other levels.
                        </p>
                    </div>
                </div>
                <div class="col-sm-12">
                    <h3><a href="http://stu-nginx.cms.gre.ac.uk/~me324/sowa/level6/level6.php">Level 6 : XSLT</a></h3>
                    <p></p>
                    <div id="Level 6">
                        <p>
                            Re-create level 5 using XSLT to transform your HAML documents into DHTML pages
                            similar to the pages you created in Level 5. Provide examples to demonstrate your XSLT
                            using both client-side and server-side XSLT processing.
                        </p>
                        <p>
                            Note: Server side XSLT does not necessarily need to render the entire page. Images should be
                            included but may be referred to by ID or URL in the XML, much the same as an image
                            element in XHTML You will find this easier if you develop using server-side XSLT
                            processing so that you can easily see and validate the resulting markup. Do not forget to
                            include your XSLT file in your report. Provide links (from the level 5 site) to allow rapid
                            demonstration of both client and server side XSLT processing. Client side processing could be
                            implemented by embedding a processing directive into the XML or using a JavaScript XSLT
                            processor.
                        </p>
                    </div>
                </div>
                <div class="col-sm-12">
                    <h3><a href="http://stu-nginx.cms.gre.ac.uk/~me324/sowa/level7/level7.php">Level 7 : Ajax portal</a></h3>

                    <p></p>
                    <p>
                        Use asynchronous partial page update (AJAX) techniques to enhance the portal you created in
                        level 5/6. There are a number of ways that AJAX could be used, for example; asynchronous
                        loading of search results could increase the response speed to the user, locations could interact
                        asynchronously with a map display.
                    </p>
                    <p>
                        Note: Do not replace your implementation of levels 5 or 6 when implementing this level.
                        Client side XSLT could be used to provide full or partial page rendering
                    </p>
                </div>
                <div class="col-sm-12">
                    <h3><a href="http://stu-nginx.cms.gre.ac.uk/~me324/sowa/level8/level8.php">Level 8 : JSON</a></h3>
                    <p></p>
                    <p>
                        Extend your solutions to levels 2, 3 and 6 to create a JSON based solution. You will need to
                        create scaffolding forms to demonstrate these services. Extend (do not replace) your
                        implementation of previous levels to provide search results merged from both databases.
                    </p>
                    <p>
                        Note: you may wish to create a purely JSON solution or translate your XML to JSON
                    </p>
                </div>
                <div class="col-sm-12">
                    <h3><a href="http://stu-nginx.cms.gre.ac.uk/~me324/sowa/level9/level9.php">Level 9 : Mobile</a></h3>
                    <p></p>
                    <p>
                        Extend your portal to operate effectively on a smart phone. Consider ways in which smart
                        phone technology such as geolocation could add value to your portal.
                    </p>
                    <p>
                        Note: This could be achieved as either a web page (XHTML 1.1 or HTML 5) that will operate
                        on all smart phones but not have access to all device capability, or as a mobile app which can
                        provide access to device capability but is not cross platform (unless Ionic, Cordova or similar
                        is used).
                    </p>
                </div>
                <div class="col-sm-12">
                    <h3>Level 10 : Report</h3>
                    <p></p>
                    <p>
                        A brief report describing your implementation of levels 1 to 9, as detailed in the following
                        section under ‘Deliverables A’.
                    </p>
                    <p>
                        Note: This report should contain sufficient information to allow another developer to
                        understand and maintain your work.
                    </p>
             
                </div>
            </div>
        </div>
    </body>
</html>
