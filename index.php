<?php
$current_page = 'home';
$page_title   = 'Home';
require 'header.php';
?>

  <!-- PAGE 1 · Home -->
  <div class="hero hero-home">

    <!-- LEFT: text content -->
    <div class="home-content">

      <!-- secondary nav row -->
      <div class="sub-nav">
        <span>portfolio</span>
        <span>✦</span>
        <span>resume</span>
        <span>✦</span>
        <span>works</span>
      </div>

      <!-- Big layered name -->
      <div class="home-title-wrap">
        <span class="home-title-top">ABIGAIL</span>
        <span class="home-title-script">Portfolio</span>
        <span class="home-title-ghost">ARNOLD</span>
      </div>

      <div class="divider" style="margin:1.25rem 0;"></div>

      <p class="subtitle" style="margin:0 0 2rem;text-align:left;">
        Welcome to my <em style="color:var(--accent);font-style:italic;">portfolio</em>
        where I showcase my skills, experience, and professional journey.
      </p>

      <div class="home-btns">
        <a class="btn btn-primary" href="about.php">About Me</a>
        <a class="btn btn-ghost"   href="contact.php">Get In Touch</a>
      </div>

    </div>

    <!-- RIGHT: hero photo -->
    <div class="home-photo-wrap">
      <img src="images/Arnold-header.jpeg" alt="Arnold Abigail" class="home-photo" />
    </div>

  </div>

<?php require 'footer.php'; ?>
