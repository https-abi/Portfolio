<?php
// ── Helper: active nav class ──────────────────────────────────
function nav_class(string $link, string $current): string {
    return $link === $current ? ' class="active"' : '';
}

// ── Helper: safe value output ─────────────────────────────────
function val(string $v): string {
    return htmlspecialchars($v, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Abigail's Portfolio · <?php echo htmlspecialchars($page_title ?? 'Home'); ?></title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="styles.css"/>
</head>
<body>

<!-- ── Decorative sparkles ── -->
<div class="deco-star" style="top:18%;left:6%;">✦</div>
<div class="deco-star" style="top:42%;left:3%;font-size:1.8rem;">⚡</div>
<div class="deco-star" style="top:70%;left:7%;font-size:2.2rem;">☆</div>
<div class="deco-star" style="top:12%;right:5%;font-size:3.5rem;">✦</div>
<div class="deco-star" style="top:35%;right:3%;font-size:1.9rem;">✦</div>
<div class="deco-star" style="top:60%;right:6%;font-size:2.1rem;">☆</div>
<div class="deco-star" style="bottom:15%;left:5%;font-size:1.6rem;">✦</div>
<div class="deco-star" style="bottom:10%;right:4%;font-size:2.5rem;">☆</div>

<!-- ── Navigation ─────────────────────────────────────────── -->
<nav>
  <a class="nav-logo" href="index.php">Abigail's Portfolio</a>
  <ul class="nav-links">
    <li><a href="index.php"<?php echo nav_class('home', $current_page); ?>>Home</a></li>
    <li><a href="about.php"<?php echo nav_class('about', $current_page); ?>>About</a></li>
    <li><a href="contact.php"<?php echo nav_class('contact', $current_page); ?>>Contact</a></li>
  </ul>
</nav>

<div class="page">
