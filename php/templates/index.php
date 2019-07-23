<html>
     <head>
        <link rel="stylesheet" type="text/css" href="/dbrunner/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <script src="/dbrunner/javascript/border.js"></script>
    </head> 

    <body  onload="expandBorder()">
        <h1 class = "header"> 
            <span class = "desy_blue"><?php echo basename(__DIR__); ?></span><span class = "desy_orange">.</span>          
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
            include "/eos/home-d/dbrunner/www/php/utility.php";

            $dircontent = what_in_dir(".");
            $abspath = dirname(__FILE__);
            
            foreach($dircontent["dir"] as $d){
                $dir = end(explode("/", $d));
                echo "<p><a href='$d/index.php'>$dir</a></p> \n";
            }
            $line = array();

            foreach(array_values($dircontent["png"]) as $index => $d){
                array_push($line, $d);

                if(sizeof($line) == 3 or sizeof($dircontent["png"]) == $index + 1){
                    echo "\t\t <div class = 'titlecontainer'> \n";

                    foreach($line as $ele){
                        $title =  str_replace(".png", " \n", end(explode("/", $ele)));

                        include "/eos/home-d/dbrunner/www/php/templates/title.php";
                        echo "\n";
                    }
            
                    echo "\t\t </div> \n";

                    echo "\t\t <div class = 'picturecontainer'> \n";
            
                    foreach($line as $ele){
                        include "/eos/home-d/dbrunner/www/php/templates/picture.php";
                        echo "\n";
                    }
            
                    echo "\t\t </div> \n";

                    echo "\t\t <div class = 'footcontainer'> \n";
            
                    foreach($line as $ele){
                        include "/eos/home-d/dbrunner/www/php/templates/footer.php";
                        echo "\n";
                    }
            
                    echo "\t\t </div> \n";

                    $line = array();

                }                
            }
        ?>

    </body>
</html>
