function expandBorder(){
    var border = document.getElementById("border");
    var length = 3.0;
    var length_string = "";

    var id = setInterval(moveBorder, 1);

    function moveBorder(){
        if(border.style.width == "100%"){
            clearInterval(id);
        }
        
        else{
            length += 0.1;
            length_string = length.toString() + "%";

            border.style.width = length_string;
            console.log(length);
        }
    }
}
