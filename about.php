<?php
$current_page = 'about';
$page_title   = 'About Me';
require 'header.php';
?>

  <!-- PAGE 2 · About -->
  <div class="hero">
    <span class="tag">Get to know me</span>

    <h1>A Little</h1>
    <h1 class="accent-line">About Me</h1>

    <div class="divider"></div>

    <p class="subtitle">
      I'm an aspiring developer passionate about learning and improving in
      the field of Computer Science. I focus on building my skills through
      practice, projects, and staying curious about how technology works.
    </p>

    <div class="about-grid">
      <?php
      $cards = [
        [
          'icon_class' => 'pink',
          'icon'       => '🎯',
          'title'      => 'What I Do',
          'desc'       => 'I’m a Computer Science student focused on developing practical applications and improving my problem-solving skills through hands-on programming projects.',
        ],
        [
          'icon_class' => 'sage',
          'icon'       => '🔧',
          'title'      => 'My Skills',
          'desc'       => 'Java, Python, JavaScript, and TypeScript; UI design using HTML, CSS, and Tailwind; R for data-related tasks; strong problem-solving and algorithmic thinking. I also leverage AI tools to enhance development efficiency, debugging, and idea generation.',
        ],
        [
          'icon_class' => 'blush',
          'icon'       => '💡',
          'title'      => 'My Interests',
          'desc'       => 'I enjoy building interactive systems, exploring how software works, improving my coding skills, and working on projects that solve real-world problems.',
        ],
      ];
      foreach ($cards as $card): ?>
        <div class="card">
          <div class="card-icon <?php echo $card['icon_class']; ?>">
            <span><?php echo $card['icon']; ?></span>
          </div>
          <h3><?php echo htmlspecialchars($card['title']); ?></h3>
          <p><?php echo htmlspecialchars($card['desc']); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

<?php require 'footer.php'; ?>
