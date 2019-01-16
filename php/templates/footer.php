            <div class = "foot"> 
                <div class="footcontent">
                    <span>png format: </span> 
                    
                    <a href="<?php echo $ele; ?>" download>
                        <i class="fa fa-download"></i>
                    </a>
                </div>

                <div class="footcontent">
                    <span>pdf format: </span> 
                    
                    <a href="<?php echo str_replace("png", "pdf", $ele);; ?>" download>
                        <i class="fa fa-download"></i>
                    </a>
                </div>
            </div>
