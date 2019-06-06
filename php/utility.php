<?php
    function what_in_dir($dir){
        $dirls = scandir($dir);

        $dirs = array();
        $pngs = array();
        $pdfs = array();

        foreach($dirls as $d){
           
            if($d == "." or $d == ".." or $d == "index.php"){
                continue;
            }

            else{
                $d = "$dir/$d";

                if(is_dir($d)){
                    array_push($dirs, $d);
                }

                else if(is_file($d)){
                    if(strpos($d, "png") !== false){
                        array_push($pngs, $d);
                    }            
                }
            }     
        }

        $dircontent = array("dir" => $dirs, "png" => $pngs);

        return $dircontent;
    }

    function write_index($d)
    {
        $dir = realpath($d);    
        copy("/eos/home-d/dbrunner/www/php/templates/index.php", "$dir/index.php");
    }
    
    function hello(){
        echo "hello";
    }
?>
