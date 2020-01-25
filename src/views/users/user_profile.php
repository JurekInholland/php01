<section class="container">

    <h1><?=$user->getNameCapitalized()?>'s Profile</h1>

    <p>Id: <?=$user->getId()?></p>



    <?php if (!empty($posts)) : ?>
        <hr>
        <h1>Posts by <?=$user->getNameCapitalized()?></h1>
        <section id='post_grid'>
            <?php foreach ($posts as $post) : ?>
            
                <?php require "../src/views/posts/overview_post.php"; ?>
            <?php endforeach; ?>
        </section>
    <?php endif; ?>

</section>
