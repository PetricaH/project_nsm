<?php require_once('config.php'); ?>

<?php require_once( ROOT_PATH . '/includes/heading.php'); ?>



    <title>Hreniuc Petrică</title>

</head>

<body>

    <?php include( ROOT_PATH . '/includes/navbar.php'); ?>

    <section id="hero_section">

        <div class="name_container">

            <div class="hreniuc">

                <span id="hreniuc_span">Hreniuc</span>

                <div class="petrica">

                    <span id="petrica_span">Petrica</span>

                </div>

            </div>

        </div>

        <img src="static/images/me.png" id="me_hero_section_img" alt="Me">

        <div class="hero_bg_top_layer"></div>

    </section>

    <section id="programming_section">

            <div class="programming_techs_container">

                <img src="static/images/square-pattern-white-v2.png" class="white_pattern" alt="">

                <img src="static/images/programming_techs_logos/git-icon.svg" class="programming_tech_img git_img" alt="">

                <img src="static/images/programming_techs_logos/github.svg" class="programming_tech_img github_img" alt="">

                <img src="static/images/programming_techs_logos/php-alt.svg" class="programming_tech_img php_img" alt="">

                <img src="static/images/programming_techs_logos/javascript.svg" class="programming_tech_img js_img" alt="">

                <img src="static/images/programming_techs_logos/css-3.svg" class="programming_tech_img css_img" alt="">

                <img src="static/images/programming_techs_logos/html-5.svg" class="programming_tech_img html_img" alt="">

            </div>

        <div class="programming_text_part">

            <h2>GOODLOOKING</h2>

            <span>MONEYMAKER</span>

            <div class="service_copy_container">

                <p>Have you ever felt the need to be seen by more people?</p>

                <p>You can do just that with minimal investment compared to the possible return, all through a website.</p>

                <p>If you have a business, or want to start a business, or want to establish yourself as a powerful brand on the market, a professional website can be your bnest choice.</p>

            </div>

            <div class="buttons_services_containers">

                <button>BOOK A CALL</button>

                <button>see my projects</button>

            </div>

        </div>

    </section>

    <section id="automation_section">

        <div class="background_images">

            <img src="static/images/brevo_screenshot.png" class="automation_bg brevo_bg" alt="Brevo Automation Example">

            <img src="static/images/zapier_screenshot.png" class="automation_bg zapier_bg" alt="Zapier Automation Example">

        </div>

        <div class="automation_content">

            <img src="static/images/automation_programs_logos/Brevo-Logo-1.svg" alt="Brevo Logo">

            <img src="static/images/automation_programs_logos/Make-Logo-RGB.svg" alt="Make Logo">

            <img src="static/images/automation_programs_logos/n8n_io.svg" alt="n8n.io Logo">

            <img src="static/images/automation_programs_logos/zapier.svg" alt="Zapier Logo">

        </div>

        <div class="automation_text_part">

            <h2>AUTOMATE IT</h2>

            <span>NOW</span>

            <div class="service_copy_container">

                <p>There are many steps in the relationship you have with your clients</p>

                <p>And many of those steps are repetitive.</p>

                <p>And spending very valuable time doing something repetitive is counterproductive.</p>

                <p>Depending on what you need to automate, there are different programs that can help you.</p>

            </div>

            <div class="buttons_services_containers">

                <button>BOOK A CALL</button>

                <button class="learn_to_automate_btn">learn to automate</button>

            </div>

        </div>

    </section>

    <section id="digital_art_section">

    <div class="digital_art_title_images">

        <div class="digital_art_text_part">

            <h2>A STORY</h2>

            <span>NICE</span>

            <div class="buttons_services_containers">

                <button><a href="artworks.php">SEE ALL</a></button>

            </div>

        </div>

    </div>

    <div class="most_recent_art_works" id="artworksGrid"></div>

    </section>



    <?php include( ROOT_PATH . '/includes/footer.php'); ?>