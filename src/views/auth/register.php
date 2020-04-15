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

.auth_form p {
  width: 100%;
  color: red;
}
</style>



<div class="container auth">
  <img class="site_logo" src="/img/logo.svg" alt="">
  <form action="/register/submit" class="auth_form" method="POST">
      <h1>Sign up</h1>
      <p><?=$_SESSION["registerMsg"]?></p>
      <p id="feedback_name"></p>
      <section class="control has-icons-left">
          <input class="input" id="name" name="username" type="text" placeholder="Username" value="">
          <span class="icon is-small is-left">
            <i class="fas fa-user"></i>
          </span>
      </section>
      
      <p id="feedback_email"></p>
      <section class="control has-icons-left">
          <input class="input" id="email" name="email" type="text" placeholder="Email" value="">
          <span class="icon is-small is-left">
            <i class="fas fa-envelope"></i>
          </span>
      </section>

      <p id="feedback_password"></p>
      <section class="control has-icons-left" >
          <input class="input" id="password" type="password" placeholder="Password" name="password" value="">
          <span class="icon is-small is-left">
            <i class="fas fa-key"></i>
          </span>
      </section>

      <p id="feedback_password2"></p>
      <section class="control has-icons-left">
          <input class="input" type="password" id="password2" placeholder="Retype password" name="retype_password" value="">
          <span class="icon is-small is-left">
            <i class="fas fa-key"></i>
          </span>
      </section>



      <section class="control">
        <input type="submit" name="submitBtn" value="Sign up" class="button is-primary">

      </section>
  </form>
</div>


<script>
  // const nameInput = document.querySelector('#name');
  const nameInput = document.getElementById("name");
  const emailInput = document.getElementById("email");
  const passwordInput = document.getElementById("password");
  const password2Input = document.getElementById("password2");
  const nameFeedback = document.getElementById("feedback_name")
  const emailFeedback = document.getElementById("feedback_email")
  const passwordFeedback = document.getElementById("feedback_password")
  const password2Feedback = document.getElementById("feedback_password2")


  nameInput.addEventListener("input", validateName);
  emailInput.addEventListener("input", validateEmail);
  passwordInput.addEventListener("input", validatePassword);
  password2Input.addEventListener("input", validatePassword2);

  function validateName(e) {
    console.log(e.target.value);
    if (e.target.value.length < 8) {
      nameFeedback.innerHTML = "Name is too short"
    } else {
      nameFeedback.innerHTML = " "

    }
  }
  function validateEmail(e) {
    if (!emailIsValid(e.target.value)) {
      emailFeedback.innerHTML = "Please enter a valid Email"
    } else {
      emailFeedback.innerHTML = "";
    }
  }

  function validatePassword2(e) {
    if (e.target.value != passwordInput.value) {
      password2Feedback.innerHTML = "Passwords don't match";
    } else {
      password2Feedback.innerHTML = "";
    }
  }

  function validatePassword(e) {
    if (e.target.value.length < 8) {
      passwordFeedback.innerHTML = "Password is too short."
    } else {
      passwordFeedback.innerHTML = ""

    }
  }

  function emailIsValid(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
  }



</script>