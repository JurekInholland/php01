<style>
form select {
    background-color: rgba(255, 255, 255, .25);
    border-radius: 5px;
    border-color: rgba(255, 255, 255, .35);
    color: rgba(255, 255, 255, .75);
    height: 40px;
}

form {
    display: flex;
    flex-wrap: wrap;
    flex-direction: row;
    flex-basis: 100%;
}


form .control {
    margin-bottom: 1rem;
    flex: 1 1 440px;
    margin: 1rem .5rem;

}

form select {
  width: 100%;
  padding-left: 2rem;
  background: rgba(255, 255, 255, .25);
}

form select option {
  color: black;
}


.control input[type="submit"] {
  width: 100%;
    /* margin-top: 1rem;
    flex-basis: 100%; */
}


</style>

<section class="container">
<h1>Create new user</h1>

  <form action="/user/create/submit" method="POST">
        <section class="control has-icons-left">
            <input required class="input" name="username" type="text" placeholder="Username" value="">
            <span class="icon is-small is-left">
              <i class="fas fa-user"></i>
            </span>
        </section>

        <section class="control has-icons-left">
            <input required class="input" name="email" type="text" placeholder="Email" value="">
            <span class="icon is-small is-left">
              <i class="fas fa-envelope"></i>
            </span>
        </section>

        <section class="control has-icons-left" id="password" >
            <input required class="input" type="text" placeholder="Password" name="password" value="">
            <span class="icon is-small is-left">
              <i class="fas fa-key"></i>
            </span>
        </section>


        <section class="control has-icons-left" id="password" >

          <select name="role">
            <?php foreach($roles as $role) : ?>

              <?php if ($role["role_id"] > 0 && $role["role_id"] <= App::get("user")->getRole()) : ?>
                <option value="<?=$role["role_id"]?>"><?=$role["role_name"]?></option>
              <?php endif; ?>
            <?php endforeach; ?>
          </select>
          <span class="icon is-small is-left">
              <i class="fas fa-user-tag"></i>
            </span>
        </section>

  <section class="control">
    <input type="submit" value="Create" class="button is-primary">
  </section>
  </form>
</section>
