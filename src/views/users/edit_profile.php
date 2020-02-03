<style>

    .form {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
    }


    .form .field {
        flex: 1 1 420px;
        margin: 1rem;
    }

    /* .form .field:last-child {
        flex-basis: 100%;
    } */

    .form .control input {
        width: 100%;
    }

    .image {
        flex-basis: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #apikey {
        display: flex;
        flex-basis: 100%;
    }
    .form .stretch {
        flex: 1 1 100%
    }

    .stretch button {
        margin-left: .5rem;
    }
</style>

<script>

function genkey() {
    // apiinput.value = "KEYLOL";
}


</script>

<div class="container">

    <form action="/user/edit/submit" method="POST" class="form" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?=$user->getId()?>">

    <section class="image">
    <figure class="profile_picture">

<img src="<?=$user->getProfilePicture()?>" alt="" id="image">

</figure>
    </section>

    <div class="field">
    <label class="label">Name</label>
    <section class="control has-icons-left">
        <input class="input" name="name" type="text" placeholder="Username" value="<?=$user->getName()?>">
        <span class="icon is-small is-left">
            <i class="fas fa-user"></i>
        </span>
      </section>
    </div>
   
    <div class="field">
    <label class="label">Email</label>
    <section class="control has-icons-left">
        <input class="input" name="email" type="text" placeholder="Email" value="<?=$user->getEmail()?>">
        <span class="icon is-small is-left">
            <i class="fas fa-envelope"></i>
        </span>
      </section>
    </div>


    <div class="field">

      <label class="label">Password</label>

    <section class="control has-icons-left" id="password" >
        <input class="input" name="password" type="text" placeholder="Password" name="password" value="">
        <span class="icon is-small is-left">
            <i class="fas fa-key"></i>
        </span>
    </section>
    </div>

<!-- 
    <input type="text" name="username" value="username">
    <input type="email" name="email" value="email@test.com"> -->


    <!-- <input type="file" name="profile_image" id=""> -->

    <div class="field">
    <label class="label">Avatar</label>

        <input type="file" class="file-select" name="profile_image" id="file">

    </div>


    <div class="field stretch">
    <label class="label">Api Key</label>
    <section class="control has-icons-left" id="apikey">
        <input readonly class="input" id="apiinput" name="apikey" type="text" placeholder="Press Generate" value="<?=$user->getApiKey()?>">
        <span class="icon is-small is-left">
            <i class="fas fa-hockey-puck"></i>
        </span>
        <button class="button is-primary" onclick="genkey()">Generate</button>

    </section>

    </div>


    <!-- TODO: refactor -->
    <div class="field">
    <section class="control">
    <input type="submit" value="Cancel" class="button is-dark" name="cancel" id="">

    </section>

    </div>

    <div class="field">
    <section class="control">

    <input type="submit" class="button is-primary" name="submitBtn">
    </section>
    </div>
    </form>
</div>



<script>

file.onchange = function () {
    let reader = new FileReader();
    reader.onload = function (e) {
        displayImage(e);
    };
    reader.readAsDataURL(this.files[0]);
}

function displayImage(e) {
    image.src = e.target.result;
}

</script>