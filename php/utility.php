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

    function write_index($d, $n)
    {
        $dircontent = what_in_dir($d);  

        if(!empty($dircontent["dir"])){
            foreach($dircontent["dir"] as $dirName){
                copy("php/templates/index.php", "$dirName/index.php");

                $relativeDir = "../";

                for ($i = 0; $i < $n; $i++) {
                    $relativeDir .= "../";
                }
    
                file_put_contents("$dirName/index.php", str_replace('REPLACE', "$relativeDir", file_get_contents("$dirName/index.php")));
    
                $m = $n + 1;
                write_index("$dirName", $m);
            }
        }
    }
?>
