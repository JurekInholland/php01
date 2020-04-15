<style>
.message_box {
    background-color: rgba(255, 255, 255, .25);
    padding: 1.5rem;
    font-size: 2.5rem;
    font-weight: bold;
    text-align: center;
    margin: 1rem;
}
.links {
    margin-top: 1rem;
    font-size: 1rem;
}

.links a {
    margin: 0 10px;
}
</style>

<section class="container">
    <section class="message_box">
        <span><?=$message?></span>
        <section class="links">
        <a href="javascript:window.history.back();">Go back</a>
        <a href="/">Go home</a>
        </section>

    </section>
</section>