<style>
footer {
    background-color: #131223;
    display: flex;
    flex-wrap: wrap;
    flex-direction: column;
    padding: .75rem;
    padding-bottom: 3rem;
}
</style>

<footer>
    <p>Made by Jurek Baumann © <?= date("Y"); ?></p>
    <p>page rendered at <?= date("H:i:s"); ?> on <?= date("F jS Y"); ?>.</p>
</footer>