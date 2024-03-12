<?php
include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

if (!isset($user_id)) {
  header('location:login.php');
}

$message = [];

if (isset($_POST['send_msg'])) {
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $msg = mysqli_real_escape_string($conn, $_POST['msg']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $phone = mysqli_real_escape_string($conn, $_POST['phone']);

  mysqli_query($conn, "INSERT INTO msg (user_id, name, email, number, msg) VALUES ('$user_id', '$name', '$email', '$phone', '$msg')") or die('Message send Query failed');
  $message[] = 'Message Sent Successfully';
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Contact Us</title>
  <link rel="stylesheet" href="style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./css/hello.css">
</head>

<body>

  <?php include 'index_header.php'; ?>

  <?php
  if (isset($message)) {
    foreach ($message as $message) {
      echo '
            <div class="message" id="messages">
                <span>' . $message . '</span>
            </div>';
    }
  }
  ?>

  <div class="contact-section">
    <h1>Contact Us</h1>
    <h3 style="text-align: center;">Hello, <span><?php echo $user_name; ?></span>&nbsp;how can we help you?</h3>
    <div class="border"></div>
    <form class="contact-form" action="" method="post">
      <input type="text" class="contact-form-text" name="name" placeholder="Your name">
      <input type="email" class="contact-form-text" name="email" placeholder="Your email">
      <input type="int" class="contact-form-text" name="phone" placeholder="Your phone">
      <textarea class="contact-form-text" name="msg" placeholder="Your message"></textarea>
      <input type="submit" class="contact-form-btn" name="send_msg" value="Send">
      <a href="index.php">
        <input class="contact-form-btn" value="Back">
      </a>
    </form>
  </div>



  <?php include 'index_footer.php'; ?>

  <script>
    setTimeout(() => {
      const box = document.getElementById('messages');
      box.style.display = 'none';
    }, 5000);
  </script>
</body>

</html>