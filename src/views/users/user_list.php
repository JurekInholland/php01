<style>



    .headrow {
        display: flex;
        align-items: center;
        justify-content: space-between;
        /* line-height: 10rem; */
        /* justify-content: center; */
    }

    .searchform {
        margin: 0;
    }
</style>


<section class="container">

<section class="headrow">
<h1>All Users:</h1>
<form action="/users" class="searchform" method="GET">
<section class="control has-icons-left">
    <input class="input" placeholder="Search Users" type="text" name="q" value="<?=$_GET["q"] ?? ""?>">
    <span class="icon is-small is-left">
        <i class="fas fa-search"></i>
    </span>
</section>

</form>
</section>

    <table class="table">
    <thead>

        <tr>
            <th>User Id</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Registration Date</th>
        </tr>

    </thead>
    <tbody>

        <?php foreach ($users as $key => $user) : ?>
            <tr>
                <td><?=$user->getId()?></td>
                <td><a href="/user?id=<?=$user->getId()?>">
                    <figure class="profile_picture">
                        <img src="<?=$user->getProfilePicture()?>" alt="">
                    </figure>
                    <?=$user->getName()?>
                </a></td>
                <td><?=$user->getEmail()?></td>
                <td><?=$user->getRoleName()?></td>
                <td><?=$user->getRegistrationDate()?></td>
            </tr>
            
            
        <?php endforeach; ?>
    </tbody>

    </table>

    <form action="/user/create" class="form" method="GET">
        <input type="submit" name="createUser" class="button is-primary" value="Create User">
    </form>

</section>
