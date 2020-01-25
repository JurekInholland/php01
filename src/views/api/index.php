<style>
.container p {
    max-width: 700px;
    margin-bottom: 1rem;
}

</style>
<section class="container">

    <h1>API</h1>

    <p>
        This is a RESTful API based on HTTP requests and JSON responses.
    </p>
    <p>

        Every response contains an element 'status' and in case of success
        an element 'data', containing requested information.
    </p>
    <p>

        Note that some endpoints require authentication in form of an api key,
        passed via GET request.
    </p>

    <table class="table">
        <thead>
            <tr>
                <th>Endpoint</th>
                <th>Description</th>
                <th>Auth required</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td><a href="/api/posts">/api/posts</a></td>
                <td>Get json object of all site posts.</td>
                <td>No</td>
            </tr>

            <tr>
                <td><a href="/api/users">/api/users</a></td>
                <td>Get json object of all users.</td>
                <td>Yes</td>
            </tr>

            <tr>
                <td><a href="/api/images">/api/images</a></td>
                <td>Get json object of all images.</td>
                <td>Yes</td>
            </tr>

        </tbody>
    </table>
</section>
