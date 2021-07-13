<?php
    function whatInDir($rootDir, $dir){
        $dirls = scandir("$rootDir/$dir");

        $dirs = array();
        $pngs = array();
        $pdfs = array();

        foreach($dirls as $d){           
            if($d == "." or $d == ".."){
                continue;
            }

            else{
                $d = "$dir/$d";

                if(is_dir("$rootDir/$d")){
                    array_push($dirs, $d);
                }

                else if(is_file("$rootDir/$d")){
                    if(strpos($d, "png") !== false){
                        array_push($pngs, $d);
                    }            
                }
            }     
        }

        $dircontent = array("dir" => $dirs, "png" => $pngs);

        return $dircontent;
    }
?>
