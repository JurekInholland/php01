<nav class="navbar" role="navigation" aria-label="main navigation">
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

    

      <section class="control has-icons-left">
      <a href="/create" class="button is-primary" id="new_post">
        <strong> New Post</strong>
      </a>
          <span class="icon is-small is-left">
            <i class="fas fa-plus-square"></i>
          </span>
      </section>


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
<!-- 
      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">
          More
        </a>

        <div class="navbar-dropdown">
          <a class="navbar-item">
            About
          </a>
          <a class="navbar-item">
            Jobs
          </a>
          <a class="navbar-item">
            Contact
          </a>
          <hr class="navbar-divider">
          <a class="navbar-item">
            Report an issue
          </a>

        </div>

      </div> -->
    </div>

    <div class="navbar-end">

      <div class="navbar-item">
        <div class="buttons">
        <a href="/login" class="button empty">
            <strong>Sign in</strong>
          </a>
          <a href="/register" class="button is-primary">
            <strong>Sign up</strong>
          </a>
         
        </div>
      </div>

    </div>

  </div>

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