<h1>All Users:</h1>
<ul>
<?php foreach ($users as $key => $user) : ?>
    <a href="/user?id=<?=$user->getId()?>"><?=$user->getName()?></a>
<?php endforeach; ?>
</ul>