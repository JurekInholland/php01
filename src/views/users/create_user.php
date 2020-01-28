<style>
select {
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
    flex: 1 1 500px;
}

form input[type="submit"] {
    margin-top: 1rem;
    flex-basis: 100%;
}


</style>

<form action="">
<h1>Create new user</h1>
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


        <select name="role">
            <option value="0">opt0</option>
            <option value="1">opt1</option>
        </select>

        <!-- <div class="field">
  <div class="control">
    <div class="select is-info">
      <select name="role">
        <option value="0">Select dropdown</option>
        <option value="1">With options</option>
      </select>
    </div>
  </div>
</div> -->


<input type="submit" class="button is-primary">

</form>