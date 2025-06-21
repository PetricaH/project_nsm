<?php require_once('config.php'); ?>
<?php require_once(ROOT_PATH . '/includes/heading.php'); ?>
<?php $page_css = 'home.css';?>
<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies
?>
<title>NOTSOMARKETING | Servicii de Dezvoltare Web & Automatizare</title>
</head>
<body>
    <?php include(ROOT_PATH . '/includes/navbar.php'); ?>

    <!-- Hero Section (UNCHANGED) -->
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
                            <h4>Automatizarea Fluxurilor de Lucru</h4>
                            <p>Conectarea aplicațiilor tale pentru a elimina sarcinile manuale repetitive și pentru a îmbunătăți eficiența echipei</p>
                        </div>
                        
                        <div class="service-item">
                            <h4>Sisteme CRM și Vânzări</h4>
                            <p>Automatizarea proceselor de vânzări, urmărirea lead-urilor și fluxurile de comunicare cu clienții</p>
                        </div>
                        
                        <div class="service-item">
                            <h4>Automatizare Email Marketing</h4>
                            <p>Campanii personalizate, nurturing-ul lead-urilor și urmărirea comportamentului clienților</p>
                        </div>
                        
                        <div class="service-item">
                            <h4>Raportare și Analiză</h4>
                            <p>Rapoarte automate de business, dashboard-uri și sisteme de alertă pentru indicatori cheie de performanță</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Work Process Section -->
    <section id="process_section">
        <div class="container">
            <div class="section-header">
                <h2>Procesul de Lucru</h2>
                <div class="section-divider"></div>
                <p class="section-description">O abordare structurată pentru a asigura succesul proiectului tău de la început la sfârșitul implementării</p>
            </div>
            
            <div class="process-timeline">
                <div class="timeline-item">
                    <div class="timeline-number">01</div>
                    <div class="timeline-content">
                        <h3>Descoperire</h3>
                        <p>Înțelegerea în profunzime a afacerii tale, a obiectivelor și a provocărilor pentru a crea fundația unui proiect de succes</p>
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

    <!-- Expanded Case Studies Section -->
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
                <button class="case-nav-btn" data-study="hr">Automatizare HR</button>
                <button class="case-nav-btn" data-study="website">Site Web Corporate</button>
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
                                    <h5>Portal de Înregistrare</h5>
                                    <p>Am creat un sistem de înregistrare care verifică datele companiei prin API-uri externe și validează informațiile de contact.</p>
                                </div>
                            </div>
                            
                            <div class="workflow-step">
                                <span class="step-number">02</span>
                                <div class="step-content">
                                    <h5>Catalogul Produselor</h5>
                                    <p>Dezvoltat cu filtrare avansată, comparare produse și sistem de solicitare eșantioane integrat cu gestionarea stocurilor.</p>
                                </div>
                            </div>
                            
                            <div class="workflow-step">
                                <span class="step-number">03</span>
                                <div class="step-content">
                                    <h5>Fluxuri de Aprobare</h5>
                                    <p>Implementat sistem automat de aprobare pentru comenzi și solicitări, cu notificări în timp real pentru echipa de vânzări.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tech-used">
                        <h4>Tehnologii Utilizate</h4>
                        <div class="tech-pills">
                            <span class="tech-pill">PHP</span>
                            <span class="tech-pill">MySQL</span>
                            <span class="tech-pill">JavaScript</span>
                            <span class="tech-pill">CSS</span>
                        </div>
                    </div>
                </div>
                
                <div class="case-results-container">
                    <div class="case-results">
                        <h4>Rezultate</h4>
                        <div class="result-metrics">
                            <div class="result-metric">
                                <span class="metric-value">75%</span>
                                <span class="metric-label">Reducere a timpului de calificare lead-uri</span>
                            </div>
                            <div class="result-metric">
                                <span class="metric-value">40%</span>
                                <span class="metric-label">Creștere a numărului de solicitări de eșantioane</span>
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
                                    <h5>Urmărire și Raportare</h5>
                                    <p>Sistem complet de tracking al statusului eșantioanelor și dashboard pentru managementul eficient al cererilor cu metrici în timp real.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tech-used">
                        <h4>Tehnologii Utilizate</h4>
                        <div class="tech-pills">
                            <span class="tech-pill">Zapier</span>
                            <span class="tech-pill">Messaggio API</span>
                            <span class="tech-pill">Brevo</span>
                            <span class="tech-pill">Google Sheets</span>
                        </div>
                    </div>
                </div>
                
                <div class="case-results-container">
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
                                <span class="metric-label">Vizibilitate asupra statusului cererilor</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Case Study 3: HR Automation -->
            <div class="case-study-container" id="hr-case">
                <div class="case-overview">
                    <div class="case-header">
                        <span class="case-label">Automatizare Procese HR</span>
                        <h3>Sistem Automatizat de Aprobare Concedii</h3>
                    </div>
                    
                    <div class="case-challenge">
                        <h4>Provocare</h4>
                        <p>Companie cu 150+ angajați cu proces manual de aprobare concedii: formulare tipărite, semnături fizice, scanare și trimitere prin email către HR. Procesul era lent și predispus la pierderea documentelor.</p>
                    </div>
                </div>
                
                <div class="case-details">
                    <div class="solution-column">
                        <h4>Soluție</h4>
                        <div class="solution-workflow">
                            <div class="workflow-step">
                                <span class="step-number">01</span>
                                <div class="step-content">
                                    <h5>Formular Digital</h5>
                                    <p>Creat formular online accesibil de pe telefon cu validări automate și calculare automată a zilelor de concediu disponibile.</p>
                                </div>
                            </div>
                            
                            <div class="workflow-step">
                                <span class="step-number">02</span>
                                <div class="step-content">
                                    <h5>Flux de Aprobare</h5>
                                    <p>Implementat sistem automat de aprobare pe niveluri cu notificări către manageri și HR, plus semnătură digitală integrată.</p>
                                </div>
                            </div>
                            
                            <div class="workflow-step">
                                <span class="step-number">03</span>
                                <div class="step-content">
                                    <h5>Integrare Payroll</h5>
                                    <p>Conectat cu sistemul de payroll pentru actualizare automată a zilelor de concediu și generare rapoarte mensuale.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tech-used">
                        <h4>Tehnologii Utilizate</h4>
                        <div class="tech-pills">
                            <span class="tech-pill">Google Forms</span>
                            <span class="tech-pill">Zapier</span>
                            <span class="tech-pill">DocuSign</span>
                            <span class="tech-pill">Slack</span>
                        </div>
                    </div>
                </div>
                
                <div class="case-results-container">
                    <div class="case-results">
                        <h4>Rezultate</h4>
                        <div class="result-metrics">
                            <div class="result-metric">
                                <span class="metric-value">70%</span>
                                <span class="metric-label">Reducere timp procesare cereri</span>
                            </div>
                            <div class="result-metric">
                                <span class="metric-value">0%</span>
                                <span class="metric-label">Documente pierdute</span>
                            </div>
                            <div class="result-metric">
                                <span class="metric-value">95%</span>
                                <span class="metric-label">Satisfacție angajați</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Case Study 4: Website Corporate -->
            <div class="case-study-container" id="website-case">
                <div class="case-overview">
                    <div class="case-header">
                        <span class="case-label">Dezvoltare Web</span>
                        <h3>Site Web Corporate cu Lead Generation</h3>
                    </div>
                    
                    <div class="case-challenge">
                        <h4>Provocare</h4>
                        <p>Companie de consultanță fără prezență online profesională. Competitorii câștigau clienți prin site-uri moderne, iar aceștia pierdeau oportunități de business din cauza lipsei unei vitrine digitale credibile.</p>
                    </div>
                </div>
                
                <div class="case-details">
                    <div class="solution-column">
                        <h4>Soluție</h4>
                        <div class="solution-workflow">
                            <div class="workflow-step">
                                <span class="step-number">01</span>
                                <div class="step-content">
                                    <h5>Design Modern & Responsiv</h5>
                                    <p>Creat identitate vizuală profesională cu site modern, optimizat pentru toate dispozitivele și încărcare rapidă.</p>
                                </div>
                            </div>
                            
                            <div class="workflow-step">
                                <span class="step-number">02</span>
                                <div class="step-content">
                                    <h5>Optimizare Conversii</h5>
                                    <p>Implementat multiple puncte de contact: formulare de contact, chat live, downloaduri gratuite și testimoniale video.</p>
                                </div>
                            </div>
                            
                            <div class="workflow-step">
                                <span class="step-number">03</span>
                                <div class="step-content">
                                    <h5>SEO & Analytics</h5>
                                    <p>Optimizat pentru motoarele de căutare și configurat tracking detaliat pentru măsurarea performanței și optimizări continue.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tech-used">
                        <h4>Tehnologii Utilizate</h4>
                        <div class="tech-pills">
                            <span class="tech-pill">PHP</span>
                            <span class="tech-pill">JavaScript</span>
                            <span class="tech-pill">CSS</span>
                            <span class="tech-pill">Google Analytics</span>
                        </div>
                    </div>
                </div>
                
                <div class="case-results-container">
                    <div class="case-results">
                        <h4>Rezultate</h4>
                        <div class="result-metrics">
                            <div class="result-metric">
                                <span class="metric-value">180%</span>
                                <span class="metric-label">Creștere lead-uri organice</span>
                            </div>
                            <div class="result-metric">
                                <span class="metric-value">45%</span>
                                <span class="metric-label">Îmbunătățire rata conversie</span>
                            </div>
                            <div class="result-metric">
                                <span class="metric-value">60%</span>
                                <span class="metric-label">Creștere timp petrecut pe site</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="case-cta">
                <p>Vrei să vezi rezultate similare în afacerea ta?</p>
                <button onclick="openBookingModal()" class="cta-button">Programează o Consultație Gratuită</button>
            </div>
        </div>
    </section>

    <!-- Contact Section with Visible Form -->
    <section id="contact_section">
        <div class="container">
            <div class="section-header">
                <h2>Să Colaborăm</h2>
                <div class="section-divider"></div>
                <p class="section-description">Pregătit să transformi afacerea ta cu soluții web și automatizare personalizate? Să discutăm despre proiectul tău.</p>
            </div>
            
            <div class="contact-container">
                <div class="contact-info">
                    <div class="contact-benefits">
                        <h3>De ce să colaborezi cu mine?</h3>
                        <div class="benefit-list">
                            <div class="benefit-item">
                                <div class="benefit-icon">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <div class="benefit-text">
                                    <h4>Rezultate Măsurabile</h4>
                                    <p>Fiecare proiect vine cu metrici clare și obiective definite pentru a demonstra ROI-ul</p>
                                </div>
                            </div>
                            <div class="benefit-item">
                                <div class="benefit-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="benefit-text">
                                    <h4>Aproach Personal</h4>
                                    <p>Lucrez direct cu tine pentru a înțelege perfect nevoile afacerii tale</p>
                                </div>
                            </div>
                            <div class="benefit-item">
                                <div class="benefit-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="benefit-text">
                                    <h4>Implementare Rapidă</h4>
                                    <p>Proiecte livrate în timp optim cu comunicare transparentă pe tot parcursul</p>
                                </div>
                            </div>
                            <div class="benefit-item">
                                <div class="benefit-icon">
                                    <i class="fas fa-headset"></i>
                                </div>
                                <div class="benefit-text">
                                    <h4>Suport Continuu</h4>
                                    <p>Asistență și mentenanță pe termen lung pentru a asigura succesul proiectului</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="contact-form-wrapper">
                    <form id="contact_form" class="contact-form" method="POST" action="includes/submit_contact.php">
                        <div class="form-header">
                            <h3>Trimite-mi un Mesaj</h3>
                            <p>Completează formularul și îți răspund în maxim 24 ore</p>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">Nume Complet *</label>
                                <input type="text" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="phone">Telefon</label>
                                <input type="tel" id="phone" name="phone">
                            </div>
                            <div class="form-group">
                                <label for="company">Companie</label>
                                <input type="text" id="company" name="company">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="service_type">Tipul de Serviciu *</label>
                            <select id="service_type" name="service_type" required>
                                <option value="">Selectează serviciul</option>
                                <option value="web_development">Dezvoltare Web</option>
                                <option value="automation">Automatizare Afacere</option>
                                <option value="both">Ambele Servicii</option>
                                <option value="consultation">Consultație Generală</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="budget">Buget Aproximativ</label>
                            <select id="budget" name="budget">
                                <option value="">Selectează bugetul</option>
                                <option value="500-1500">€500 - €1.500</option>
                                <option value="1500-3000">€1.500 - €3.000</option>
                                <option value="3000-5000">€3.000 - €5.000</option>
                                <option value="5000+">€5.000+</option>
                                <option value="to_discuss">De discutat</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Mesajul Tău *</label>
                            <textarea id="message" name="message" rows="5" required placeholder="Descrie-mi pe scurt proiectul tău și cum te pot ajuta..."></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label class="checkbox-label">
                                <input type="checkbox" name="consent" required>
                                <span class="checkmark"></span>
                                Sunt de acord cu prelucrarea datelor personale conform <a href="/privacy-policy.php" target="_blank">Politicii de Confidențialitate</a>
                            </label>
                        </div>
                        
                        <button type="submit" class="submit-btn">
                            <span>Trimite Mesajul</span>
                            <i class="fas fa-paper-plane"></i>
                        </button>
                        
                        <div class="form-note">
                            <p><i class="fas fa-info-circle"></i> Îți răspund personal în maxim 24 ore cu o propunere detaliată</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Booking Modal -->
    <div id="bookingModal" class="booking-modal hidden">
        <div class="booking-modal-content">
            <button onclick="closeBookingModal()" class="booking-modal-close">
                <span class="material-symbols-outlined">close</span>
            </button>
            
            <div class="booking-columns">
                <div class="booking-form-column">
                    <div class="modal-header">
                        <h2>Programează Sesiunea Ta de Strategie</h2>
                        <p><strong>100% Gratuită</strong> - 45 de minute cu un specialist în dezvoltare web și automatizare</p>
                    </div>
                    
                    <form id="booking-form" method="POST" action="includes/submit_booking.php">
                        <div class="booking-form-row">
                            <div class="booking-form-group">
                                <label for="booking-name">Nume Complet *</label>
                                <input type="text" id="booking-name" name="name" required>
                            </div>
                            <div class="booking-form-group">
                                <label for="booking-email">Email *</label>
                                <input type="email" id="booking-email" name="email" required>
                            </div>
                        </div>
                        
                        <div class="booking-form-row">
                            <div class="booking-form-group">
                                <label for="booking-phone">Telefon *</label>
                                <input type="tel" id="booking-phone" name="phone" required>
                            </div>
                            <div class="booking-form-group">
                                <label for="booking-service">Serviciu de Interes *</label>
                                <select id="booking-service" name="service" required>
                                    <option value="">Selectează serviciul</option>
                                    <option value="Web Development">Dezvoltare Web</option>
                                    <option value="Automation">Automatizare Afacere</option>
                                    <option value="Both">Ambele Servicii</option>
                                    <option value="Consultation">Consultație Generală</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="booking-form-group">
                            <label for="booking-website">Website-ul Actual (opțional)</label>
                            <input type="url" id="booking-website" name="website" placeholder="https://exemple.ro">
                        </div>
                        
                        <div class="booking-form-row">
                            <div class="booking-form-group">
                                <label for="booking-budget">Buget Estimat</label>
                                <select id="booking-budget" name="budget">
                                    <option value="">Selectează bugetul</option>
                                    <option value="500-1500">€500 - €1.500</option>
                                    <option value="1500-3000">€1.500 - €3.000</option>
                                    <option value="3000-5000">€3.000 - €5.000</option>
                                    <option value="5000+">€5.000+</option>
                                    <option value="to_discuss">De discutat</option>
                                </select>
                            </div>
                            <div class="booking-form-group">
                                <label for="booking-timeline">Timeline Dorit</label>
                                <select id="booking-timeline" name="timeline">
                                    <option value="">Selectează timeline-ul</option>
                                    <option value="asap">Cât mai repede</option>
                                    <option value="1-3_months">1-3 luni</option>
                                    <option value="3-6_months">3-6 luni</option>
                                    <option value="flexible">Flexibil</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="booking-form-group">
                            <label for="booking-description">Descrie-ne pe scurt proiectul tău *</label>
                            <textarea id="booking-description" name="description" rows="4" required placeholder="Ce provocări întâmpini în afacerea ta și cum crezi că te-am putea ajuta?"></textarea>
                        </div>
                        
                        <div class="booking-form-group">
                            <label class="checkbox-label">
                                <input type="checkbox" name="consent" required>
                                Sunt de acord cu prelucrarea datelor personale conform <a href="/privacy-policy.php" target="_blank">Politicii de Confidențialitate</a>
                            </label>
                        </div>
                        
                        <button type="submit" class="booking-submit-btn">
                            <span>Programează Sesiunea Gratuită</span>
                            <span class="material-symbols-outlined">arrow_forward</span>
                        </button>
                    </form>
                </div>
                
                <div class="booking-info-column">
                    <div class="session-includes">
                        <h3>Ce Includem în Sesiune:</h3>
                        <ul>
                            <li><strong>Analiza Afacerii Tale:</strong> Identificăm oportunități specifice de îmbunătățire</li>
                            <li><strong>Planul Personalizat:</strong> Strategie detaliată adaptată nevoilor tale</li>
                            <li><strong>Estimare de Costuri:</strong> Transparență completă asupra investiției</li>
                            <li><strong>Roadmap de Implementare:</strong> Pași concreti pentru următoarele etape</li>
                        </ul>
                    </div>
                    
                    <div class="booking-testimonial">
                        <p>"Sesiunea cu Petrică mi-a clarificat exact ce păși trebuie să urmez pentru a-mi digitaliza afacerea. Recomandările lui au fost extrem de practice și aplicabile."</p>
                        <div class="booking-testimonial-author">
                            <span>Proprietar, Companie de Servicii București</span>
                        </div>
                    </div>
                    
                    <div class="spots-remaining">
                        <div class="spots-icon">
                            <span class="material-symbols-outlined">schedule</span>
                        </div>
                        <div class="spots-text">
                            <p><strong>Doar 3 locuri rămase săptămâna aceasta</strong></p>
                            <p>Următoarea disponibilitate: <?php echo date('l, F j', strtotime('+2 days')); ?></p>
                        </div>
                    </div>
                    
                    <div class="satisfaction-guarantee">
                        <div class="guarantee-icon">
                            <span class="material-symbols-outlined">verified</span>
                        </div>
                        <div class="guarantee-text">
                            <h3>Garanție Fără Obligații</h3>
                            <p>Dacă nu primești cel puțin 3 idei viabile în timpul sesiunii noastre, îți voi trimite un voucher de 50 € ca scuză pentru timpul tău.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Case studies navigation functionality
        document.addEventListener('DOMContentLoaded', function() {
            const navBtns = document.querySelectorAll('.case-nav-btn');
            const caseContainers = document.querySelectorAll('.case-study-container');
            
            navBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Remove active class from all buttons and containers
                    navBtns.forEach(b => b.classList.remove('active'));
                    caseContainers.forEach(c => c.classList.remove('active'));
                    
                    // Add active class to clicked button
                    this.classList.add('active');
                    
                    // Show corresponding case study
                    const studyId = this.getAttribute('data-study');
                    const targetContainer = document.getElementById(studyId + '-case');
                    if (targetContainer) {
                        targetContainer.classList.add('active');
                    }
                });
            });
            
            // Booking modal functions
            window.openBookingModal = function(service = '') {
                const modal = document.getElementById('bookingModal');
                if (modal) {
                    modal.classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                    
                    // Pre-select service if provided
                    if (service) {
                        const serviceSelect = document.getElementById('booking-service');
                        if (serviceSelect) {
                            for (let i = 0; i < serviceSelect.options.length; i++) {
                                if (serviceSelect.options[i].value === service) {
                                    serviceSelect.selectedIndex = i;
                                    break;
                                }
                            }
                        }
                    }
                }
            };
            
            window.closeBookingModal = function() {
                const modal = document.getElementById('bookingModal');
                if (modal) {
                    modal.classList.add('hidden');
                    document.body.style.overflow = 'auto';
                }
            };
            
            // Close modal when clicking outside
            window.addEventListener('click', function(event) {
                const modal = document.getElementById('bookingModal');
                if (event.target === modal) {
                    closeBookingModal();
                }
            });
        });
        </script>
<?php include(ROOT_PATH . '/includes/footer.php'); ?>