<?php require_once('config.php'); ?>
<?php require_once(ROOT_PATH . '/includes/heading.php'); ?>

<?php $page_css = 'webdev.css';?>
<title>Servicii de Dezvoltare Web | Transformă-ți Afacerea Online | Hreniuc Petrică</title>
<meta name="description" content="Obține un site web care generează cu adevărat lead-uri și vânzări. Soluții de dezvoltare web personalizate construite pentru afacerile românești cu ROI garantat. Consultație gratuită disponibilă.">
</head>

<body data-context="webdev">

<?php include(ROOT_PATH . '/includes/navbar.php'); ?>

<main>
    <!-- Enhanced Hero Section -->
    <section class="hero_webdev_section">
        <div class="gradient_overlay_webdev"></div>
        
        <div class="webdev_hero_content">
            <div class="hero-badge">
                <span>De Încredere pentru Peste 50 de Afaceri Românești</span>
            </div>
            <h1>Obține un Site Web Care Chiar Îți Dezvoltă Afacerea</h1>
            <p>Nu doar un alt site frumos. Construiesc soluții web personalizate care oferă rezultate reale pentru afaceri: mai multe lead-uri, mai multe vânzări și un ROI măsurabil.</p>
            
            <div class="hero-cta-group">
                <button onclick="openBookingModal()" class="primary-cta-button">Obține Sesiunea Gratuită de Strategie <span class="arrow-right">→</span></button>
                <button onclick="scrollToElement('free_audit_section')" class="secondary-cta-button">Încearcă Auditul Gratuit de Website</button>
            </div>
            
            <div class="hero-proof">
                <div class="proof-item">
                    <span class="proof-number">97%</span>
                    <span class="proof-text">Satisfacția Clienților</span>
                </div>
                <div class="proof-divider"></div>
                <div class="proof-item">
                    <span class="proof-number">40%</span>
                    <span class="proof-text">Creștere Medie a Conversiei</span>
                </div>
                <div class="proof-divider"></div>
                <div class="proof-item">
                    <span class="proof-number">3-5x</span>
                    <span class="proof-text">Returnare a Investiției</span>
                </div>
            </div>
        </div>
    </section>

    <!-- NEW: Authority Proof Section -->
    <section class="authority_proof_section">
        <div class="container">
            <div class="authority-logos">
                <p>Tehnologii și certificări de încredere:</p>
                <div class="logo-carousel">
                    <img src="static/images/programming_techs_logos/laravel.svg" alt="Laravel Certificat">
                    <img src="static/images/programming_techs_logos/vue.svg" alt="Vue.js">
                    <img src="static/images/programming_techs_logos/mysql.svg" alt="MySQL">
                    <img src="static/images/programming_techs_logos/php-alt.svg" alt="PHP">
                    <img src="static/images/programming_techs_logos/javascript.svg" alt="JavaScript">
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced Problem-Solution Section -->
    <section class="problem_solution_section">
        <div class="container">
            <div class="section-header">
                <h2>Site-ul Tău Actual Este...</h2>
                <div class="section-divider"></div>
            </div>

            <div class="problems-grid">
                <div class="problem-card">
                    <div class="problem-icon">
                        <span class="material-symbols-outlined">visibility_off</span>
                    </div>
                    <h3>Invizibil pentru clienți?</h3>
                    <p>Te confrunți cu trafic redus și poziții slabe în motoarele de căutare, în ciuda conținutului și serviciilor de calitate.</p>
                </div>
                
                <div class="problem-card">
                    <div class="problem-icon">
                        <span class="material-symbols-outlined">emergency</span>
                    </div>
                    <h3>Nu convertește vizitatorii?</h3>
                    <p>Primești trafic, dar vizitatorii pleacă fără să ia măsuri sau să contacteze afacerea ta.</p>
                </div>
                
                <div class="problem-card">
                    <div class="problem-icon">
                        <span class="material-symbols-outlined">phone_disabled</span>
                    </div>
                    <h3>Nu este optimizat pentru mobil?</h3>
                    <p>Pierzi clienți potențiali pentru că site-ul tău arată defect sau este dificil de utilizat pe smartphone-uri.</p>
                </div>
                
                <div class="problem-card">
                    <div class="problem-icon">
                        <span class="material-symbols-outlined">speed</span>
                    </div>
                    <h3>Extrem de lent?</h3>
                    <p>Frustrezi vizitatorii cu timpi lungi de încărcare, determinându-i să părăsească site-ul înainte de a interacționa.</p>
                </div>
            </div>

            <div class="solution-box">
                <h3>Pot rezolva aceste probleme pentru afacerea ta</h3>
                <p>Abordarea mea de dezvoltare web se concentrează pe crearea de site-uri web care nu doar arată profesional, ci chiar generează rezultate pentru afaceri. Hai să transformăm prezența ta online în cel mai eficient instrument de vânzări.</p>
                <button onclick="openBookingModal()" class="solution-cta">Programează Sesiunea Gratuită de Strategie</button>
            </div>
        </div>
    </section>

    <!-- NEW: Free Website Audit Section -->
    <section id="free_audit_section" class="free_audit_section">
        <div class="container">
            <div class="audit-container">
                <div class="audit-content">
                    <h2>Obține Auditul Gratuit al Site-ului Tău</h2>
                    <p>Descoperă cum performează site-ul tău în raport cu peste 20 de factori critici care afectează traficul, rata de conversie și experiența utilizatorilor.</p>
                    
                    <ul class="audit-benefits">
                        <li><span class="check-icon">✓</span> Analiză tehnică SEO</li>
                        <li><span class="check-icon">✓</span> Sfaturi de optimizare a performanței</li>
                        <li><span class="check-icon">✓</span> Verificare a responsivității pentru mobil</li>
                        <li><span class="check-icon">✓</span> Recomandări de îmbunătățire a conversiei</li>
                    </ul>
                    
                    <div class="audit-guarantee">
                        <span class="guarantee-icon">🔒</span>
                        <p>Fără obligații. Fără spam. Doar informații practice pe care le poți folosi imediat.</p>
                    </div>
                </div>
                
                <div class="audit-form">
                    <form id="auditForm" action="includes/submit_audit.php" method="POST">
                        <div class="form-group">
                            <label for="audit-name">Numele Tău</label>
                            <input type="text" id="audit-name" name="name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="audit-email">Email de Afaceri</label>
                            <input type="email" id="audit-email" name="email" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="audit-website">URL-ul Site-ului Tău</label>
                            <input type="url" id="audit-website" name="website" required placeholder="https://www.site-ul-tau.ro">
                        </div>
                        
                        <div class="form-checkbox">
                            <input type="checkbox" id="audit-consent" name="consent" required>
                            <label for="audit-consent">Sunt de acord să primesc raportul gratuit de audit prin email</label>
                        </div>
                        
                        <button type="submit" class="audit-submit">Obține Auditul Meu Gratuit <span class="arrow-right">→</span></button>
                    </form>
                    
                    <div class="form-trust">
                        <div class="trust-badge">
                            <span class="material-symbols-outlined">verified_user</span>
                            <span>100% Sigur & Confidențial</span>
                        </div>
                        <div class="form-testimonial">
                            <p>"Auditul a dezvăluit probleme critice despre care nu știam că există. După implementarea recomandărilor, rata noastră de conversie a crescut cu 28%."</p>
                            <span class="testimonial-author">— Alexandru Popa, CEO la TechRomania</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced Services Section with Business Benefits -->
    <section class="webdev_services_section">
        <div class="container">
            <div class="section-header">
                <h2>Soluții Web Care Stimulează Creșterea Afacerii</h2>
                <div class="section-divider"></div>
                <p class="section-description">Servicii de dezvoltare web personalizate, concepute pentru a rezolva provocări specifice de afaceri și a livra rezultate măsurabile</p>
            </div>

            <div class="services-grid">
                <div class="service-card">
                    <div class="service-content">
                        <div class="service-header">
                            <div class="service-icon">
                                <span class="material-symbols-outlined">shopping_cart</span>
                            </div>
                            <h3>Soluții E-commerce</h3>
                        </div>
                        <p>Transformă vizitatorii în cumpărători cu un magazin online proiectat pentru vânzări maxime și o experiență fluidă pentru client.</p>
                        
                        <div class="service-benefits">
                            <h4>Beneficii pentru Afacere:</h4>
                            <ul>
                                <li>Creșterea valorii medii a comenzii cu 35%</li>
                                <li>Reducerea abandonului coșului cu 25%</li>
                                <li>Eficientizarea gestionării stocurilor</li>
                            </ul>
                        </div>
                        
                        <div class="starting-price">
                            <span>Începând de la 1.500 €</span>
                        </div>
                        
                        <button onclick="openBookingModal('E-commerce')" class="service-cta">Discută Despre Proiectul Tău E-commerce</button>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-content">
                        <div class="service-header">
                            <div class="service-icon">
                                <span class="material-symbols-outlined">business</span>
                            </div>
                            <h3>Site-uri pentru Afaceri</h3>
                        </div>
                        <p>Stabilește autoritatea și generează lead-uri de calitate cu un site web profesional optimizat pentru conversii.</p>
                        
                        <div class="service-benefits">
                            <h4>Beneficii pentru Afacere:</h4>
                            <ul>
                                <li>Creștere cu 40% a lead-urilor calificate</li>
                                <li>Îmbunătățirea credibilității brandului</li>
                                <li>Vizibilitate pentru afacere 24/7</li>
                            </ul>
                        </div>
                        
                        <div class="starting-price">
                            <span>Începând de la 900 €</span>
                        </div>
                        
                        <button onclick="openBookingModal('Business Website')" class="service-cta">Discută Despre Site-ul Tău de Afaceri</button>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-content">
                        <div class="service-header">
                            <div class="service-icon">
                                <span class="material-symbols-outlined">dashboard</span>
                            </div>
                            <h3>Interfețe Administrative</h3>
                        </div>
                        <p>Economisește timp și reduce erorile cu panouri de control personalizate și sisteme de management care eficientizează operațiunile.</p>
                        
                        <div class="service-benefits">
                            <h4>Beneficii pentru Afacere:</h4>
                            <ul>
                                <li>Reducerea costurilor administrative cu 50%</li>
                                <li>Îmbunătățirea acurateței datelor cu 85%</li>
                                <li>Eliberarea a peste 20 de ore săptămânal</li>
                            </ul>
                        </div>
                        
                        <div class="starting-price">
                            <span>Începând de la 2.000 €</span>
                        </div>
                        
                        <button onclick="openBookingModal('Administrative Interface')" class="service-cta">Discută Despre Panoul Tău de Administrare</button>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-content">
                        <div class="service-header">
                            <div class="service-icon">
                                <span class="material-symbols-outlined">speed</span>
                            </div>
                            <h3>Optimizare Performanță</h3>
                        </div>
                        <p>Transformă site-ul tău lent și cu performanțe slabe într-un activ de afaceri rapid și orientat spre conversii.</p>
                        
                        <div class="service-benefits">
                            <h4>Beneficii pentru Afacere:</h4>
                            <ul>
                                <li>Reducerea ratei de abandon cu 38%</li>
                                <li>Îmbunătățirea poziționării în căutări cu 45%</li>
                                <li>Creșterea ratei de conversie cu 27%</li>
                            </ul>
                        </div>
                        
                        <div class="starting-price">
                            <span>Începând de la 600 €</span>
                        </div>
                        
                        <button onclick="openBookingModal('Performance Optimization')" class="service-cta">Optimizează-ți Site-ul Web</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- NEW: Results Showcase (Client Testimonials) -->
    <section class="results_showcase_section">
        <div class="container">
            <div class="section-header">
                <h2>Rezultate Reale pentru Afaceri Reale</h2>
                <div class="section-divider"></div>
                <p class="section-description">Nu lua doar cuvântul meu. Iată ce spun clienții mei despre experiența lor și rezultatele obținute.</p>
            </div>

            <div class="testimonials-container">
                <div class="testimonial-card">
                    <div class="testimonial-rating">
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                    </div>
                    <p class="testimonial-text">"Colaborarea cu Petrică ne-a transformat prezența online. Rata de conversie a magazinului nostru a crescut cu 42% în doar două luni de la lansarea noului site. ROI-ul a fost excepțional."</p>
                    <div class="testimonial-client">
                        <img src="static/images/clients/maria-popescu.jpg" alt="Maria Popescu" class="client-photo">
                        <div class="client-info">
                            <h4>Maria Popescu</h4>
                            <p>Director de Marketing, FashionRO</p>
                        </div>
                    </div>
                    <div class="testimonial-metrics">
                        <div class="metric">
                            <span class="metric-value">42%</span>
                            <span class="metric-label">Creștere a Ratei de Conversie</span>
                        </div>
                        <div class="metric">
                            <span class="metric-value">3.5x</span>
                            <span class="metric-label">ROI</span>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="testimonial-rating">
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                    </div>
                    <p class="testimonial-text">"Panoul de administrare personalizat pe care Petrică l-a construit pentru noi a eliminat nenumărate ore de muncă manuală. Ceea ce înainte lua echipei noastre 5 ore zilnic, acum durează doar 30 de minute. Sistemul s-a amortizat de multe ori."</p>
                    <div class="testimonial-client">
                        <img src="static/images/clients/andrei-dumitrescu.jpg" alt="Andrei Dumitrescu" class="client-photo">
                        <div class="client-info">
                            <h4>Andrei Dumitrescu</h4>
                            <p>Manager Operațiuni, LogisticsPro</p>
                        </div>
                    </div>
                    <div class="testimonial-metrics">
                        <div class="metric">
                            <span class="metric-value">90%</span>
                            <span class="metric-label">Timp Economisit</span>
                        </div>
                        <div class="metric">
                            <span class="metric-value">5x</span>
                            <span class="metric-label">ROI</span>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="testimonial-rating">
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                    </div>
                    <p class="testimonial-text">"După optimizarea site-ului nostru existent, traficul organic a crescut cu 78% în doar 3 luni. Lead-urile lunare s-au dublat, iar site-ul nostru se încarcă acum în mai puțin de 2 secunde. Munca lui Petrică a avut un impact imediat și măsurabil."</p>
                    <div class="testimonial-client">
                        <img src="static/images/clients/elena-ionescu.jpg" alt="Elena Ionescu" class="client-photo">
                        <div class="client-info">
                            <h4>Elena Ionescu</h4>
                            <p>CEO, ConsultRomania</p>
                        </div>
                    </div>
                    <div class="testimonial-metrics">
                        <div class="metric">
                            <span class="metric-value">78%</span>
                            <span class="metric-label">Creștere Trafic</span>
                        </div>
                        <div class="metric">
                            <span class="metric-value">2x</span>
                            <span class="metric-label">Generare Lead-uri</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="testimonial-cta">
                <p>Alătură-te acestor clienți mulțumiți și transformă-ți prezența online</p>
                <button onclick="openBookingModal()" class="testimonial-button">Programează Sesiunea Gratuită de Strategie</button>
            </div>
        </div>
    </section>
    
   <!-- Enhanced Case Studies Section that uses your database projects -->
    <section class="case_studies_section">
        <div class="container">
            <div class="section-header">
                <h2>Povești de Succes</h2>
                <div class="section-divider"></div>
                <p class="section-description">Proiecte reale, provocări reale, rezultate reale</p>
            </div>

            <div class="case-studies-container">
                <?php
                // Fetch projects from database
                $sql = "SELECT * FROM webdev_projects ORDER BY created_at DESC LIMIT 3";
                $result = $conn->query($sql);
                
                if ($result && $result->num_rows > 0) {
                    while ($project = $result->fetch_assoc()) { 
                        // Get technologies as an array
                        $technologies = explode(',', $project['technologies']);
                        
                        // Format date for display
                        $project_date = date('F Y', strtotime($project['created_at']));
                        
                        // Prepare category badge
                        $category_badge = $project['category'];
                ?>
                    <div class="case-study-card">
                        <div class="case-study-image">
                            <img src="<?php echo htmlspecialchars($project['image_url']); ?>" alt="<?php echo htmlspecialchars($project['title']); ?>">
                            <div class="case-category"><?php echo htmlspecialchars($category_badge); ?></div>
                        </div>
                        <div class="case-content">
                            <h3><?php echo htmlspecialchars($project['title']); ?></h3>
                            
                            <div class="case-challenge">
                                <h4>Provocare:</h4>
                                <p><?php echo htmlspecialchars($project['short_description']); ?></p>
                            </div>
                            
                            <?php 
                            // Display project results if available
                            if (!empty($project['results'])) {
                                $results = json_decode($project['results'], true);
                                if ($results && is_array($results) && !empty($results)) {
                            ?>
                            <div class="case-results">
                                <?php foreach ($results as $result_item) { ?>
                                <div class="result-metric">
                                    <span class="result-value"><?php echo htmlspecialchars($result_item['value']); ?></span>
                                    <span class="result-label"><?php echo htmlspecialchars($result_item['label']); ?></span>
                                </div>
                                <?php } ?>
                            </div>
                            <?php 
                                }
                            } else {
                                // If no results available, show technologies
                            ?>
                            <div class="case-tech">
                                <h4>Tehnologii:</h4>
                                <div class="tech-tags">
                                    <?php foreach ($technologies as $tech) { ?>
                                    <span class="tech-tag"><?php echo htmlspecialchars(trim($tech)); ?></span>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php } ?>
                            
                            <button class="view-case-btn" data-project-id="<?php echo $project['project_id']; ?>">Vezi Studiul de Caz Complet</button>
                        </div>
                    </div>
                <?php 
                    }
                } else {
                    // Display fallback message if no projects
                ?>
                    <div class="no-case-studies">
                        <p>Studiile de caz sunt în curs de pregătire. Revino în curând pentru exemple detaliate de proiecte și rezultate.</p>
                        <button onclick="openBookingModal()" class="case-cta-button">Discută Proiectul Tău Acum</button>
                    </div>
                <?php } ?>
            </div>
            
            <div class="case-study-cta">
                <p>Vrei să vezi cum te pot ajuta să obții rezultate similare pentru afacerea ta?</p>
                <button onclick="openBookingModal()" class="testimonial-button">Programează Sesiunea Gratuită de Strategie</button>
            </div>
        </div>
    </section>

    <!-- NEW: Free Resource Lead Magnet Section -->
    <section class="free_resource_section">
        <div class="container">
            <div class="resource-container">
                <div class="resource-content">
                    <div class="resource-badge">GHID GRATUIT</div>
                    <h2>Cadrul de Conversie pentru Site-uri Web în 7 Pași</h2>
                    <p>Descoperă strategiile exacte pe care le folosesc pentru a crește ratele de conversie ale site-urilor web cu o medie de 40% pentru clienții mei.</p>
                    
                    <ul class="resource-features">
                        <li><span class="check-icon">✓</span> Cum să identifici și să rezolvi cele mai mari probleme de conversie</li>
                        <li><span class="check-icon">✓</span> Psihologia din spatele design-ului web cu conversie ridicată</li>
                        <li><span class="check-icon">✓</span> 5 elemente esențiale pentru orice site web de afaceri</li>
                        <li><span class="check-icon">✓</span> Exemple din lumea reală cu rezultate înainte/după</li>
                    </ul>
                </div>
                
                <div class="resource-form">
                    <div class="resource-preview">
                        <img src="static/images/resources/conversion-guide-preview.png" alt="Ghid Cadru de Conversie pentru Site-uri Web">
                    </div>
                    
                    <form id="resourceForm" action="includes/download_resource.php" method="POST">
                        <div class="form-group">
                            <label for="resource-name">Numele Tău</label>
                            <input type="text" id="resource-name" name="name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="resource-email">Email pentru Trimiterea Ghidului</label>
                            <input type="email" id="resource-email" name="email" required>
                        </div>
                        
                        <div class="form-checkbox">
                            <input type="checkbox" id="resource-consent" name="consent" required>
                            <label for="resource-consent">Sunt de acord să primesc ghidul gratuit și ocazional sfaturi valoroase</label>
                        </div>
                        
                        <button type="submit" class="resource-submit">Descarcă Ghidul Gratuit <span class="arrow-right">→</span></button>
                    </form>
                    
                    <div class="downloads-count">
                        <span class="material-symbols-outlined">download</span>
                        <p>Descărcat de 1.287 de proprietari de afaceri</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced Process Section -->
    <section class="webdev_process_section">
        <div class="container">
            <div class="section-header">
                <h2>Procesul Meu Dovedit de Dezvoltare</h2>
                <div class="section-divider"></div>
                <p class="section-description">O abordare structurată care asigură rezultate de calitate și ROI maxim pentru fiecare proiect</p>
            </div>
            
            <div class="process-timeline">
                <div class="timeline-item">
                    <div class="timeline-number">01</div>
                    <div class="timeline-content">
                        <h3>Descoperire & Strategie</h3>
                        <p>Analizez obiectivele afacerii tale, publicul țintă și peisajul competitiv pentru a crea un plan strategic pentru proiectul tău web.</p>
                        <div class="timeline-benefits">
                            <span class="benefit-tag">Direcție clară</span>
                            <span class="benefit-tag">Abordare țintită</span>
                            <span class="benefit-tag">Focus pe ROI</span>
                        </div>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-number">02</div>
                    <div class="timeline-content">
                        <h3>Design UX & Prototipare</h3>
                        <p>Crearea de wireframe-uri și design-uri vizuale optimizate pentru conversie, implicarea utilizatorilor și consistența brandului pe toate dispozitivele.</p>
                        <div class="timeline-benefits">
                            <span class="benefit-tag">Orientat spre conversie</span>
                            <span class="benefit-tag">Ușor de folosit</span>
                            <span class="benefit-tag">Optimizat pentru mobil</span>
                        </div>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-number">03</div>
                    <div class="timeline-content">
                        <h3>Dezvoltare & Integrare</h3>
                        <p>Construirea site-ului tău cu cod curat și eficient, asigurând în același timp performanță, securitate și integrare perfectă cu sistemele tale de afaceri.</p>
                        <div class="timeline-benefits">
                            <span class="benefit-tag">Performanță înaltă</span>
                            <span class="benefit-tag">Cod securizat</span>
                            <span class="benefit-tag">Integrare sistemică</span>
                        </div>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-number">04</div>
                    <div class="timeline-content">
                        <h3>Testare & Optimizare</h3>
                        <p>Asigurarea calității riguroasă pe toate dispozitivele și browserele, plus optimizarea ratei de conversie pentru a maximiza rezultatele de afaceri.</p>
                        <div class="timeline-benefits">
                            <span class="benefit-tag">Testare cross-browser</span>
                            <span class="benefit-tag">Optimizare viteză</span>
                            <span class="benefit-tag">Testare conversii</span>
                        </div>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-number">05</div>
                    <div class="timeline-content">
                        <h3>Lansare & Suport pentru Creștere</h3>
                        <p>Implementare lină și suport continuu pentru a asigura că site-ul tău continuă să performeze și să evolueze odată cu nevoile afacerii tale.</p>
                        <div class="timeline-benefits">
                            <span class="benefit-tag">Lansare fără probleme</span>
                            <span class="benefit-tag">Monitorizare performanță</span>
                            <span class="benefit-tag">Actualizări pentru creștere</span>
                        </div>
                        
                        <div class="timeline-cta">
                            <button onclick="openBookingModal()" class="timeline-button">Începe Proiectul Tău Astăzi</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- NEW: FAQ Section -->
    <section class="faq_section">
        <div class="container">
            <div class="section-header">
                <h2>Întrebări Frecvente</h2>
                <div class="section-divider"></div>
            </div>
            
            <div class="faq-container">
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Cât durează construirea unui site web?</h3>
                        <span class="toggle-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Termenele variază în funcție de complexitatea proiectului. Un site web standard pentru afaceri durează de obicei 3-5 săptămâni de la început până la final. Site-urile de e-commerce necesită de obicei 6-8 săptămâni, în timp ce aplicațiile personalizate pot dura 8-12 săptămâni. În timpul consultației inițiale, voi oferi un termen specific pentru proiectul tău.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Cât costă un site web?</h3>
                        <span class="toggle-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Investiția variază în funcție de nevoile specifice ale afacerii tale și cerințele proiectului. Site-urile web de bază pentru afaceri pornesc de la 900 €, soluțiile de e-commerce de la 1.500 €, iar interfețele administrative personalizate de la 2.000 €. Ofer oferte transparente și detaliate după înțelegerea scopului și obiectivelor proiectului tău.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Site-ul meu va fi optimizat pentru mobil?</h3>
                        <span class="toggle-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Absolut. Toate site-urile pe care le construiesc sunt complet responsive și optimizate pentru toate dispozitivele, inclusiv smartphone-uri, tablete și desktop-uri. Cu peste 60% din traficul web provenind de pe dispozitive mobile în România, optimizarea pentru mobil este o parte esențială a procesului meu de dezvoltare.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Oferiți mentenanță pentru site-uri web?</h3>
                        <span class="toggle-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Da, ofer pachete flexibile de mentenanță pentru a menține site-ul tău securizat, actualizat și performant optim. Pachetele includ actualizări regulate, monitorizarea securității, optimizarea performanței, actualizări de conținut și suport tehnic. Acest lucru asigură că site-ul tău rămâne un activ valoros pentru afacere pe termen lung.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Site-ul meu va fi optimizat pentru SEO?</h3>
                        <span class="toggle-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Da, cele mai bune practici SEO sunt integrate pe tot parcursul procesului de dezvoltare. Toate site-urile includ optimizări tehnice SEO, structură HTML semantică adecvată, markup schema, imagini optimizate și viteze rapide de încărcare. Acest lucru creează o bază solidă pentru eforturile tale SEO pentru a ajuta afacerea ta să se poziționeze mai bine în rezultatele căutărilor.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Pot actualiza site-ul web singur?</h3>
                        <span class="toggle-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Cu siguranță. Construiesc site-uri web cu sisteme de gestionare a conținutului ușor de utilizat, care îți permit să actualizezi cu ușurință texte, imagini, să adaugi pagini noi și să gestionezi articole de blog fără cunoștințe tehnice. De asemenea, ofer instruire și documentație pentru ca tu și echipa ta să puteți face actualizări cu încredere.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced CTA Section with Urgency -->
    <section class="webdev_cta_section">
        <div class="container">
            <div class="cta-container">
                <div class="limited-offer">
                    <span>Ofertă Limitată</span>
                </div>
                
                <h2>Programează Sesiunea Ta Gratuită de Strategie Astăzi</h2>
                <p>Planifică consultația ta fără obligații și primește o foaie de parcurs personalizată pentru site-ul tău (valoare de 350 €) gratuit. Doar 5 locuri disponibile luna aceasta.</p>
                
                <div class="cta-benefits">
                    <div class="cta-benefit">
                        <span class="material-symbols-outlined">check_circle</span>
                        <p>Analiză expertă a site-ului tău actual</p>
                    </div>
                    <div class="cta-benefit">
                        <span class="material-symbols-outlined">check_circle</span>
                        <p>Strategie personalizată bazată pe obiectivele afacerii tale</p>
                    </div>
                    <div class="cta-benefit">
                        <span class="material-symbols-outlined">check_circle</span>
                        <p>Plan clar de acțiune cu termene și buget</p>
                    </div>
                </div>
                
                <div class="availability">
                    <div class="calendar-icon">
                        <span class="material-symbols-outlined">calendar_month</span>
                    </div>
                    <div class="availability-text">
                        <p><strong>Următoarea consultație disponibilă:</strong> <?php echo date('l, F j', strtotime('+2 days')); ?></p>
                    </div>
                </div>
                
                <button onclick="openBookingModal()" class="cta-button">Asigură-ți Sesiunea de Strategie Acum</button>
                
                <div class="cta-guarantee">
                    <span class="guarantee-icon">🔒</span>
                    <p>Fără obligații. Fără vânzare agresivă. Doar informații valoroase pentru afacerea ta.</p>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Enhanced Booking Modal -->
<div id="bookingModal" class="booking-modal hidden">
    <div class="booking-modal-content">
        <span class="booking-modal-close" onclick="closeBookingModal()">&times;</span>
        
        <div class="booking-header">
            <h2>Programează Sesiunea Gratuită de Strategie</h2>
            <p>Obține sfaturi de expert și o foaie de parcurs personalizată pentru site-ul tău (<strong>valoare de 350 €</strong>) fără costuri</p>
        </div>
        
        <div class="booking-columns">
            <div class="booking-form-column">
                <form id="bookingForm" action="includes/submit_booking.php" method="POST">
                    <input type="hidden" id="booking-service-type" name="service_type" value="Web Development">
                    
                    <div class="booking-form-group">
                        <label for="booking-name">Numele Tău</label>
                        <input type="text" id="booking-name" name="name" required>
                    </div>
                    
                    <div class="booking-form-group">
                        <label for="booking-email">Email de Afaceri</label>
                        <input type="email" id="booking-email" name="email" required>
                    </div>
                    
                    <div class="booking-form-group">
                        <label for="booking-company">Companie</label>
                        <input type="text" id="booking-company" name="company">
                    </div>
                    
                    <div class="booking-form-group">
                        <label for="booking-phone">Număr de Telefon</label>
                        <input type="tel" id="booking-phone" name="phone" required>
                    </div>
                    
                    <div class="booking-form-group">
                        <label for="booking-service">Interes Servicii</label>
                        <select id="booking-service" name="service" required>
                            <option value="Web Development" selected>Dezvoltare Web</option>
                            <option value="E-commerce">Soluție E-commerce</option>
                            <option value="Business Website">Site Web de Afaceri</option>
                            <option value="Administrative Interface">Interfață Administrativă</option>
                            <option value="Performance Optimization">Optimizare Performanță</option>
                            <option value="Automation">Automatizare Afaceri</option>
                        </select>
                    </div>

                    <!-- Date and Time Selection -->
                    <div class="booking-form-row">
                        <div class="booking-form-group">
                            <label for="booking-date">Data Preferată</label>
                            <input type="date" id="booking-date" name="date" required>
                        </div>
                        <div class="booking-form-group">
                            <label for="booking-time">Ora Preferată</label>
                            <select id="booking-time" name="time" required>
                                <option value="16:30">16:30</option>
                                <option value="17:00">17:00</option>
                                <option value="17:30">17:30</option>
                                <option value="18:00">18:00</option>
                                <option value="18:30">18:30</option>
                                <option value="19:00">19:00</option>
                                <option value="19:30">19:30</option>
                                <option value="20:00">20:00</option>
                            </select>
                        </div>
                    </div>

                    <div class="booking-form-group">
                        <label for="booking-website">Site-ul Tău Web (dacă există)</label>
                        <input type="url" id="booking-website" name="website" placeholder="https://www.site-ul-tau.ro">
                    </div>

                    <div class="booking-form-group">
                        <label for="booking-description">Spune-mi despre obiectivele proiectului tău</label>
                        <textarea id="booking-description" name="description" rows="3" placeholder="Ce speri să realizezi cu site-ul tău web? Funcționalități sau provocări specifice?" required></textarea>
                    </div>
                    
                    <div class="booking-form-group">
                        <label for="booking-budget">Buget Aproximativ</label>
                        <select id="booking-budget" name="budget">
                            <option value="Under €1,000">Sub 1.000 €</option>
                            <option value="€1,000 - €3,000" selected>1.000 € - 3.000 €</option>
                            <option value="€3,000 - €5,000">3.000 € - 5.000 €</option>
                            <option value="€5,000 - €10,000">5.000 € - 10.000 €</option>
                            <option value="Over €10,000">Peste 10.000 €</option>
                        </select>
                    </div>
                    
                    <div class="booking-form-group">
                        <label for="booking-timeline">Termen Dorit</label>
                        <select id="booking-timeline" name="timeline">
                            <option value="Within 1 month">În decurs de o lună</option>
                            <option value="1-2 months" selected>1-2 luni</option>
                            <option value="3-6 months">3-6 luni</option>
                            <option value="No rush">Fără grabă</option>
                        </select>
                    </div>
                    
                    <div class="booking-form-group">
                        <input type="checkbox" id="privacy-policy" name="privacy_policy" required>
                        <label for="privacy-policy">
                            Sunt de acord cu <a href="privacy-policy.php" target="_blank">politica de confidențialitate</a> și îmi dau consimțământul pentru a fi contactat în legătură cu această solicitare.
                        </label>
                    </div>
                    
                    <div class="booking-form-group">
                        <button type="submit" class="booking-submit-btn">Asigură-mi Sesiunea de Strategie</button>
                    </div>
                </form>
            </div>
            
            <div class="booking-info-column">
                <div class="session-includes">
                    <h3>Sesiunea Ta de Strategie Include:</h3>
                    <ul>
                        <li><span class="check-icon">✓</span> Consultație video de 30 de minute</li>
                        <li><span class="check-icon">✓</span> Audit și feedback pentru site-ul actual</li>
                        <li><span class="check-icon">✓</span> Recomandări personalizate de soluții</li>
                        <li><span class="check-icon">✓</span> Estimare aproximativă a bugetului și termenului</li>
                        <li><span class="check-icon">✓</span> Foaie de parcurs personalizată pentru site (valoare 350 €)</li>
                    </ul>
                </div>
                
                <div class="booking-testimonial">
                    <p>"Doar sesiunea de strategie a oferit mai multă valoare decât luni de colaborare cu dezvoltatorul nostru web anterior. Sfaturile lui Petrică au fost practice și imediat aplicabile."</p>
                    <div class="booking-testimonial-author">
                        <img src="static/images/clients/stefan-muresan.jpg" alt="Stefan Muresan" class="author-photo">
                        <span>Stefan Muresan, CEO la TechStartRO</span>
                    </div>
                </div>
                
                <div class="spots-remaining">
                    <div class="spots-icon">
                        <span class="material-symbols-outlined">schedule</span>
                    </div>
                    <div class="spots-text">
                        <p><strong>Doar 5 locuri rămase luna aceasta</strong></p>
                        <p>Următoarea disponibilitate: <?php echo date('l, F j', strtotime('+2 days')); ?></p>
                    </div>
                </div>
                
                <div class="satisfaction-guarantee">
                    <div class="guarantee-icon">
                        <span class="material-symbols-outlined">verified</span>
                    </div>
                    <div class="guarantee-text">
                        <h3>Garanție 100% Satisfacție</h3>
                        <p>Dacă nu găsești sesiunea de strategie valoroasă, voi dona 100 € unei asociații caritabile la alegerea ta.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Case Study Modal -->
<div id="caseStudyModal" class="case-study-modal hidden">
    <div class="case-study-modal-content">
        <span class="case-modal-close">&times;</span>
        <div id="caseStudyContent">
            <!-- Case study content will be loaded dynamically -->
        </div>
    </div>
</div>

<!-- Notification Area -->
<div id="notification" class="hidden">
    <p id="notification-message"></p>
</div>

<!-- Exit Intent Popup -->
<div id="exitPopup" class="exit-popup hidden">
    <div class="exit-popup-content">
        <span class="exit-close">&times;</span>
        <div class="exit-offer">
            <h3>Înainte să Pleci!</h3>
            <h4>Obține Gratuit Lista de Verificare SEO pentru Afaceri Românești</h4>
            <p>21 de sfaturi practice pentru a-ți îmbunătăți poziționarea în căutările locale și a obține mai mult trafic de la clienții din România.</p>
            
            <form id="exitForm" action="includes/download_checklist.php" method="POST" class="exit-form">
                <div class="exit-form-group">
                    <input type="email" id="exit-email" name="email" placeholder="Adresa ta de email" required>
                    <button type="submit">Trimite-mi Lista de Verificare</button>
                </div>
                <div class="exit-consent">
                    <input type="checkbox" id="exit-consent" name="consent" required>
                    <label for="exit-consent">Sunt de acord să primesc lista de verificare gratuită</label>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Enhanced JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Booking modal functions
        function openBookingModal(service = '') {
            const modal = document.getElementById('bookingModal');
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Prevent scrolling
            
            // Pre-select service if provided
            if (service) {
                const serviceSelect = document.getElementById('booking-service');
                for (let i = 0; i < serviceSelect.options.length; i++) {
                    if (serviceSelect.options[i].value === service) {
                        serviceSelect.selectedIndex = i;
                        break;
                    }
                }
                
                // Also set the hidden input
                document.getElementById('booking-service-type').value = service;
            }
        }
        
        function closeBookingModal() {
            document.getElementById('bookingModal').classList.add('hidden');
            document.body.style.overflow = 'auto'; // Enable scrolling
        }
        
        // Set default date to tomorrow for booking form
        const dateInput = document.getElementById('booking-date');
        if (dateInput) {
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 2); // Start from day after tomorrow
            const formattedDate = tomorrow.toISOString().split('T')[0];
            dateInput.setAttribute('min', formattedDate);
            dateInput.value = formattedDate;
        }
        
        // FAQ accordion functionality
        const faqItems = document.querySelectorAll('.faq-item');
        
        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question');
            const answer = item.querySelector('.faq-answer');
            const icon = item.querySelector('.toggle-icon');

            question.addEventListener('click', () => {
                // Hide all other answers
                faqItems.forEach(otherItem => {
                    if (otherItem !== item) {
                        const otherAnswer = otherItem.querySelector('.faq-answer');
                        otherAnswer.style.display = 'none';
                        otherAnswer.style.maxHeight = null;
                        otherItem.querySelector('.toggle-icon').textContent = '+';
                    }
                });

                // Toggle current answer
                if (answer.style.display === 'block') {
                    answer.style.display = 'none';
                    answer.style.maxHeight = null;
                    icon.textContent = '+';
                } else {
                    answer.style.display = 'block';
                    answer.style.maxHeight = answer.scrollHeight + 'px';
                    icon.textContent = '−';
                }
            });
        });
        
        // Case Study Modal functionality
        const viewCaseButtons = document.querySelectorAll('.view-case-btn');
        const caseStudyModal = document.getElementById('caseStudyModal');
        const caseStudyContent = document.getElementById('caseStudyContent');
        const caseModalClose = document.querySelector('.case-modal-close');

        // Open case study modal when clicking view buttons
        viewCaseButtons.forEach(button => {
            button.addEventListener('click', function() {
                const projectId = this.dataset.projectId;
                
                // Show loading state
                caseStudyContent.innerHTML = '<div class="loading-state"><span class="spinner"></span> Se încarcă studiul de caz...</div>';
                caseStudyModal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
                
                // Fetch project details using AJAX
                fetch('includes/get_project_details.php?id=' + projectId)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const project = data.project;
                            const technologies = project.technologies.split(',').map(tech => tech.trim());
                            const projectDate = new Date(project.created_at).toLocaleDateString('ro-RO', {
                                year: 'numeric',
                                month: 'long'
                            });
                            
                            // Create modal content
                            let modalContent = `
                                <div class="full-case-study">
                                    <div class="case-study-header">
                                        <div class="case-category-badge">${project.category}</div>
                                        <h2>${project.title}</h2>
                                        <div class="case-meta">
                                            <span>Client: ${project.client}</span>
                                            <span>Data: ${projectDate}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="case-study-image">
                                        <img src="${project.image_url}" alt="${project.title}">
                                    </div>
                                    
                                    <div class="case-study-section">
                                        <h3>Provocarea</h3>
                                        <p>${project.short_description}</p>
                                    </div>
                                    
                                    <div class="case-study-section">
                                        <h3>Soluția</h3>
                                        <p>${project.description}</p>
                                    </div>`;
                            
                            // Add results section if available
                            if (project.results) {
                                try {
                                    const results = JSON.parse(project.results);
                                    if (results && results.length > 0) {
                                        modalContent += `
                                            <div class="case-study-results">
                                                <h3>Rezultatele</h3>
                                                <div class="results-metrics">`;
                                        
                                        results.forEach(result => {
                                            modalContent += `
                                                <div class="result-card">
                                                    <span class="result-value">${result.value}</span>
                                                    <span class="result-label">${result.label}</span>
                                                    ${result.description ? `<span class="result-description">${result.description}</span>` : ''}
                                                </div>`;
                                        });
                                        
                                        modalContent += `
                                                </div>
                                            </div>`;
                                    }
                                } catch (e) {
                                    console.error("Error parsing results JSON", e);
                                }
                            }
                            
                            // Add technologies section
                            modalContent += `
                                <div class="case-study-technologies">
                                    <h3>Tehnologii Utilizate</h3>
                                    <div class="tech-tags">`;
                            
                            technologies.forEach(tech => {
                                modalContent += `<span class="tech-tag">${tech}</span>`;
                            });
                            
                            modalContent += `
                                    </div>
                                </div>`;
                            
                            // Add live link if available
                            if (project.live_url) {
                                modalContent += `
                                    <div class="case-study-link">
                                        <a href="${project.live_url}" target="_blank" rel="noopener noreferrer" class="view-live-btn">
                                            Vezi Proiectul Live <span class="material-symbols-outlined">open_in_new</span>
                                        </a>
                                    </div>`;
                            }
                            
                            // Add CTA
                            modalContent += `
                                <div class="case-study-cta">
                                    <p>Vrei o soluție similară pentru afacerea ta?</p>
                                    <button onclick="openBookingModal('${project.category}')" class="case-cta-button">Programează Sesiunea Ta de Strategie</button>
                                </div>
                            </div>`;
                            
                            // Update modal content
                            caseStudyContent.innerHTML = modalContent;
                        } else {
                            // Show error
                            caseStudyContent.innerHTML = '<div class="error-state">Ne pare rău, acest studiu de caz nu a putut fi încărcat. Te rugăm să încerci din nou mai târziu.</div>';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching case study:', error);
                        caseStudyContent.innerHTML = '<div class="error-state">Ne pare rău, a apărut o eroare. Te rugăm să încerci din nou mai târziu.</div>';
                    });
            });
        });
        
        // Close modal when clicking the close button
        if (caseModalClose) {
            caseModalClose.addEventListener('click', function() {
                caseStudyModal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            });
        }
        
        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target === caseStudyModal) {
                caseStudyModal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        });
        
        // Exit Intent Popup
        const exitPopup = document.getElementById('exitPopup');
        const exitClose = document.querySelector('.exit-close');
        let showExitPopup = true;
        
        document.addEventListener('mouseout', function(e) {
            if (showExitPopup && e.clientY < 5 && !exitPopup.classList.contains('shown')) {
                exitPopup.classList.remove('hidden');
                exitPopup.classList.add('shown');
                showExitPopup = false; // Only show once per session
            }
        });
        
        if (exitClose) {
            exitClose.addEventListener('click', function() {
                exitPopup.classList.add('hidden');
                exitPopup.classList.remove('shown');
            });
        }
        
        // Close exit popup when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target === exitPopup) {
                exitPopup.classList.add('hidden');
                exitPopup.classList.remove('shown');
            }
        });
        
        // Smooth scroll function
        function scrollToElement(elementId) {
            const element = document.getElementById(elementId);
            if (element) {
                element.scrollIntoView({ behavior: 'smooth' });
            }
        }
        
        // Animation on scroll
        const animateElements = document.querySelectorAll('.service-card, .timeline-item, .testimonial-card, .case-study-card');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                }
            });
        }, {
            threshold: 0.1
        });
        
        animateElements.forEach(element => {
            observer.observe(element);
        });
        
        // Expose functions globally
        window.openBookingModal = openBookingModal;
        window.closeBookingModal = closeBookingModal;
        window.scrollToElement = scrollToElement;
    });
</script>

<?php include(ROOT_PATH . '/includes/footer.php'); ?>