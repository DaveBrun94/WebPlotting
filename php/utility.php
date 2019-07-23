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
        $dircontent = what_in_dir($dir);  

        if(!empty($dircontent["dir"])){
            foreach($dircontent["dir"] as $dirName){
                $dirName = realpath($dirName); 
                copy("/eos/home-d/dbrunner/www/php/templates/index.php", "$dirName/index.php");
                write_index("$dirName");
            }
        }
    }
?>
