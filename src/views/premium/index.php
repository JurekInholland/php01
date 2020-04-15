<style>


    .pricing_table {
        display: flex;
        flex-wrap: wrap;
        flex-direction: row;
        width: 100%;
        justify-content: space-between;
        align-content: stretch;
        max-width: 1344px;
    }

    .pricing_table a, .pricing_table div {
        background-color: rgba(255, 255, 255, .35);
        padding: 1rem;
        margin: 1rem;
        border-radius: 8px;
        flex: 1 1 200px;
        padding-bottom: 2rem;
    }
    .pricing_table a:hover {
        text-decoration: none;
        background-color: rgba(255, 255, 255, .45)
    }

    .pricing_table ul {
        list-style-position: inside;
        list-style-type: circle;
    }
</style>

<section class="container">

<h1>Select a tier!</h1>

    <section class="pricing_table">



        <div>
            <h3>FREE</h3>
            <h1>€0/month</h1>

            <ul>
                <li>Single User</li>
                <li>1GB Storage</li>
                <li>Unlimited Public Posts</li>
                <li>Community Access</li>
                <li>5 Private Posts</li>
            </ul>
        </div>

        <a href="/premium/plus">
            <h3>PLUS</h3>
            <h1>€9/month</h1>

            <ul>
                <li>5 Users</li>
                <li>5GB Storage</li>
                <li>Unlimited Public Posts</li>
                <li>Community Access</li>
                <li>100 Private Posts</li>
            </ul>
        </a>

        <a href="/premium/pro">
            <h3>PRO</h3>
            <h1>€29/month</h1>

            <ul>
                <li>25 Users</li>
                <li>100GB Storage</li>
                <li>Unlimited Public Posts</li>
                <li>Community Access</li>
                <li>Unlimited Private Posts</li>
            </ul>
        </a>

    </section>

</section>