<style>

.post_container {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
    min-height: calc(100vh - 56px);
}

.post {
    margin-top: 3rem;
    margin-bottom: 1rem;
    background-color: rgba(255, 255, 255, .15);
    border-radius: 3px;
    width: 90%;
    min-width: 300px;
    max-width: 728px;
}

body {
    background: #141518;
}

.navbar {
    background-color: rgba(255, 255, 255, .15);
}

.post_details {
    display: flex;
    flex-direction: column;
    padding: 1.5rem;
    max-width: 77%;
}

.post_content {
    padding: 1.5rem;
    display: flex;
    flex-direction: row;
    /* align-items: flex-end; */
    justify-content: space-between;
}

.post_content span {
    /* width: 100%; */
}

.post_content a {
    /* font-weight: normal; */
    font-size: .85rem;
}

.post_title {
    font-size: 1.15rem;
}

.post_author {
    font-size: .75rem;
    opacity: .75;
}

.post_author a {
    padding-right: .5rem;
}

.image_container img {
    max-width: 100%;
    max-height: 69vh;
}

.comment_form {
    width: 100%;
    background-color: rgba(255, 255, 255, .15);
    border: 2px solid #53555b;
    border-radius: 5px;
    padding: 1rem;
}

.comment_form textarea {

    background-color: transparent;
    min-height: 70px;
    border: 0;
    resize: none;
    color: white;
    font-size: 1.1rem;

}

.comment_form input {
    position: relative;
    width: 80px;
    height: 40px;
    align-self: flex-end;
    top: 0;
    border: 0;
    background-color: #6C6C6C;
    color: #ddddd1;
}



</style>

<section class="post_container">

    <section class="post">
        <section class="post_details">

            <span class="post_title"><?=$post->getTitle()?></span>
            <span class="post_author">
                by <a href="/user?name=<?=$post->getAuthor()->getName()?>"><?=$post->getAuthor()->getName()?></a>
                <?=$post->getDate()?>
            </span>
        </section>
        <figure class="image_container">
            <img src="<?=$post->getImage()->getLink()?>" alt="">
        </figure>

        <section class="post_content">
            <span>
                <?=$post->getContent()?>
            </span>
            <a href="#">Edit</a>
        </section>



    

    </section>


    <section class="comment_area">

        <form action="/comment/submit" method="POST" class="comment_form">
            <input type="hidden" name="post_id" value="<?=$post->getId()?>">
            <input type="hidden" name="post_slug" value="<?=$post->getSlug()?>">
                
            <textarea name="comment" placeholder="Write a comment"></textarea>
            <input name="submitBtn" type="submit" value="Post">
        </form>

        <?php require "../src/views/posts/post_comment.php"; ?>

    </section>



</section>