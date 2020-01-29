
<style>
.profile_buttons input {
    margin-bottom: .5rem;
}
</style>


<section class="container">
    <h1><?=$user->getNameCapitalized()?>'s Profile</h1>

    <section class="profile_info">
    


        <figure class="profile_picture">

            <img src="<?=$user->getProfilePicture()?>" alt="">

        </figure>

        <section>

            <table class="table">


                <tbody>
                    <tr>
                        <td>Id:</td>
                        <td><?=$user->getId()?></td>
                    </tr>

                    <tr>
                        <td>Username</td>
                        <td><?=$user->getName()?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?=$user->getEmail()?></td>
                    </tr>

                    <tr>
                        <td>Registration Date</td>
                        <td><?=$user->getRegistrationDate()?></td>
                    </tr>

                    <tr>
                        <td>Post count</td>
                        <td><?=$user->getPostCount()?></td>

                    </tr>
                </tbody>
            </table>

                <form action="/user/submit" method="POST" class="profile_buttons">
                    <input name="id" type="hidden" value="<?=$user->getId()?>">
                    <input name="edit" id="change_profile_btn" type="submit" class="button is-primary " value="Edit Profile">


                    <?php if (App::get("user")->getRole() > 1 && $user->getRole() == 1) : ?>
                        <input name="delete" id="change_profile_btn" type="submit" class="button is-danger" value="Delete User">
                        <input name="login_on_behalf" id="change_profile_btn" type="submit" class="button is-info" value="Login as">
                    <?php endif; ?>


                </form>

        </section>


    </section>



    <hr>
    <h1>Posts by <?=$user->getNameCapitalized()?></h1>

    <?php if (!empty($posts)) : ?>

        <section id='post_grid'>
            <?php foreach ($posts as $post) : ?>
            
                <?php require "../src/views/posts/overview_post.php"; ?>
            <?php endforeach; ?>
        </section>

    <?php else : ?>
    <p>This user does not have any posts yet.</p>

    <?php endif; ?>

</section>
