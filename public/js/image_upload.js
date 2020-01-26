document.getElementById("files").onchange = function () {
    var reader = new FileReader();

    reader.onload = function (e) {

        displayImage(e);
    };

    // reader.readAsDataURL(this.files[0]);

    // read the image file as a data URL.
    try {
        reader.readAsDataURL(this.files[0]);

    // If open file dialog was canceled
    } catch(TypeError) {
        if (files.files.length == 0) {
            image.src = "/img/uploadtext2.svg";
            droparea.classList.remove("has_img");
            image.classList.remove("active");
            image.classList.add("default");

        }

    }

};

function displayImage(e) {
    image.src = e.target.result;
    image.classList.remove("default");
    image.classList.add("active");
    
    // image.classList.remove("default");
    droparea.classList.add("has_img");
}

image.ondragover = image.ondragenter = function(evt) {
  evt.preventDefault();
  droparea.classList.add("drop");
};

image.ondragleave = function(evt) {
    evt.preventDefault();
    droparea.classList.remove("drop");
}


post_title.ondrop = description.ondrop = function(evt) {
    evt.preventDefault();
}

image.ondrop = function(evt) {
    files.files = evt.dataTransfer.files;
    evt.preventDefault();
    droparea.classList.remove("drop");
    var event = new Event('change');
    files.dispatchEvent(event);
// Dispatch it.

};