<div class="container">
    <form action="/admin/import/submit" method="POST" enctype="multipart/form-data">
        <h2>Import users.csv</h2>

        <!-- required -->
        <input type="file" name="users" >  
        <input class="button is-primary" type="submit">
    </form>
</div>

<style>
    form {
        max-width: 400px;
        margin: 0 auto;
    }
    input[type="submit"] {
        margin-top: 1rem;
    }
</style>