<?php include 'inc/header.php';?>

<?php
$name=$email=$body=$videoURL=$rating="";
$nameErr=$emailErr=$bodyErr=$videoURLErr="";

//form submit
if(isset($_POST['submit'])){
  //validate the name
  if(empty($_POST['name'])){
    $nameErr='Name is required';
    }else{
      $name=filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
} 
//validate the email
  if(empty($_POST['email'])){
    $emailErr='Email is required';
    }else{
      $email=filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    }
 //validate the feedback
  if(empty($_POST['body'])){
    $bodyErr='Feedback is required';
    }else{
      $body=filter_input(INPUT_POST, 'body', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    //validate the video url
    if(empty($_POST['video_url'])){
    $videoURLErr='URL of video is required';
    }else{
      $videoURL=filter_input(INPUT_POST, 'video_url', FILTER_SANITIZE_URL);
    }

    $rating= filter_input(INPUT_POST, 'rating', FILTER_SANITIZE_NUMBER_INT);

    if(empty($nameErr) && empty($emailErr) && empty($bodyErr) && empty($videoURLErr)){
      //add to database
      $sql = "INSERT INTO feedback (name,email,body,video_url, rating) VALUES ('$name', '$email', '$body','$videoURL', '$rating')";

      if(mysqli_query($connection, $sql)){
        header('Location: feedback.php');
        }else{
          echo 'Error' . mysqli_error($connection);

        }
    }

?>
        <img src="./img/logo.png" class="w-25 mb-3" alt="" />
        <h2>Feedback</h2>
        <p class="lead text-center">Leave feedback for Traversy Media</p>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="mt-4 w-75" method="POST">
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input
              type="text"
              class="form-control <?php echo $nameErr ? "is-invalid": null;?>"
              id="name"
              name="name"
              placeholder="Enter your name"
            />
            <div class="invalid-feedback">
              <?php echo $nameErr;?>
            </div>
          </div>     
           <div class="mb-3">
            <label for="name" class="form-label">Rating</label>
            <input
              type="text"
              class="form-control"
              id="rating"
              name="rating"
              placeholder="Enter rating"
            />
          </div>      
          <div class="mb-3">
            <label for="name" class="form-label">Video URL</label>
            <input
              type="text"
              class="form-control <?php echo $videoURLErr ? "is-invalid": null;?>"
              id="video_url"
              name="video_url"
              placeholder="Enter video url"
            />
            <div class="invalid-feedback">
              <?php echo $videoURLErr;?>
            </div>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input
              type="email"
              class="form-control <?php echo $emailErr ? "is-invalid": null;?>"
              id="email"
              name="email"
              placeholder="Enter your email"
            />
            <div class="invalid-feedback">
              <?php echo $emailErr;?>
            </div>
          </div>
          <div class="mb-3">
            <label for="body" class="form-label">Feedback</label>
            <textarea
              class="form-control <?php echo $bodyErr ? "is-invalid": null;?>"
              id="body"
              name="body"
              placeholder="Enter your feedback"
            ></textarea>
            <div class="invalid-feedback">
              <?php echo $bodyErr;?>
            </div>
          </div>
          <div class="mb-3">
            <input
              type="submit"
              name="submit"
              value="Send"
              class="btn btn-dark w-100"
            />
          </div>
        </form>

<?php include 'inc/footer.php';?>