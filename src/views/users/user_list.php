<h1>All Users:</h1>
<ul>
<table>
<thead>

    <tr>
        <th>User Id</th>
        <th>Username</th>
        <th>Role</th>
    </tr>

</thead>

</table>

<?php foreach ($users as $key => $user) : ?>
    <a href="/user?id=<?=$user->getId()?>"><?=$user->getName()?></a>
<?php endforeach; ?>
</ul>