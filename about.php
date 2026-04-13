<?php
$current_page = 'about';
$page_title   = 'About Me';
require 'header.php';
?>

  <!-- PAGE 2 · About -->
  <div class="hero">
    <h1>A Little <span>About Me</span></h1>

    <div class="divider"></div>

    <div class="about-split">
      <div class="about-left">
        <div class="profile-pic-container">
          <img src="images/pfp.jpg" alt="Profile Picture" class="profile-pic" />
        </div>
        <p class="profile-desc">
          I'm an aspiring developer passionate about learning and improving in
          the field of Computer Science. I focus on building my skills through
          practice, projects, and staying curious about how technology works.
        </p>
      </div>

      <div class="about-right">
        <div class="resume-section">
          <h2>SKILLS</h2>
          <div class="resume-content">
            <p><strong>Languages:</strong> Python, R, Java, C#, TypeScript, JavaScript, SQL</p>
            <p><strong>Frameworks and Databases:</strong> Next.js, React, Supabase, SQLite, Node.js</p>
            <p><strong>AI & Libraries:</strong> LLM Integration, Prompt Engineering, NumPy, Pandas</p>
            <p><strong>DevOps & Testing:</strong> Git, GitHub</p>
          </div>
        </div>

        <div class="resume-section">
          <h2>EDUCATION</h2>
          <div class="resume-content">
            <div class="resume-item">
              <h3>Bachelor of Science in Computer Science / Master in Data Science</h3>
              <span class="resume-date">2024 - 2028</span>
              <p>Angeles University Foundation Pampanga, Angeles City</p>
              <p><em>Barbara Yap Angeles (BYA) Scholarship</em></p>
            </div>
          </div>
        </div>

        <div class="resume-section">
          <h2>WORK EXPERIENCE</h2>
          <div class="resume-content">
            <div class="resume-item">
              <h3>Corresponding Author and Team Leader</h3>
              <span class="resume-date">2024 - 2028</span>
              <p><strong>AUF MAGNUS Research Hub Pampanga, Angeles City</strong></p>
              <p>The Center for Advanced Research and Innovation (CARI) is a research center under the Office of the Vice President for Research and Innovation (OVPRI) at Angeles University Foundation, established to foster innovation-driven and data-informed research across disciplines.</p>
              <p>Overseeing the entire process from development to writing the publication for Fee-Ver 2.0, an AI-powered hospital billing verification system adopted as a university research. The system unveils prices variances of 150-200% across hospitals and supporting a system targetting 4.2M HMO beneficiaries.</p>
            </div>
          </div>
        </div>

        <div class="resume-section">
          <h2>PROJECTS</h2>
          <div class="resume-content">
            <div class="resume-item">
              <h3>Fee-Ver 1.0 <span class="resume-highlight">(1st Runner-Up, Alibaba Cloud Philippines AI Hackathon 2025)</span></h3>
              <p>Aggregated and engineered a benchmark pricing database from 14-15 open-source public hospital data across the Philippines, powering an AI-driven billing summarizer and discrepancy detector. Currently, being expanded to a published research paper.</p>
            </div>
            <div class="resume-item">
              <h3>ThynkSpace <span class="resume-highlight">(1st Runner-Up, Google Developer Groups HackFest 2026: Axis)</span></h3>
              <p>Conceptualized and developed the zero-friction, AI-powered research companion to bridge the gap between vast data and human insight through verified AI synthesis, in order to streamline student workflow and research progress.</p>
            </div>
          </div>
        </div>

        <div class="resume-section">
          <h2>AWARDS & SCHOLARSHIPS</h2>
          <div class="resume-content">
            <ul class="resume-list">
              <li><strong>1st Runner-Up, Alibaba Cloud Philippines AI Hackathon</strong> - Alibaba Cloud Philippines</li>
              <li><strong>1st Runner-Up, AUF MAGNUS RDLead Competition</strong> - Center for Advanced Research Innovation (CARI)</li>
              <li><strong>1st Runner-Up, HackFest 2026: Axis</strong> - Google Developer Groups</li>
            </ul>
          </div>
        </div>

        <div class="resume-section">
          <h2>VOLUNTEERING & LEADERSHIP</h2>
          <div class="resume-content">
            <div class="resume-item">
              <h3>Secretary</h3>
              <p><strong>HonSoc (Honor Society) AUF CCS</strong></p>
              <p>Adminstered correspondence, scheduling, task delegation, and record-keeping for organization efficiency catered to the Angeles University Foundation College of Computer Studies Students with academic scholarships and high GWA.</p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

<?php require 'footer.php'; ?>
