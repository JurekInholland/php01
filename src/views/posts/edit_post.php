
<style>

.create_container {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    flex-basis: 100%;
    align-items: stretch;
    align-content: stretch;
    /* height: 800px; */
    min-height: calc(100vh - 52px);
}

.form {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    align-content: stretch;
    width: 100%;
    margin-bottom: 0;


}

.main {
    background-color: rgba(0, 0, 0, .25);
    flex: 6 1 auto;
    /* flex-basis: auto; */
    align-content: stretch;

    display: flex;
    max-width: 100%;
    margin-bottom: 0;
    min-width: 300px;
    /* min-width: 500px; */
    padding: 1rem;
    justify-content: center;
    /* align-items: center; */
}
.main input::placeholder, .main textarea::placeholder {
    color:rgba(255, 255, 255, .55);
}
.main input, .main textarea {
    width: 100%;
    border: none;
    background-color: transparent;
    margin-top: 1rem;
}

.main textarea {
    font-size: 1.25rem;
    color:rgba(255, 255, 255, .85);
    resize: none;
    min-height: 90px;
    background-color: rgba(0, 0, 0, .25);
    border-radius: 5px;
    padding: .5rem;
}

.post_settings {
    background-color: rgba(0, 0, 0, .5);
    flex: 1 1 auto;
    min-width: 200px;
    min-height: 100px;
}

.post_settings a {
    font-weight: normal;
}

.post_settings ul {
    list-style-type: disc;
    list-style-position: inside;
    margin-left: .5rem;
}
.main img {
/* object-fit: scale-down; */
max-width: 100%;
}
#post_title {
    font-size: 2rem;
    font-weight: bold;
    color:rgba(255, 255, 255, .95);
    margin-bottom: .75rem;
    margin-top: 0;
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

#image {
    max-height: 60vh;
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

if (!empty($post->getImage()->getExtension())) {
    $image = $post->getImage()->getLink();
    $class = "";
    $fileInput = false;
} else {
    $image = "/img/uploadtext2.svg";
    $class = "default";
    $fileInput = true;
}


?>

<section class="create_container">
    <form action="/post/submit" method="POST" class="form" enctype="multipart/form-data">
    <section class="main">

        <input type="hidden" name="post_id" value="<?=$post->getId()?>">
        <section class="img_container">
        <input required id="post_title" type="text" name="title" placeholder="Enter a post title..." <?=$readonly?> value="<?=$post->getTitle()?>">
            <figure id="droparea" class="default_drop">

                <img src="<?=$image?>" id="image"  class="<?=$class?>"/>

            </figure>

            <?php if ($fileInput) : ?>
                <input required id="files" type="file" name="image">

            <?php endif; ?>

        <textarea required id="description" name="content" placeholder="Add a description..." <?=$readonly?>><?=$post->getContent()?></textarea>
        <input type="submit" name="" class="button is-primary">
        </section>

    </section>


    <section class="post_settings">
        <ul>
            <li>
                <label class="checkbox">
                <input type="checkbox">
                    Make private
                </label>
            </li>
            <li>
                <a class="not-active" href="<?=$post->getImage()->getLink()?>">Download image</a>
            </li>
            <li>
                <a href="/post/delete?id=<?=$post->getId()?>">Delete post</a>
            </li>
        </ul>
    </section>
</section>
</form>
<script src='/js/image_upload.js'></script>


