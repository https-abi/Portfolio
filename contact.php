<?php
// ── Form Handling ─────────────────────────────────────────────
$form_success = false;
$form_errors  = [];
$old          = ['name' => '', 'email' => '', 'message' => ''];
$show_captcha = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name    = trim(htmlspecialchars($_POST['sender_name']    ?? '', ENT_QUOTES, 'UTF-8'));
    $email   = trim(htmlspecialchars($_POST['sender_email']   ?? '', ENT_QUOTES, 'UTF-8'));
    $message = trim(htmlspecialchars($_POST['sender_message'] ?? '', ENT_QUOTES, 'UTF-8'));
    $captcha = isset($_POST['captcha_confirm']);

    $old = ['name' => $name, 'email' => $email, 'message' => $message];

    if ($name === '')    $form_errors[] = 'Name is required.';
    if ($email === '')   $form_errors[] = 'Email address is required.';
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $form_errors[] = 'Please enter a valid email address.';
    if ($message === '') $form_errors[] = 'Message cannot be empty.';

    if (empty($form_errors) && !$captcha) {
        $show_captcha = true;
    }

    if (empty($form_errors) && $captcha) {
        $form_success = true;
        $conn = mysqli_connect("localhost", "root", "", "portfolio");
        $stmt = mysqli_prepare($conn, "INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sss", $name, $email, $message);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        // mail('you@example.com', 'New message from ' . $name, $message, 'From: ' . $email);
        $old = ['name' => '', 'email' => '', 'message' => ''];
        $show_captcha = false;
    }
}

$current_page = 'contact';
$page_title   = 'Contact';
require 'header.php';
?>

  <!-- PAGE 3 · Contact -->
  <div class="hero">
    <h1>Get in Touch</h1>

    <div class="divider"></div>

    <p class="subtitle">Have a question or want to work together? Send me a message.</p>

    <div class="form-wrap">

      <?php if ($form_success): ?>
        <div class="success-msg">
          ✅ Message sent! I'll get back to you soon.
        </div>

      <?php else: ?>

        <?php if (!empty($form_errors)): ?>
          <ul class="error-list">
            <?php foreach ($form_errors as $err): ?>
              <li><?php echo htmlspecialchars($err); ?></li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>

        <form method="POST" action="contact.php">

          <div class="form-group">
            <label for="sender_name">Your Name</label>
            <input
              type="text"
              id="sender_name"
              name="sender_name"
              placeholder="Juan dela Cruz"
              value="<?php echo val($old['name']); ?>"
              <?php echo in_array('Name is required.', $form_errors) ? 'class="error"' : ''; ?>
            />
          </div>

          <div class="form-group">
            <label for="sender_email">Email Address</label>
            <input
              type="email"
              id="sender_email"
              name="sender_email"
              placeholder="juan@example.com"
              value="<?php echo val($old['email']); ?>"
              <?php echo (in_array('Email address is required.', $form_errors) || in_array('Please enter a valid email address.', $form_errors)) ? 'class="error"' : ''; ?>
            />
          </div>

          <div class="form-group">
            <label for="sender_message">Your Message</label>
            <textarea
              id="sender_message"
              name="sender_message"
              placeholder="Write your message here…"
              <?php echo in_array('Message cannot be empty.', $form_errors) ? 'class="error"' : ''; ?>
            ><?php echo val($old['message']); ?></textarea>
          </div>

          <?php if ($show_captcha): ?>
          <div class="captcha-box">
            <input type="checkbox" class="captcha-check" id="captcha_confirm" name="captcha_confirm" />
            <label class="captcha-label" for="captcha_confirm">I'm not a robot</label>
            <div class="captcha-logo">reCAPTCHA<br><span style="font-size:0.6rem">Privacy · Terms</span></div>
          </div>
          <?php endif; ?>

          <div class="submit-row">
            <button type="submit" class="btn-submit">
              <?php echo $show_captcha ? 'Confirm &amp; Send' : 'Send Message'; ?>
            </button>
          </div>

        </form>

      <?php endif; ?>
    </div>
  </div>

<?php require 'footer.php'; ?>
