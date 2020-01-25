<style>
.form {

  margin-top: 1rem;
  display: flex;
  flex-wrap: wrap;
  flex-direction: row;
  align-items: center;
  justify-content: center;
  width: 100%;
  min-width: 300px;
  max-width: 600px;
  background-color: rgba(255, 255, 255, .25);
  border-radius: 5px;
  padding: 2rem 3rem;
}

.form .control, .form label {
  width: 100%;
  /* width: 100%; */
  min-width: 200px;
  /* max-width: 700px; */
}

.form .control:not(:last-of-type) {
  margin-bottom: 1.75rem;
}

.control input[type="submit"] {
  width: 100%;
}

h1 {
  width: 100%;
}

.container {
  display: flex;
  align-items: center;
  flex-direction: column;
  /* justify-content: center; */
  margin: 0 1rem;
}

.container img {
  margin-top: 1rem;
  width: 75%;
  min-width: 200px;
  max-width: 500px;
}

#forgot {
  text-align: end;
  /* margin-top: .25rem; */
  margin-top: .25rem;
  margin-bottom: 1rem;
  border: 0;
  color: #1BB76E;
  background-color: transparent;
  align-items: flex-end;
  /* justify-content: flex-end; */
  width: 100%;
  cursor: pointer;
  /* margin-bottom: 1rem; */
}

#forgot:hover {
  color: #0fce7e;
  cursor: 
}

#password {
  margin-bottom: 0;
}
</style>

<div class="container">
  <img src="/img/logo.svg" alt="">
  <form action="/login/submit" class="form" method="POST">
  <!-- <label for="">Username</label> -->
      <h1>Sign in</h1>
      <section class="control has-icons-left">
          <input class="input" name="username" type="text" placeholder="Username" value="">
          <span class="icon is-small is-left">
            <i class="fas fa-user"></i>
          </span>
      </section>

      <!-- <label for="">Password</label> -->
      <section class="control has-icons-left" id="password" >
          <input class="input" type="text" placeholder="Password" name="password" value="">
          <span class="icon is-small is-left">
            <i class="fas fa-key"></i>
          </span>
      </section>

      <input type="button" onclick="this.form.submit();" name="forgot" value="Forgot password?" id="forgot">


      <section class="control">
      <input type="submit" name="submitBtn" id="" class="button is-primary">

      </section>
  </form>
</div>