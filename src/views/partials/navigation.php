<style>
#profile_link {
  display: flex;
  flex-direction: row;
  justify-content: flex-start;
  align-items: center;
  flex-wrap: nowrap;
  /* margin-right: 3rem; */
  font-weight: normal;
}

#profile_link:hover {
  color: white;
  text-decoration: none;
}

#profile_link:active {
  border: 0px solid transparent;
  border-color: transparent;
}

.log_out {
  background-color: transparent;
  border: 1px solid transparent;
  /* border: 1px solid rgba(255, 255, 255, .5); */
  color: rgba(255, 255, 255, .5);
}

.log_out:hover {
  color: white;
  border-color: transparent;
}

.dropdown-content {
  background-color: #53565d;
}

a.dropdown-item {
  /* font-weight: normal; */
  color: rgba(255, 255, 255, .85);
}

a.dropdown-item:hover {
  background-color: rgba(255, 255, 255, .35);
  color: rgba(255, 255, 255, .85);

  text-decoration: none;
}


.dropdown.is-right .dropdown-menu {
  left: 0;
}

@media screen and (min-width: 768px) {
  .dropdown.is-right .dropdown-menu{
    left: auto;
  }
}

.navbar {
  min-height: 0px;
}

.navbar .profile_picture {
  margin-right: .5rem;
  width: 35px;
  height: 35px;
}

.navbar>.container {
  padding: 0 .5rem;
  min-height: 0px;
}

.navbar-item img {
  max-height: unset;
}

/* #new_post {
  min-height: 10px;
  height: 40px;
  padding: 0 1rem;
} */

.navbar .button, .navbar .control .icon {
  height: 2.2rem;
}

.navbar .button {
  padding: 0 1rem;
}
</style>

<?php

// die(var_dump(App::get("user")));

?>

<nav class="navbar" role="navigation" aria-label="main navigation">
  <section class="container">
  <div class="navbar-brand">
    <a class="logo" href="/">
      <img src="/img/logo.svg" height="auto" width="100px">
    </a>

    <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarMain">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div id="navbarMain" class="navbar-menu">
    <div class="navbar-start">

    
      <div class="navbar-item">
      <section class="control has-icons-left">
      <a href="/create" class="button is-primary" id="new_post">
        <strong> New Post</strong>
      </a>
          <span class="icon is-small is-left">
            <i class="fas fa-plus-square"></i>
          </span>
      </section>
      </div>

      <a href="/" class="navbar-item">
        Home
      </a>

     

      <a href="/users" class="navbar-item">
        Users
      </a>

      <a href="/api" class="navbar-item">
        API
      </a>

      <a href="/about" class="navbar-item">
        About
      </a>

    </div>

    <div class="navbar-end">

    <div class="navbar-item">

      <?php if(App::get("user")->isLoggedIn()) : ?>

        
        <!-- <button class="button log_out" onclick="window.location.href = '/logout'">
          <span class="icon is-small">
            <i class="fas fa-sign-out-alt"></i>
          </span>
          <span>Sign out</span>
        </button> -->

  <div class="dropdown is-right">

  <a id="profile_link">
        <figure class="profile_picture">
        <img src="<?=App::get("user")->getProfilePicture()?>" alt="">

        </figure>

          <?=App::get("user")->getNameCapitalized()?>
        </a>


  <div class="dropdown-menu" id="dropdown-menu" role="menu">
    <div class="dropdown-content">
      <a href="/user?id=<?=App::get("user")->getId()?>" class="dropdown-item">
        Profile
      </a>
      <a href="/logout" class="dropdown-item">
        Logout
      </a>
     
    </div>
  </div>
</div>
        
<script>
window.addEventListener("click", (event) => {
  var dropdown = document.querySelector('.dropdown');
  dropdown.classList.remove("is-active");
});

profile_link.addEventListener("click", (event) => {
  var dropdown = document.querySelector('.dropdown');
  event.stopPropagation();
  dropdown.classList.toggle("is-active");
});
</script>
        
      <?php else : ?>
          <div class="buttons">
            <a href="/login" class="button empty">
              <strong>Sign in</strong>
            </a>
            <a href="/register" class="button is-primary">
              <strong>Sign up</strong>
            </a>
          </div>
      <?php endif; ?>

      </div>
 

     

    </div>

  </div>
  </section>
</nav>
<script>


document.addEventListener('DOMContentLoaded', () => {

// Get all "navbar-burger" elements
const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

// Check if there are any navbar burgers
if ($navbarBurgers.length > 0) {

  // Add a click event on each of them
  $navbarBurgers.forEach( el => {
    el.addEventListener('click', () => {

      // Get the target from the "data-target" attribute
      const target = el.dataset.target;
      const $target = document.getElementById(target);

      // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
      el.classList.toggle('is-active');
      $target.classList.toggle('is-active');

    });
  });
}

});
</script>