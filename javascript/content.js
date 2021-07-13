function getLowestDir(dir){
    var splittedDir = dir.split("/");
    return splittedDir[splittedDir.length - 1];
}

function getPngName(png){
    var pngName = getLowestDir(png);
    return pngName.split(".png")[0];
}

function showContent(dirName){
    //Get div and icon associated and already created for the wished directory
    var motherDiv = document.getElementById("div." + dirName.replaceAll("/", "."));
    var dirIcon = document.getElementById("icon." + dirName.replaceAll("/", "."));

    //If already clicked before, check if directory content should be shown or hidden
    if(dirIcon){
        dirIcon.className = "fas fa-folder-open";
    }

    if(motherDiv.getAttribute("isLoaded")){  
        if(motherDiv.style.display == "block"){
            motherDiv.style.display = "none";
            dirIcon.className = "fas fa-folder";
        }

        else if(motherDiv.style.display == "none"){
            motherDiv.style.display = "block";
            dirIcon.className = "fas fa-folder-open";
        }

        return;
    }
    
    //AJAX request to get content of wished directory
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function(){
        //Variable to get right off side for directory hierachy
        var layer = parseInt(motherDiv.getAttribute("layer"));

        //Response from server        
        var content = JSON.parse(this.responseText);

        //Header for directory div
        if(content["dir"].length != 0){
            var header = document.createElement('h3');
            header.innerHTML = "Directories in " + getLowestDir(dirName);
            header.style.marginLeft = layer*10 + "px";
            motherDiv.append(header);
        }

        //Loop over all subdirectories in directories 
        for (const dir of content["dir"]){
            //P element in which clickable button is placed
            var p = document.createElement('p');
            p.style.display = "flex";
            p.style.marginLeft = layer*10 + "px";

            //Div for subdirectory content if corresponding button will be clicked later
            var contentDiv = document.createElement('div');
            contentDiv.id = "div." + dir.replaceAll("/", ".");
            contentDiv.setAttribute("layer", layer + 1);
            contentDiv.style.marginLeft = layer*10 + "px";

            //Div containing current subdir name
            var dirNameDiv = document.createElement('div');
            dirNameDiv.innerHTML = getLowestDir(dir);
            dirNameDiv.style.marginTop = "5px";

            //Folder icon for button
            var icon = document.createElement('i');
            icon.id = "icon." + dir.replaceAll("/", ".");
            icon.className = "fas fa-folder";
            icon.style.fontSize = "24px";

            //Clickable button which will call this function for this subdirectory
            var button = document.createElement('button');
            button.id = "button." + dir.replaceAll("/", ".");
            button.setAttribute("onclick", "showContent('" + dir + "')");
            button.style.marginRight = "10px";
            button.appendChild(icon);

            //Proper placement of everything
            p.appendChild(button);
            p.appendChild(dirNameDiv);
            motherDiv.appendChild(p);
            motherDiv.appendChild(contentDiv);
        }

        //Header for plots
        if(content["png"].length != 0){
            var header = document.createElement('h3');
            header.innerHTML = "Plots in " + getLowestDir(dirName);
            header.style.marginLeft = layer*10 + "px";
            motherDiv.append(header);
        }

        //Flex containers to place 3 titles/plots in one line
        var pictureContainer = document.createElement('div');
        pictureContainer.className = "picturecontainer";
        pictureContainer.style.marginLeft = layer*10 + "px";

        var titleContainer = document.createElement('div');
        titleContainer.className = "titlecontainer";
        titleContainer.style.marginLeft = layer*10 + "px";

        //Loop over all plots in directory
        for (const png of content["png"]){
            //If three plots in container, place into mother div
            if(pictureContainer.childElementCount == 3){
                motherDiv.appendChild(titleContainer);
                motherDiv.appendChild(pictureContainer);

                var pictureContainer = document.createElement('div');
                pictureContainer.className = "picturecontainer";
                pictureContainer.style.marginLeft = layer*10 + "px";

                var titleContainer = document.createElement('div');
                titleContainer.className = "titlecontainer";
                titleContainer.style.marginLeft = layer*10 + "px";
            }

            //Div for plot title
            var titleDiv = document.createElement('div');
            titleDiv.innerHTML = getPngName(png);
            titleDiv.className = "title";

            //Div for img
            var pictureDiv = document.createElement('div');
            pictureDiv.className = "picture";

            //Image itself
            var img = document.createElement('img');
            img.setAttribute("src", png);
            img.setAttribute("alt", png);
            img.setAttribute("height", "100\%");
            img.setAttribute("width", "100\%");

            //Proper placement of everything
            titleContainer.appendChild(titleDiv);
            pictureDiv.appendChild(img);
            pictureContainer.appendChild(pictureDiv);
        }

        //Place last container if not empty
        if(pictureContainer.childElementCount != 0){
            motherDiv.appendChild(titleContainer);
            motherDiv.appendChild(pictureContainer);
        }

        //Set bool to tell browser the content of this dir is already loaded
        motherDiv.setAttribute("isLoaded", true);
        motherDiv.style.display = "block";
    }

    //Send AJAX request to php file on server to get dir content
    xmlhttp.open("GET", "/php/ajax/whatInDir.php?dir=" + dirName);
    xmlhttp.send();
}
