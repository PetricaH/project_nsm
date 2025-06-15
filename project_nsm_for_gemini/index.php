<?php require_once('config.php'); ?>
<?php require_once(ROOT_PATH . '/includes/heading.php'); ?>
<?php $page_css = 'home.css';?>
<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies
?>
<title>Hreniuc Petrică | Servicii de Dezvoltare Web & Automatizare</title>
</head>
<body>
    <?php include(ROOT_PATH . '/includes/navbar.php'); ?>

    <!-- Hero Section -->
    <section id="hero_section">
        <div class="hero-container">
            <div class="hero-content">
                <div class="hero-text-content">
                    <h1 class="hero-title">Soluții tehnice pentru<br>afaceri în creștere</h1>
                    <div class="hero-divider"></div>
                    <p class="hero-description">Dezvolt site-uri web personalizate și sisteme de automatizare care ajută afacerile românești să funcționeze mai eficient și mai eficace.</p>
                    
                    <div class="hero-expertise">
                        <div class="expertise-item">
                            <span class="expertise-number">01</span>
                            <div class="expertise-text">
                                <h3>Dezvoltare Web</h3>
                                <p>Site-uri web personalizate optimizate pentru performanță și conversii</p>
                            </div>
                        </div>
                        <div class="expertise-item">
                            <span class="expertise-number">02</span>
                            <div class="expertise-text">
                                <h3>Automatizarea Afacerilor</h3>
                                <p>Fluxuri de lucru simplificate pentru eliminarea sarcinilor repetitive</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="hero-cta">
                        <button onclick="openBookingModal()" class="cta-button">Programează o Consultație</button>
                        <a href="#services_section" class="text-link">Vezi Serviciile</a>
                    </div>
                </div>
                
                <div class="hero-identity">
                    <div class="identity-container">
                        <div class="portrait-container">
                            <img src="static/images/me-close-up.png" alt="Hreniuc Petrica" class="portrait-image">
                        </div>
                        <div class="identity-text">
                            <h2 class="identity-name">Hreniuc Petrică</h2>
                            <p class="identity-role">Dezvoltator Web & Specialist în Automatizare<br><span>Fondator, NOTSOMARKETING</span></p>
                        </div>
                    </div>
                    
                    <div class="clients-section">
                        <p class="clients-label">Colaborez cu afaceri din toată România</p>
                        <div class="tech-logos-small">
                            <img src="static/images/programming_techs_logos/php-alt.svg" alt="PHP">
                            <img src="static/images/programming_techs_logos/javascript.svg" alt="JavaScript">
                            <img src="static/images/automation_programs_logos/Brevo-Logo-1.svg" alt="Brevo">
                            <img src="static/images/automation_programs_logos/zapier.svg" alt="Zapier">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="scroll-indicator">
            <span>Derulează</span>
            <i class="fas fa-chevron-down"></i>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services_section">
        <div class="container">
            <div class="section-header">
                <h2>Servicii</h2>
                <div class="section-divider"></div>
                <p class="section-description">Soluții complete de dezvoltare web și automatizare adaptate nevoilor afacerii tale</p>
            </div>
            
            <div class="services-grid">
                <div class="service-column">
                    <div class="service-category">
                        <span class="category-number">01</span>
                        <h3>Dezvoltare Web</h3>
                    </div>
                    
                    <div class="service-list">
                        <div class="service-item">
                            <h4>Soluții E-commerce</h4>
                            <p>Magazine online personalizate cu procesare securizată a plăților, gestionarea stocurilor și experiență de utilizare optimizată</p>
                        </div>
                        
                        <div class="service-item">
                            <h4>Site-uri de Afaceri</h4>
                            <p>Prezență web profesională pentru companii mici și mijlocii cu sisteme de gestionare a conținutului</p>
                        </div>
                        
                        <div class="service-item">
                            <h4>Interfețe Administrative</h4>
                            <p>Panouri de control și sisteme de management personalizate pentru eficientizarea operațiunilor afacerii tale</p>
                        </div>
                        
                        <div class="service-item">
                            <h4>Optimizare Performanță</h4>
                            <p>Îmbunătățiri SEO și de viteză pentru site-urile existente pentru a crește clasamentul în căutări și implicarea utilizatorilor</p>
                        </div>
                    </div>
                </div>
                
                <div class="service-column">
                    <div class="service-category">
                        <span class="category-number">02</span>
                        <h3>Automatizarea Afacerilor</h3>
                    </div>
                    
                    <div class="service-list">
                        <div class="service-item">
                            <h4>Automatizare Marketing</h4>
                            <p>Email marketing și automatizarea călătoriei clienților folosind Brevo pentru a dezvolta lead-urile și a stimula conversiile</p>
                        </div>
                        
                        <div class="service-item">
                            <h4>Integrare Flux de Lucru</h4>
                            <p>Conectează diverse instrumente de afaceri și creează procese eficiente cu Make și n8n</p>
                        </div>
                        
                        <div class="service-item">
                            <h4>Integrare API</h4>
                            <p>Conectează instrumentele software existente folosind Zapier pentru a elimina transferul manual de date</p>
                        </div>
                        
                        <div class="service-item">
                            <h4>Procesare Comenzi</h4>
                            <p>Automatizează fluxurile de lucru de la achiziție la livrare pentru a reduce erorile și a economisi timp</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section id="process_section">
        <div class="container">
            <div class="section-header">
                <h2>Proces de Lucru</h2>
                <div class="section-divider"></div>
                <p class="section-description">O abordare structurată care asigură rezultate de calitate pentru fiecare proiect</p>
            </div>
            
            <div class="process-timeline">
                <div class="timeline-item">
                    <div class="timeline-number">01</div>
                    <div class="timeline-content">
                        <h3>Consultație</h3>
                        <p>Descoperire aprofundată a nevoilor afacerii tale, a obiectivelor și a provocărilor actuale pentru a stabili parametrii proiectului</p>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-number">02</div>
                    <div class="timeline-content">
                        <h3>Strategie</h3>
                        <p>Dezvoltarea unui plan cuprinzător cu soluții adaptate specific cerințelor afacerii tale</p>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-number">03</div>
                    <div class="timeline-content">
                        <h3>Implementare</h3>
                        <p>Execuția strategiei cu actualizări regulate și comunicare transparentă pe tot parcursul procesului</p>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-number">04</div>
                    <div class="timeline-content">
                        <h3>Suport</h3>
                        <p>Asistență continuă, instruire și mentenanță pentru a asigura succesul pe termen lung al soluțiilor tale digitale</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Technology Section -->
    <section id="technology_section">
        <div class="container">
            <div class="section-header">
                <h2>Stivă Tehnologică</h2>
                <div class="section-divider"></div>
                <p class="section-description">Instrumente și platforme profesionale care alimentează soluțiile tale digitale</p>
            </div>
            
            <div class="tech-categories">
                <div class="tech-category">
                    <h3>Dezvoltare Frontend</h3>
                    <div class="tech-grid">
                        <div class="tech-item">
                            <img src="static/images/programming_techs_logos/html-5.svg" alt="HTML5">
                            <span>HTML5</span>
                        </div>
                        <div class="tech-item">
                            <img src="static/images/programming_techs_logos/css-3.svg" alt="CSS3">
                            <span>CSS3</span>
                        </div>
                        <div class="tech-item">
                            <img src="static/images/programming_techs_logos/javascript.svg" alt="JavaScript">
                            <span>JavaScript</span>
                        </div>
                        <div class="tech-item">
                            <img src="static/images/programming_techs_logos/vue.svg" alt="Vue.js">
                            <span>Vue.js</span>
                        </div>
                        <div class="tech-item">
                            <img src="static/images/programming_techs_logos/vite.svg" alt="Vite">
                            <span>Vite</span>
                        </div>
                    </div>
                </div>
                
                <div class="tech-category">
                    <h3>Dezvoltare Backend</h3>
                    <div class="tech-grid">
                        <div class="tech-item">
                            <img src="static/images/programming_techs_logos/php-alt.svg" alt="PHP">
                            <span>PHP</span>
                        </div>
                        <div class="tech-item">
                            <img src="static/images/programming_techs_logos/laravel.svg" alt="Laravel">
                            <span>Laravel</span>
                        </div>
                        <div class="tech-item">
                            <img src="static/images/programming_techs_logos/mysql.svg" alt="MySQL">
                            <span>MySQL</span>
                        </div>
                    </div>
                </div>
                
                <div class="tech-category">
                    <h3>DevOps & Infrastructură</h3>
                    <div class="tech-grid">
                        <div class="tech-item">
                            <img src="static/images/programming_techs_logos/git-icon.svg" alt="Git">
                            <span>Git</span>
                        </div>
                        <div class="tech-item">
                            <img src="static/images/programming_techs_logos/github.svg" alt="GitHub">
                            <span>GitHub</span>
                        </div>
                        <div class="tech-item">
                            <img src="static/images/programming_techs_logos/nginx.svg" alt="Nginx">
                            <span>Nginx</span>
                        </div>
                        <div class="tech-item">
                            <img src="static/images/programming_techs_logos/apache.svg" alt="Apache">
                            <span>Apache</span>
                        </div>
                    </div>
                </div>
                
                <div class="tech-category">
                    <h3>Platforme de Automatizare</h3>
                    <div class="tech-grid">
                        <div class="tech-item">
                            <img src="static/images/automation_programs_logos/Brevo-Logo-1.svg" alt="Brevo">
                            <span>Brevo</span>
                        </div>
                        <div class="tech-item">
                            <img src="static/images/automation_programs_logos/Make-Logo-RGB.svg" alt="Make">
                            <span>Make</span>
                        </div>
                        <div class="tech-item">
                            <img src="static/images/automation_programs_logos/n8n_io.svg" alt="n8n">
                            <span>n8n</span>
                        </div>
                        <div class="tech-item">
                            <img src="static/images/automation_programs_logos/zapier.svg" alt="Zapier">
                            <span>Zapier</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Case Study Section -->
    <section id="case_study_section">
        <div class="container">
            <div class="section-header">
                <h2>Studii de Caz</h2>
                <div class="section-divider"></div>
                <p class="section-description">Aplicații în lumea reală ale tehnologiilor de dezvoltare web și automatizare</p>
            </div>
            
            <!-- Case Study Navigation -->
            <div class="case-study-nav">
                <button class="case-nav-btn active" data-study="ecommerce">Soluție E-Commerce</button>
                <button class="case-nav-btn" data-study="samples">Automatizare Distribuție Eșantioane</button>
            </div>
            
            <!-- Case Study 1: E-Commerce Solution -->
            <div class="case-study-container active" id="ecommerce-case">
                <div class="case-overview">
                    <div class="case-header">
                        <span class="case-label">Dezvoltare Web + Automatizare</span>
                        <h3>E-Commerce cu Flux de Verificare</h3>
                    </div>
                    
                    <div class="case-challenge">
                        <h4>Provocare</h4>
                        <p>O companie românească de distribuție avea nevoie de o platformă e-commerce care să califice lead-urile, să verifice identitatea afacerii și să eficientizeze procesul de solicitare a produselor pentru eșantioane și informații tehnice.</p>
                    </div>
                </div>
                
                <div class="case-details">
                    <div class="solution-column">
                        <h4>Soluție</h4>
                        <div class="solution-workflow">
                            <div class="workflow-step">
                                <span class="step-number">01</span>
                                <div class="step-content">
                                    <h5>Sistem de Verificare CUI</h5>
                                    <p>Am construit un sistem de verificare personalizat care verifică CUI-ul companiei (Codul Unic de Identificare) în baza de date a clienților existenți.</p>
                                </div>
                            </div>
                            
                            <div class="workflow-step">
                                <span class="step-number">02</span>
                                <div class="step-content">
                                    <h5>Flux de Lucru Dual</h5>
                                    <p>Clienții existenți sunt direcționați imediat către un formular de cerere accelerat, în timp ce contactele noi trec printr-o verificare prin API-ul Brevo înainte de a continua.</p>
                                </div>
                            </div>
                            
                            <div class="workflow-step">
                                <span class="step-number">03</span>
                                <div class="step-content">
                                    <h5>Sistem de Gestionare a Cererilor</h5>
                                    <p>Am creat un sistem care gestionează diverse tipuri de cereri (oferte, fișe tehnice, eșantioane) cu fluxuri de automatizare diferite pentru fiecare.</p>
                                </div>
                            </div>
                            
                            <div class="workflow-step">
                                <span class="step-number">04</span>
                                <div class="step-content">
                                    <h5>Notificarea Personalului</h5>
                                    <p>Alertele automate notifică personalul despre noile cereri, cu informații contextuale despre client și solicitarea acestuia.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="diagram-column">
                        <div class="diagram-container">
                            <svg width="100%" height="320" viewBox="0 0 600 320" xmlns="http://www.w3.org/2000/svg">
                                <style>
                                    .node { fill: rgba(70, 130, 180, 0.1); stroke: rgba(70, 130, 180, 0.3); stroke-width: 1; }
                                    .arrow { stroke: rgba(70, 130, 180, 0.5); stroke-width: 1.5; }
                                    .text { fill: #AAAAAA; font-family: sans-serif; font-size: 12px; text-anchor: middle; }
                                    .title { fill: #FFFFFF; font-family: sans-serif; font-size: 14px; font-weight: bold; text-anchor: middle; }
                                </style>
                                
                                <!-- Website Node -->
                                <rect class="node" x="50" y="70" width="120" height="60" rx="2" />
                                <text class="title" x="110" y="95">Website</text>
                                <text class="text" x="110" y="115">Verificare CUI</text>
                                
                                <!-- Arrow 1 -->
                                <line class="arrow" x1="170" y1="100" x2="220" y2="100" />
                                <polygon points="220,95 230,100 220,105" fill="rgba(70, 130, 180, 0.5)" />
                                
                                <!-- Verification Node -->
                                <rect class="node" x="230" y="70" width="120" height="60" rx="2" />
                                <text class="title" x="290" y="95">Verificare</text>
                                <text class="text" x="290" y="115">Verificare Bază de Date</text>
                                
                                <!-- Arrow 2 -->
                                <line class="arrow" x1="350" y1="100" x2="400" y2="100" />
                                <polygon points="400,95 410,100 400,105" fill="rgba(70, 130, 180, 0.5)" />
                                
                                <!-- Request Node -->
                                <rect class="node" x="410" y="70" width="140" height="60" rx="2" />
                                <text class="title" x="480" y="95">Sistem Cereri</text>
                                <text class="text" x="480" y="115">Produse/Tehnic</text>
                                
                                <!-- Arrow Down -->
                                <line class="arrow" x1="470" y1="130" x2="470" y2="170" />
                                <polygon points="465,170 470,180 475,170" fill="rgba(70, 130, 180, 0.5)" />
                                
                                <!-- Staff Node -->
                                <rect class="node" x="410" y="180" width="120" height="60" rx="2" />
                                <text class="title" x="470" y="205">Personal</text>
                                <text class="text" x="470" y="225">Notificare</text>
                                
                                <!-- Connected Systems -->
                                <rect class="node" x="50" y="180" width="120" height="60" rx="2" />
                                <text class="title" x="110" y="205">API Brevo</text>
                                <text class="text" x="110" y="225">Verificare Email</text>
                                
                                <rect class="node" x="230" y="180" width="120" height="60" rx="2" />
                                <text class="title" x="290" y="205">Bază de Date</text>
                                <text class="text" x="290" y="225">Înregistrări Clienți</text>
                                
                                <!-- Connection Lines -->
                                <line class="arrow" x1="110" y1="180" x2="110" y2="140" />
                                <line class="arrow" x1="110" y1="140" x2="290" y2="140" />
                                <line class="arrow" x1="290" y1="140" x2="290" y2="180" />
                                
                                <line class="arrow" x1="290" y1="180" x2="290" y2="150" />
                                <line class="arrow" x1="290" y1="150" x2="470" y2="150" />
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div class="case-results-container">
                    <div class="tech-used">
                        <h4>Tehnologii Utilizate</h4>
                        <div class="tech-pills">
                            <span class="tech-pill">PHP</span>
                            <span class="tech-pill">MySQL</span>
                            <span class="tech-pill">JavaScript</span>
                            <span class="tech-pill">Brevo API</span>
                            <span class="tech-pill">Zapier</span>
                        </div>
                    </div>
                    
                    <div class="case-results">
                        <h4>Rezultate</h4>
                        <div class="result-metrics">
                            <div class="result-metric">
                                <span class="metric-value">65%</span>
                                <span class="metric-label">Reducere a timpului de verificare manuală</span>
                            </div>
                            <div class="result-metric">
                                <span class="metric-value">40%</span>
                                <span class="metric-label">Creștere a lead-urilor calificate</span>
                            </div>
                            <div class="result-metric">
                                <span class="metric-value">90%</span>
                                <span class="metric-label">Răspuns mai rapid la solicitările clienților</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Case Study 2: Sample Distribution Automation -->
            <div class="case-study-container" id="samples-case">
                <div class="case-overview">
                    <div class="case-header">
                        <span class="case-label">Automatizare Multi-platformă</span>
                        <h3>Sistem de Distribuție a Eșantioanelor de Produse</h3>
                    </div>
                    
                    <div class="case-challenge">
                        <h4>Provocare</h4>
                        <p>O companie de producție se confrunta cu dificultăți în procesul manual de distribuție a eșantioanelor de produse, care consuma mult timp, era predispus la erori și nu avea mecanisme adecvate de urmărire și follow-up.</p>
                    </div>
                </div>
                
                <div class="case-details">
                    <div class="solution-column">
                        <h4>Soluție</h4>
                        <div class="solution-workflow">
                            <div class="workflow-step">
                                <span class="step-number">01</span>
                                <div class="step-content">
                                    <h5>Portal Digital de Cereri</h5>
                                    <p>Am creat un portal bazat pe formulare pentru agenții de vânzări pentru a trimite cereri de eșantioane, capturând toate informațiile necesare despre client și produs.</p>
                                </div>
                            </div>
                            
                            <div class="workflow-step">
                                <span class="step-number">02</span>
                                <div class="step-content">
                                    <h5>Comunicare Multi-canal</h5>
                                    <p>Am implementat fluxuri de lucru Zapier care declanșează atât mesaje email, cât și mesaje WhatsApp prin API-ul Messaggio, asigurându-ne că clienții primesc notificări prin canalele preferate.</p>
                                </div>
                            </div>
                            
                            <div class="workflow-step">
                                <span class="step-number">03</span>
                                <div class="step-content">
                                    <h5>Sistem de Urmărire a Răspunsurilor</h5>
                                    <p>Am dezvoltat un sistem webhook care capturează răspunsurile clienților și declanșează următorii pași în fluxul de lucru automatizat.</p>
                                </div>
                            </div>
                            
                            <div class="workflow-step">
                                <span class="step-number">04</span>
                                <div class="step-content">
                                    <h5>Livrarea Documentelor & Notificări Personal</h5>
                                    <p>Am automatizat livrarea fișierelor tehnice către clienți și, în același timp, am notificat personalul pentru a pregăti eșantioane fizice pentru expediere.</p>
                                </div>
                            </div>
                            
                            <div class="workflow-step">
                                <span class="step-number">05</span>
                                <div class="step-content">
                                    <h5>Integrare Marketing</h5>
                                    <p>Am conectat sistemul cu platforma de email marketing Brevo pentru a adăuga automat clienții receptivi în campaniile de marketing țintite.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="diagram-column">
                        <div class="diagram-container">
                            <svg width="100%" height="400" viewBox="0 0 660 400" xmlns="http://www.w3.org/2000/svg">
                                <style>
                                    .node { fill: rgba(70, 130, 180, 0.1); stroke: rgba(70, 130, 180, 0.3); stroke-width: 1; }
                                    .arrow { stroke: rgba(70, 130, 180, 0.5); stroke-width: 1.5; }
                                    .text { fill: #AAAAAA; font-family: sans-serif; font-size: 12px; text-anchor: middle; }
                                    .title { fill: #FFFFFF; font-family: sans-serif; font-size: 14px; font-weight: bold; text-anchor: middle; }
                                </style>
                                
                                <!-- Form Node -->
                                <rect class="node" x="50" y="50" width="120" height="60" rx="2" />
                                <text class="title" x="110" y="75">Formular Cerere</text>
                                <text class="text" x="110" y="95">Agent Vânzări</text>
                                
                                <!-- Arrow 1 -->
                                <line class="arrow" x1="170" y1="80" x2="220" y2="80" />
                                <polygon points="220,75 230,80 220,85" fill="rgba(70, 130, 180, 0.5)" />
                                
                                <!-- Database Node -->
                                <rect class="node" x="230" y="50" width="120" height="60" rx="2" />
                                <text class="title" x="290" y="75">Bază de Date</text>
                                <text class="text" x="290" y="95">Stocare Cereri</text>
                                
                                <!-- Arrow 2 -->
                                <line class="arrow" x1="350" y1="80" x2="400" y2="80" />
                                <polygon points="400,75 410,80 400,85" fill="rgba(70, 130, 180, 0.5)" />
                                
                                <!-- Zapier Node -->
                                <rect class="node" x="410" y="50" width="120" height="60" rx="2" />
                                <text class="title" x="470" y="75">Zapier</text>
                                <text class="text" x="470" y="95">Centru Automatizare</text>
                                
                                <!-- Arrows to channels -->
                                <line class="arrow" x1="470" y1="110" x2="470" y2="140" />
                                <line class="arrow" x1="470" y1="140" x2="350" y2="140" />
                                <line class="arrow" x1="470" y1="140" x2="590" y2="140" />
                                
                                <line class="arrow" x1="350" y1="140" x2="350" y2="170" />
                                <polygon points="345,170 350,180 355,170" fill="rgba(70, 130, 180, 0.5)" />
                                
                                <line class="arrow" x1="590" y1="140" x2="590" y2="170" />
                                <polygon points="585,170 590,180 595,170" fill="rgba(70, 130, 180, 0.5)" />
                                
                                <!-- Email Node -->
                                <rect class="node" x="290" y="180" width="120" height="60" rx="2" />
                                <text class="title" x="350" y="205">Email</text>
                                <text class="text" x="350" y="225">Notificare Client</text>
                                
                                <!-- WhatsApp Node -->
                                <rect class="node" x="530" y="180" width="120" height="60" rx="2" />
                                <text class="title" x="590" y="205">WhatsApp</text>
                                <text class="text" x="590" y="225">API Messaggio</text>
                                
                                <!-- Webhook Node -->
                                <rect class="node" x="410" y="180" width="120" height="60" rx="2" />
                                <text class="title" x="470" y="205">Webhook</text>
                                <text class="text" x="470" y="225">Captură Răspuns</text>
                                
                                <!-- Final Arrow -->
                                <line class="arrow" x1="470" y1="240" x2="470" y2="270" />
                                <polygon points="465,270 470,280 475,270" fill="rgba(70, 130, 180, 0.5)" />
                                
                                <!-- Marketing Node -->
                                <rect class="node" x="410" y="280" width="150" height="60" rx="2" />
                                <text class="title" x="485" y="305">Brevo</text>
                                <text class="text" x="485" y="325">Automatizare Marketing</text>
                                
                                <!-- Staff Node -->
                                <rect class="node" x="230" y="280" width="120" height="60" rx="2" />
                                <text class="title" x="290" y="305">Personal</text>
                                <text class="text" x="290" y="325">Expediere Eșantion</text>
                                
                                <!-- Side Arrow -->
                                <line class="arrow" x1="410" y1="310" x2="350" y2="310" />
                                <polygon points="350,305 340,310 350,315" fill="rgba(70, 130, 180, 0.5)" />
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div class="case-results-container">
                    <div class="tech-used">
                        <h4>Tehnologii Utilizate</h4>
                        <div class="tech-pills">
                            <span class="tech-pill">Zapier</span>
                            <span class="tech-pill">Messaggio API</span>
                            <span class="tech-pill">Webhooks</span>
                            <span class="tech-pill">Brevo</span>
                            <span class="tech-pill">MySQL</span>
                            <span class="tech-pill">PHP</span>
                        </div>
                    </div>
                    
                    <div class="case-results">
                        <h4>Rezultate</h4>
                        <div class="result-metrics">
                            <div class="result-metric">
                                <span class="metric-value">85%</span>
                                <span class="metric-label">Reducere a timpului de procesare</span>
                            </div>
                            <div class="result-metric">
                                <span class="metric-value">32%</span>
                                <span class="metric-label">Creștere a conversiei cererilor de eșantioane</span>
                            </div>
                            <div class="result-metric">
                                <span class="metric-value">100%</span>
                                <span class="metric-label">Vizibilitate asupra statusului cererilor de eșantioane</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="case-cta">
                <p>Cauți soluții similare de automatizare pentru afacerea ta?</p>
                <button onclick="openBookingModal()" class="cta-button">Programează o Consultație</button>
            </div>
        </div>
    </section>

    <!-- Blog Section -->
    <section id="featured_blog_section">
        <div class="container">
            <div class="section-header">
                <h2>Perspective</h2>
                <div class="section-divider"></div>
                <p class="section-description">Expertiză și împărtășirea cunoștințelor despre dezvoltare web și automatizare</p>
            </div>
            
            <div class="blog-grid">
                <?php
                // Fetch latest 3 blog posts
                $sql = "SELECT p.post_id, p.title, p.slug, p.content, p.image_url, p.author_id, p.category_id,
                            p.created_at, p.updated_at, u.username AS author_name, c.category_name
                        FROM posts p
                        LEFT JOIN users u ON p.author_id = u.user_id
                        LEFT JOIN categories c ON p.category_id = c.category_id
                        ORDER BY p.created_at DESC
                        LIMIT 3";

                $result = $conn->query($sql);
                if (!$result) {
                    die("Error executing query: " . $conn->error);
                }

                while ($row = $result->fetch_assoc()) { ?>
                    <article class="blog-card">
                        <a href="blog_post.php?slug=<?php echo $row['slug']; ?>" class="blog-link">
                            <?php if (!empty($row['image_url'])) { ?>
                                <div class="blog-image">
                                    <img src="<?php echo $row['image_url']; ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
                                </div>
                            <?php } ?>
                            <div class="blog-content">
                                <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                                <p><?php 
                                    // Decode HTML entities first, then strip tags
                                    $raw_content = html_entity_decode($row['content']);
                                    $clean_content = strip_tags($raw_content);
                                    $preview = mb_substr($clean_content, 0, 120, 'UTF-8');
                                    if (mb_strlen($clean_content) > 120) {
                                        $preview .= '...';
                                    }
                                    echo htmlspecialchars($preview, ENT_QUOTES, 'UTF-8');
                                ?></p>
                                <div class="blog-meta">
                                    <span class="blog-date"><?php echo date('d.m.Y', strtotime($row['created_at'])); ?></span>
                                    <span class="read-more">Citește Articolul</span>
                                </div>
                            </div>
                        </a>
                    </article>
                <?php } ?>
            </div>
            
            <div class="blog-footer">
                <a href="blog.php" class="text-link">Vezi Toate Articolele</a>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact_section">
        <div class="container">
            <div class="contact-container">
                <div class="contact-content">
                    <h2>Să lucrăm împreună</h2>
                    <p>Programează o consultație gratuită pentru a discuta despre cum dezvoltarea web și automatizarea pot transforma operațiunile afacerii tale.</p>
                    
                    <div class="contact-cta">
                        <button onclick="openBookingModal()" class="cta-button">Programează Consultație</button>
                    </div>
                    
                    <div class="contact-info">
                        <div class="contact-method">
                            <span class="method-label">Email</span>
                            <a href="mailto:mail@hreniucpetrica.ro" class="method-value">mail@hreniucpetrica.ro</a>
                        </div>
                        <div class="contact-method">
                            <span class="method-label">Localizare</span>
                            <span class="method-value">România</span>
                        </div>
                    </div>
                </div>
                
                <div class="company-signature">
                    <p>Hreniuc Petrică — NOTSOMARKETING</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Booking Modal -->
    <div id="bookingModal" class="booking-modal hidden">
        <div class="booking-modal-content">
            <button class="modal-close" onclick="closeBookingModal()">
                <span>&times;</span>
            </button>
            
            <div class="modal-header">
                <h2>Programează o Consultație</h2>
                <p>Te rugăm să completezi formularul de mai jos pentru a programa o discuție gratuită de 15 minute despre proiectul tău.</p>
            </div>
            
            <form action="includes/submit_booking.php" method="POST" class="booking-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="booking-name">Nume Complet</label>
                        <input type="text" id="booking-name" name="name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="booking-email">Adresă Email</label>
                        <input type="email" id="booking-email" name="email" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="booking-service">Interes Servicii</label>
                    <select id="booking-service" name="service" required>
                        <option value="" disabled selected>Selectează un serviciu</option>
                        <option value="Web Development">Dezvoltare Web</option>
                        <option value="Automation">Automatizare Afaceri</option>
                        <option value="Both">Ambele Servicii</option>
                    </select>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="booking-date">Data Preferată</label>
                        <input type="date" id="booking-date" name="date" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="booking-time">Ora Preferată</label>
                        <select id="booking-time" name="time" required>
                            <option value="" disabled selected>Selectează o oră</option>
                            <option value="16:30">16:30</option>
                            <option value="17:00">17:00</option>
                            <option value="17:30">17:30</option>
                            <option value="18:00">18:00</option>
                            <option value="18:30">18:30</option>
                            <option value="19:00">19:00</option>
                            <option value="19:30">19:30</option>
                            <option value="20:00">20:00</option>
                            <option value="20:30">20:30</option>
                            <option value="21:00">21:00</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="booking-description">Descriere Proiect</label>
                    <textarea id="booking-description" name="description" rows="4" placeholder="Te rugăm să descrii pe scurt nevoile tale sau provocările actuale..." required></textarea>
                </div>
                
                <div class="form-checkbox">
                    <input type="checkbox" id="privacy-policy" name="privacy_policy" required>
                    <label for="privacy-policy">
                        Sunt de acord cu <a href="privacy-policy.php" target="_blank">politica de confidențialitate</a> și îmi dau consimțământul pentru a fi contactat în legătură cu solicitarea mea.
                    </label>
                </div>
                
                <div class="form-submit">
                    <button type="submit" class="submit-button">Confirmă Programarea</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Notification Area -->
    <div id="notification" class="hidden">
        <p id="notification-message"></p>
    </div>

    <script>
        // Modal functions
        function openBookingModal() {
            document.getElementById('bookingModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Prevent body scrolling
        }
        
        function closeBookingModal() {
            document.getElementById('bookingModal').classList.add('hidden');
            document.body.style.overflow = ''; // Restore body scrolling
        }
        
        // Add smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>

<?php include(ROOT_PATH . '/includes/footer.php'); ?>