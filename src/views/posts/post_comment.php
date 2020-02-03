<style>


.comment_container {
    display: flex;
    flex-direction: row;
    background-color: #2c2f34;
    padding: .5rem 0;
    margin: 1rem 0;

    border: 1px solid transparent;
    border-radius: 8px;
}


.comment_container::before {
    flex-shrink: 0;
    background-color: #2c2f34;
    content: "";
    display: block;
    height: 10px;
    position: relative;

    top: .3rem;
    left: -.45rem;
    transform: rotate( 29deg ) skew( -35deg );

    width:  13px;
}

.comments {
    margin-bottom: 1rem;
}

.comments hr {
    margin: .5rem 0;
}

.lelform {
    display: flex;
}

.comment {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    min-height: 60px;

}

.comment_avatar {

    position: relative;
    border-radius: 50%;
    width: 50%;
    height: auto;
    overflow: hidden;
    margin-right: .5rem;
    z-index: 1;
    flex-shrink: 0;
    max-width: 25px;
    max-height: 25px;
    background-color: rgba(0, 0, 0, .25)
}

.author_avatar {
    position: absolute;
    object-fit: cover;
    width: 100%;
    height: 100%;
}

.author_info {
    font-size: .75rem;
    margin-bottom: 1rem;
}

.author_info span {
    margin-left: .5rem;
}

.comment_area {
    width: 90%;
    min-width: 300px;
    max-width: 728px;
}

.comments h3 {
    color: rgba(255, 255, 255, .65)
}

.comment_content {
    margin-right: 1rem;
}

</style>


<!-- <form class="lelform" action="/comment/submit" method="POST">

    <textarea id="comment" name="content" placeholder="Add a description..." <?=$readonly?>><?=$post->getContent()?></textarea>
    <input type="submit" name="" class="button is-primary">
</form> -->


    <section class="comments">

    <h3><?=count($comments)?> Comment(s)</h3>
    <hr>


    <?php foreach ($comments as $comment): ?>

        <div class="comment_container">

            <figure class="comment_avatar">
                <img class="author_avatar" src="<?=$comment->getAuthor()->getProfilePicture()?>" alt="">
            </figure>

            <section class="comment">
            
                <section class="author_info">
                    <a href="/user?name=<?=$comment->getAuthor()->getName()?>"><?=$comment->getAuthor()->getName()?></a>
                    <span><?=$comment->getDate()?></span>
                </section>

                <span class="comment_content"><?=$comment->getContent()?></span>
            </section>

        </div>
    <?php endforeach; ?>

    </section>

