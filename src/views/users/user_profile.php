
<style>
.profile_info {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    margin: 1rem;
    justify-content: space-around;

}


.profile_picture {
    position: relative;
    border-radius: 50%;
    width: 50%;
    height: auto;
    overflow: hidden;
    max-width: 300px;
    /* margin-right: 2rem;
    margin-bottom: 1rem; */
    margin-bottom: 1rem;
}


.profile_picture:after {
  content: "";
  display: block;
  padding-bottom: 100%;
}

.profile_picture img {
    position: absolute;
    /* object-fit: contain;
    object-position: center;
    width: 100%;
    height: 100%; */
}

.table {
    width: 100%;
}
#change_profile_btn {
    width: 100%;
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

            <section class="buttons">
                <input id="change_profile_btn" type="submit" class="button is-primary is-fullwidth" value="Edit Profile">

                <input id="change_profile_btn" type="submit" class="button is-danger" value="Delete User">
            </section>



            <!-- <p>Id:asdasdasdasdsa <?=$user->getId()?></p>
            <p>Id: asdasdasdasdasd<?=$user->getId()?></p>
            <p>Id:asdasdasdad <?=$user->getId()?></p>
            <p>Id:asdasdasdasd <?=$user->getId()?></p> -->

        </section>

    </section>



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
