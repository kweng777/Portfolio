<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quennie Barbarona Portfolio</title>
    <link href="https://fonts.googleapis.com/css2?family=New+Amsterdam&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header class="navbar">
        <div class="logo">
            PORTFOLIO
        </div>
        <nav class="nav-links">
            <a href="#" class="active">ABOUT</a>
            <a href="#">WORKS</a>
            <a href="#">SKILLS</a>
            <a href="#">CERTIFICATE</a>
            <a href="#">CONTACT</a>
        </nav>
    </header>

    <section class="hero">
        <div class="hero-content">
            <span class="badge">HEY THERE!</span>
            <h1>I'M QUENNIE BARBARONA</h1>
            <p>EAGER TO LEARN AND GROW IN I.T, AND<br>GRABBING EVERY OPPORTUNITY TO IMPROVE ME.</p>
            <button class="btn-see-more">
                SEE MORE
                <span class="btn-ring"></span>
            </button>
        </div>
        
        <div class="hero-image-container">

            <img src="<?php echo get_template_directory_uri(); ?>/images/background-frame.png" class="hero-frame">
            <!--<img src="portrait.png" class="hero-portrait"> -->

        </div>
    </section>

    <section class="works-section">
        <div class="works-inner-container">
            <div class="title-wrapper">
                <div class="title-bg-layer"></div>
                <div class="title-top-layer">MY WORKS</div>
            </div>

            <div class="projects-grid">
                <div class="project-card">
                    <div class="project-icon-badge empty"></div>

                    <div class="project-logo-2">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/dorsu-hris.png" alt="DORSU HRIS Logo">
                    </div>

                    <div class="project-info-label">
                        <h3>HR INFORMATION SYSTEM</h3>
                        <p>DICT INTERNSHIP ( IN-CAMPUS )</p>
                    </div>
                </div>


                <div class="project-card">
                    <div class="project-icon-badge empty"></div>

                    <div class="project-logo">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/thescap.png" alt="THESCAP Logo">
                    </div>

                    <div class="project-info-label">
                        <h3>THESCAP MANAGEMENT SYSTEM</h3>
                        <p>CAPSTONE PROJECT</p>
                    </div>
                </div>

                <div class="project-card">
                    <div class="project-icon-badge empty"></div>

                    <div class="project-logo-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/rcm.png" alt="RCM Logo">
                    </div>

                    <div class="project-info-label">
                        <h3>LOAN MANAGEMENT SYSTEM</h3>
                        <p>RYPACI INTERNSHIP ( OFF-CAMPUS )</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="skills-section">
    <div class="skills-container">
        
        <!-- Left Side: Pie Divided Circle -->
        <div class="skills-circle-wrapper">
            <div class="skills-pie-container">
                
                <!-- Frontend Wedge -->
                <div class="skill-wedge top">
                    <div class="wedge-content">
                        <i class="fa-solid fa-seedling"></i>
                        <span>Frontend</span>
                    </div>
                </div>

                <!-- Backend Wedge -->
                <div class="skill-wedge right">
                    <div class="wedge-content">
                        <i class="fa-solid fa-server"></i>
                        <span>Backend</span>
                    </div>
                </div>

                <!-- Soft Skills Wedge (Active/Highlighted) -->
                <div class="skill-wedge bottom active">
                    <div class="wedge-content">
                        <i class="fa-solid fa-users-gear"></i>
                        <span>Soft Skills</span>
                    </div>
                </div>

                <!-- Database Wedge -->
                <div class="skill-wedge left">
                    <div class="wedge-content">
                        <i class="fa-solid fa-database"></i>
                        <span>Database</span>
                    </div>
                </div>

                <!-- The floating center circle -->
                <div class="skills-inner-circle">
                    <span>Skills</span>
                </div>
            </div>
            <!-- Decorative outer ring from original image -->
            <div class="outer-ring-decoration"></div>
        </div>

        <!-- Right Side: Skill Progress Card -->
        <div class="soft-skills-card">
            <div class="card-header">
                <h2>Soft Skills</h2>
                <i class="fa-solid fa-flask-vial decorative-icon"></i>
            </div>
            <div class="progress-container">
                <div class="skill-bar-item">
                    <div class="skill-info"><span>ADAPTABLE & OPEN TO IDEAS</span><span>90%</span></div>
                    <div class="progress-line"><div class="fill" style="width: 90%;"></div></div>
                </div>
                <div class="skill-bar-item">
                    <div class="skill-info"><span>VERBAL & WRITTEN COMMUNICATION</span><span>85%</span></div>
                    <div class="progress-line"><div class="fill" style="width: 85%;"></div></div>
                </div>
                <div class="skill-bar-item">
                    <div class="skill-info"><span>EFFECTIVE TEAM COLLABORATOR</span><span>95%</span></div>
                    <div class="progress-line"><div class="fill" style="width: 95%;"></div></div>
                </div>
                <div class="skill-bar-item">
                    <div class="skill-info"><span>STRONG WORK ETHIC</span><span>100%</span></div>
                    <div class="progress-line"><div class="fill" style="width: 100%;"></div></div>
                </div>
                <div class="skill-bar-item">
                    <div class="skill-info"><span>WILLINGNESS TO LEARN</span><span>98%</span></div>
                    <div class="progress-line"><div class="fill" style="width: 98%;"></div></div>
                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>