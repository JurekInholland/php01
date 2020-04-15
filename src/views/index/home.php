
<section class="home_container">


  <div class="posts">
    <?php require "../src/views/posts/overview.php"; ?>
  </div>

  <div class="twitter">
  <a class="twitter-timeline" data-lang="en" data-dnt="true" data-theme="dark" href="https://twitter.com/pictur09272636">Tweets by pictur</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
  </div>
</section>

<style>
  .home_container {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
  }

.posts {
  flex: 10 1 800px;
}
  .twitter {
    margin: 0 auto;
    flex: 1 1 360px;
    background-color: #292F33;
  }


</style>