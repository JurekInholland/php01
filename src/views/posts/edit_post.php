
<style>

.create_container {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    flex-basis: 100%;
    align-items: stretch;
    align-content: stretch;
    /* height: 800px; */
    min-height: calc(100vh - 56px);
}
.form {
    background-color: rgba(0, 0, 0, .25);
    flex: 6 0 auto;
    /* flex-basis: auto; */
    align-content: stretch;

    display: flex;
    max-width: 100%;
    margin-bottom: 0;
    min-width: 300px;
    /* min-width: 500px; */
    padding: 1rem;
    /* justify-content: center; */
    align-items: center;
}
.form input::placeholder, .form textarea::placeholder {
    color:rgba(255, 255, 255, .55);
}
.form input, .form textarea {
    width: 100%;
    border: none;
    background-color: transparent;
    margin-top: 1rem;
}

.form textarea {
    font-size: 1.25rem;
    color:rgba(255, 255, 255, .85);
    resize: none;
    min-height: 90px;
}

.post_settings {
    background-color: rgba(0, 0, 0, .5);
    flex: 1 1 auto;
    min-width: 200px;
    min-height: 300px;

}
.form img {
/* object-fit: scale-down; */
max-width: 100%;
}
#post_title {
    font-size: 2rem;
    font-weight: bold;
    color:rgba(255, 255, 255, .95);
    margin-bottom: .75rem;
}

.img_container {
    max-width: 850px;
    /* max-height: 700px; */
    overflow: hidden;

}

#droparea {
    /* background-color: rgba(0, 0, 0, .4); */
    display: flex;
    flex: 1 1 auto;
    justify-content: center;
    box-sizing: border-box;
}



.default {
    height: 350px;
    background-color: transparent;
    object-fit: cover;

}
.default_drop {
    border: 3px solid transparent;

}

.drop {
    /* background-color: rgba(0, 0, 0, .4); */
    border-spacing: -12px;
    border: 3px dashed #1BB76E;
}

.has_img {
    background-color: rgba(0, 0, 0, .4);

}

.active {
    object-fit: scale-down;
    height: auto;
    max-height: 500px;


}

@keyframes fadeIn {
  0% { opacity: 0.33; }
  50% { opacity: 0.75;}
  100% {opacity: 0.33;}

}

#image.default {
    animation-name: fadeIn;
    animation-duration: 2.5s;
    animation-iteration-count:infinite;
    animation-timing-function: ease-in;

}
</style>

<?php

if (!empty($post)) {

}



?>

<section class="create_container">
    <form action="/post/submit" method="POST" class="form">
        <input type="hidden" name="post_id" value="<?=$post->getId()?>">
        <section class="img_container">
        <input required id="post_title" type="text" name="title" placeholder="Enter a post title..." <?=$readonly?> value="<?=$post->getTitle()?>">
            <figure id="droparea" class="default_drop">
                <img src="/img/uploadtext2.svg" id="image"  class="default"/>

            </figure>
            <input required id="files" type="file" name="image">
        <textarea required id="description" name="content" placeholder="Add a description..." <?=$readonly?>><?=$post->getContent()?></textarea>
        <input type="submit" name="" class="button is-primary">

        </section>

    </form>

    <section class="post_settings">
        <ul>
            <li>set to private</li>
            <li>download image</li>
            <li>delete post</li>
        </ul>
    </section>
</section>


<script>
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

</script>