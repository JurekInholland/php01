<style>
.auth_form {

  margin-top: 1rem;
  display: flex;
  flex-wrap: wrap;
  flex-direction: row;
  align-items: center;
  justify-content: center;
  width: 100%;
  min-width: 300px;
  max-width: 650px;
  background-color: rgba(255, 255, 255, .25);
  border-radius: 5px;
  padding: 2rem 3rem;
}

.auth_form .control, .auth_form label {
  width: 100%;
  /* width: 100%; */
  min-width: 200px;
  /* max-width: 700px; */
}

.auth_form .control:not(:last-of-type) {
  margin-bottom: 1.75rem;
}

.control input[type="submit"] {
  width: 100%;
}

h1 {
  width: 100%;
}

.auth {
  max-width: unset;
  display: flex;
  align-items: center;
  flex-direction: column;
  /* justify-content: center; */
  margin: 0 1rem;
}

.site_logo {
  margin-top: 1rem;
  width: 75%;
  min-width: 200px;
  max-width: 500px;
}
#forgot {
  text-align: end;
  margin-top: .25rem;
  margin-bottom: 1rem;
  border: 0;
  color: #1BB76E;
  background-color: transparent;
  width: 100%;
  cursor: pointer;
}

#forgot:hover {
  color: #0fce7e;
  cursor: pointer;
}


</style>

<div class="container auth">
  <img class="site_logo" src="/img/logo.svg" alt="">
  <form action="/register/submit" class="auth_form" method="POST">
      <h1>Sign up</h1>
      <section class="control has-icons-left">
          <input class="input" name="username" type="text" placeholder="Username" value="">
          <span class="icon is-small is-left">
            <i class="fas fa-user"></i>
          </span>
      </section>

      <section class="control has-icons-left">
          <input class="input" name="email" type="text" placeholder="Email" value="">
          <span class="icon is-small is-left">
            <i class="fas fa-envelope"></i>
          </span>
      </section>

      <section class="control has-icons-left" id="password" >
          <input class="input" type="text" placeholder="Password" name="password" value="">
          <span class="icon is-small is-left">
            <i class="fas fa-key"></i>
          </span>
      </section>

      <section class="control has-icons-left" id="password2" >
          <input class="input" type="text" placeholder="Retype password" name="retype_password" value="">
          <span class="icon is-small is-left">
            <i class="fas fa-key"></i>
          </span>
      </section>



      <section class="control">
        <input type="submit" name="submitBtn" value="Sign up" class="button is-primary">

      </section>
  </form>
</div>