<?php include "inc/header.php"; ?>
<?php
$sql = "SELECT * FROM feedback";
$result = mysqli_query($connection, $sql);
$feedback = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
        <h2>Feedback</h2>
        <?php if (empty($feedback)): ?>
          <p class="lead mt3">There is no feedback</p>
          <?php endif; ?>

        <?php foreach ($feedback as $item): ?>
          <?php
          $id = $item["id"];
          $name = $item["name"];
          $body = $item["body"];
          $date = $item["date"];
          $rating = $item["rating"];
          $video_url = $item["video_url"];
          ?>

        <div class="card my-3 w-75">
          <div class="card-body text-center">
            <?php echo "#" . $id . " - " . $body; ?>
            <div class="text-secondary mt-2">
              By <?php echo $name; ?> on <?php echo $date; ?>
            </div>
            <div class="text-secondary mt-2">
              <p>Rating: <?php if ($rating == 0) {
                  echo "no rating";
              } else {
                  for ($rating; $rating > 0; $rating--) {
                      echo "*";
                  }
              } ?></p>
            </div>
              <div class="text-secondary mt-2">
              <a href="<?php echo $video_url; ?>"><?php echo $video_url; ?></a>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
<?php include "inc/footer.php"; ?>
