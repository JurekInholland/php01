
<style>

.create_container {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    flex-basis: 100%;
    align-items: stretch;
    align-content: stretch;
    /* height: 800px; */
    height: calc(100vh - 56px);
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

}
.form img {
    border: none;
    /* height: 500px; */
    object-fit: contain;
    max-width: 100%;
    overflow: hidden;
    max-height: 600px;
}
#post_title {
    font-size: 2rem;
    font-weight: bold;
    color:rgba(255, 255, 255, .85);
    margin-bottom: .75rem;
}

.img_container {
    max-width: 850px;
    /* max-height: 700px; */
    overflow: hidden;

}

#droparea {
    background-color: rgba(0, 0, 0, .4);
    display: flex;
    flex: 1 1 auto;
    justify-content: center;
}
.default {
    height: 500px;
    background-color: transparent;
    /* max-width: 350px;
    max-height: 350px; */
    /* border: 2px dashed red; */

}

.drop {
    border-spacing: -12px;
    border: 3px dashed red;
}
</style>



<section class="create_container">
    <form action="" class="form">
        <section class="img_container">
        <input id="post_title" type="text" name="title" placeholder="Enter a post title...">
            <figure id="droparea">
                <img src="/img/uploadtext.svg" id="image"  class="default"/>

            </figure>
            <input id="files" type="file" name="image">
        <textarea id="description" name="content" placeholder="Add a description..."></textarea>

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
        console.log(e);

        displayImage(e);
    };

    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);

};

function displayImage(e) {
    image.src = e.target.result;
    image.classList.remove("default");
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