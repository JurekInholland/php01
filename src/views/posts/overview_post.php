<style>
.post_title {
    color: rgba(255, 255, 255, .85);
    font-weight: bold;
}
.overview_post {
    border: 1px solid transparent;
    border-radius: 8px;
}

</style>


<article class="overview_post">

    <a  href="/edit?post=<?=$post->getSlug()?>" class="post_link">

        <figure class="image_container">
            <img src="<?=$post->getImage()->getLink()?>" alt="">
        </figure>
    </a>
    <ul class="post_info">
        <li class="post_title" ><a href="/edit?post=<?=$post->getSlug()?>"><?=$post->getTitle()?></a></li>
        <li><a href="/user?name=<?=$post->getAuthor()->getName()?>"><?=$post->getAuthor()->getName()?></a> </li>
        <li><?=$post->getDate()?></li>
    </ul>

</article>