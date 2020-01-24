<h1><?=$user->getName()?>'s Profile</h1>

<p>Id: <?=$user->getId()?></p>



<?php if (!empty($posts)) : ?>
    <hr>
    <h3>Posts by </h3>
    <section id='post_grid'>
        <?php foreach ($posts as $post) : ?>
        
            <?php require "../src/views/posts/overview_post.php"; ?>
        <?php endforeach; ?>
    </section>
<?php endif; ?>
