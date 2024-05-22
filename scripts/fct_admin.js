var input = document.getElementById("image");
var preview = document.getElementById("preview");


input.addEventListener("change", updateImageDisplay);

function updateImageDisplay() {
    while (preview.firstChild) {
      preview.removeChild(preview.firstChild);
    }
  
    var curFiles = input.files;
    
    if (curFiles.length === 0) {
      var para = document.createElement("p");
      
      preview.appendChild(para);
    } 
    else {
      var list = document.createElement("ol");
      preview.appendChild(list);
      for (var i = 0; i < curFiles.length; i++) {
        var listItem = document.createElement("li");
        var para = document.createElement("p");
        if (validFileType(curFiles[i])) {
          para.textContent = "Taille " + returnFileSize(curFiles[i].size) +".";
          var image = document.createElement("img");
          image.src = window.URL.createObjectURL(curFiles[i]);
          image.width = 100; // Taille de l'image
          image.height = 100; // Taille de l'image
          listItem.appendChild(image);
          listItem.appendChild(para);
        } 
        else {
          para.textContent ="Nom du fichier " +curFiles[i].name +": Fichier non valide , Veuillez réessayer";
          listItem.appendChild(para);
        }
  
        list.appendChild(listItem);
      }
    }
  }


  var fileTypes = ["image/jpeg", "image/pjpeg", "image/png"];

function validFileType(file) {
  for (var i = 0; i < fileTypes.length; i++) {
    if (file.type === fileTypes[i]) {
      return true;
    }
  }

  return false;
}

function returnFileSize(number) {
    if (number < 1024) {
      return number + " octets";
    } else if (number >= 1024 && number < 1048576) {
      return (number / 1024).toFixed(1) + " Ko";
    } else if (number >= 1048576) {
      return (number / 1048576).toFixed(1) + " Mo";
    }
  }
  


