<html>
     <head>
        <link rel="stylesheet" type="text/css" href="style.css">

        <script src="javascript/border.js"></script>
    </head> 

    <body  onload="expandBorder()">
        <h1 class = "header"> 
            <span class = "desy_blue">David's webpage</span><span class = "desy_orange">.</span>         
        </h1>

        <div class = "bordercontainer", id ="border">
            <div class = "borderline">
                <hr class = "header"></hr> 
            </div>

            <div class = "bordercirle">
                <span class="header"></span>   
            </div>
        </div>

        <?php
            include "php/utility.php";
            $dircontent = what_in_dir("Plots");         
            $abspath = dirname(__FILE__);
            
            foreach($dircontent["dir"] as $d){
                write_index("$abspath/$d");
                $dir = end(explode("/", $d));

                echo "<p><a href='$d/index.php'>$dir</a></p> \n";
            }
        ?>
    </body>
</html>
