<?php include "inc/header.php"; ?>
<?php
$sql = "SELECT * FROM feedback";
$result = mysqli_query($connection, $sql);
$feedback = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<?php if (isset($_POST["delete"])) {
    $id = $_POST["delete_id"];
    $sql = "DELETE FROM feedback WHERE  id=$id";
    if (mysqli_query($connection, $sql)) {
        header("Location: feedback.php");
    } else {
        echo "Error" . mysqli_error($connection);
    }
} ?>
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
            <div class="d-flex justify-content-between">
              <h3><?php echo "#" . $id; ?></h3>
              <p >From <span class="font-weight-bold"><?php echo $name; ?></span>, <?php echo $date; ?></p>
            </div>
            <div class="w-100 my-4">
              <p>"<?php echo $body; ?>"</p>
            </div>
            <div class="my-2">
              <a href="<?php echo $video_url; ?>"><?php echo $video_url; ?></a>
            </div>
            <div class="d-flex justify-content-between my-4">
              <div class="text-secondary w-100  d-flex justify-content-start align-items-end">
              <p>Rating: <?php if ($rating == 0) {
                  echo "no rating";
              } else {
                  for ($rating; $rating > 0; $rating--) {
                      echo "*";
                  }
              } ?></p>
            </div>
            <form action="feedback.php" method="POST" class="w-100 d-flex justify-content-end align-items-end">
              <input type="hidden" name="delete_id" value="<?php echo $id; ?>">
              <input type="submit" name="delete" value="Delete" class="btn btn-outline-dark mt-4">
            </form>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
<?php include "inc/footer.php"; ?>
