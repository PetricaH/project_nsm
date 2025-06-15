<?php require_once('config.php'); ?>
<?php require_once(ROOT_PATH . '/includes/heading.php'); ?>
<?php $page_css = 'automation.css';?>
<title>Soluții de Automatizare pentru Afaceri | Economisește Timp & Reduce Costurile | Hreniuc Petrică</title>
<meta name="description" content="Automatizează procesele de afaceri și economisește peste 10 ore săptămânal. Reduce costurile cu 30-70% prin soluții de automatizare personalizate, construite pentru afacerile românești.">
</head>
<body data-context="automation">
<?php include(ROOT_PATH . '/includes/navbar.php'); ?>
<main>
    <!-- Enhanced Hero Section -->
    <section class="hero_automation_section">
        <!-- Gradient overlay -->
        <div class="gradient_overlay"></div>
    <!-- Robotic arms background -->
    <div class="arms_container">
        <img src="static/images/automation_lp_imgs/left_arm.png" alt="Braț Robotic Stânga" class="left_arm">
        <img src="static/images/automation_lp_imgs/top_arm.png" alt="Braț Robotic Sus" class="top_arm">
        <img src="static/images/automation_lp_imgs/right_arm.png" alt="Braț Robotic Dreapta" class="right_arm">
    </div>

    <!-- Hero content -->
    <div class="automation_hero_content">
        <div class="hero-badge">
            <span>Economisește Peste 10 Ore Săptămânal Cu Automatizarea Afacerii</span>
        </div>
        <h1>Nu Mai Pierde Timp cu Sarcini pe Care Computerul le Poate Face</h1>
        <div class="under_h1_text_container">
            <p>Elimină Introducerea Manuală a Datelor</p>
            <img src="static/images/automation_lp_imgs/arrow_left.svg" alt="Săgeată">
            <p>Reduce Costurile cu 30-70%</p>
            <img src="static/images/automation_lp_imgs/arrow_left.svg" alt="Săgeată">
            <p>Eliberează Echipa pentru Muncă de Valoare</p>
        </div>
        
        <div class="hero-cta-group">
            <button onclick="openBookingModal()" class="primary-cta-button">Programează Auditul Gratuit de Automatizare <span class="arrow-right">→</span></button>
            <button onclick="scrollToElement('automation_calculator_section')" class="secondary-cta-button">Calculează Economiile Tale</button>
        </div>
        
        <div class="hero-proof">
            <div class="proof-item">
                <span class="proof-number">85%</span>
                <span class="proof-text">Reducere a Sarcinilor Manuale</span>
            </div>
            <div class="proof-divider"></div>
            <div class="proof-item">
                <span class="proof-number">45%</span>
                <span class="proof-text">Economii de Costuri</span>
            </div>
            <div class="proof-divider"></div>
            <div class="proof-item">
                <span class="proof-number">3x</span>
                <span class="proof-text">ROI în Primul An</span>
            </div>
        </div>
    </div>
</section>

<!-- Automation ROI Calculator Section -->
<section id="automation_calculator_section" class="calculator_section">
    <div class="container">
        <div class="section-header">
            <h2>Calculează Economiile Tale prin Automatizare</h2>
            <div class="section-divider"></div>
            <p class="section-description">Vezi cât timp și bani ar putea economisi afacerea ta prin automatizare strategică</p>
        </div>
        
        <div class="calculator-container">
            <div class="calculator-form">
                <h3>Introdu Informațiile Tale</h3>
                
                <div class="calculator-input-group">
                    <label for="employees">Număr de angajați care efectuează sarcini repetitive:</label>
                    <input type="number" id="employees" min="1" max="1000" value="3">
                </div>
                
                <div class="calculator-input-group">
                    <label for="hourly-rate">Cost mediu pe oră per angajat (€):</label>
                    <input type="number" id="hourly-rate" min="10" max="200" value="20">
                </div>
                
                <div class="calculator-input-group">
                    <label for="hours-weekly">Ore petrecute pe sarcini repetitive (pe săptămână):</label>
                    <input type="number" id="hours-weekly" min="1" max="40" value="10">
                </div>
                
                <div class="calculator-input-group">
                    <label for="automation-percent">Procentul de sarcini care pot fi automatizate:</label>
                    <div class="range-slider-container">
                        <input type="range" id="automation-percent" min="40" max="90" value="70" class="range-slider">
                        <span id="automation-percent-value">70%</span>
                    </div>
                </div>
                
                <button id="calculate-roi" class="calculate-button">Calculează Economiile Mele</button>
            </div>
            
            <div class="calculator-results" id="calculator-results">
                <h3>Economiile Tale Potențiale</h3>
                
                <div class="result-card monthly">
                    <h4>Economii Lunare</h4>
                    <div class="result-value">€<span id="monthly-savings">1.680</span></div>
                    <div class="result-breakdown">Bazat pe <span id="monthly-hours">84</span> ore economisite</div>
                </div>
                
                <div class="result-card yearly">
                    <h4>Economii Anuale</h4>
                    <div class="result-value">€<span id="yearly-savings">20.160</span></div>
                    <div class="result-breakdown">Bazat pe <span id="yearly-hours">1.008</span> ore economisite</div>
                </div>
                
                <div class="result-card roi">
                    <h4>ROI pe 5 Ani</h4>
                    <div class="result-value"><span id="roi-multiple">25</span>x</div>
                    <div class="result-breakdown">Returnare a investiției în automatizare</div>
                </div>
                
                <div class="results-note">
                    <p>Vrei să explorezi exact ce procese ai putea automatiza?</p>
                    <button onclick="openBookingModal()" class="results-cta">Obține Evaluarea Gratuită de Automatizare</button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Content Section with Common Challenges -->
<section id="automation_examples_section">
    <!-- Pain Points Section -->
    <div class="automation_examples_tease_group">
        <h2>Provocări Comune ale <span>Afacerilor</span></h2>
        <span class="material-symbols-outlined arrow_animate">
            arrow_downward
        </span>
    </div>
    
    <!-- Pain Points Cards -->
    <div class="difficulties_group">
        <div>
            <span class="material-symbols-outlined difficulty_icon">
                hourglass_empty
            </span>
            Risipirea orelor pe sarcini manuale repetitive
        </div>
        <div>
            <span class="material-symbols-outlined difficulty_icon">
                error_outline
            </span>
            Fluxuri de lucru inconsistente care duc la erori
        </div>
        <div>
            <span class="material-symbols-outlined difficulty_icon">
                integration_instructions
            </span>
            Dificultăți în integrarea diverselor instrumente software
        </div>
    </div>

    <!-- Solutions Description -->
    <div class="automation_case_studies_group">
        <div class="text_part_automation_case_studies_group">
            <h2>Cum Pot Ajuta să Rezolv Aceste <span>Probleme</span></h2>
            <p>
                Creez soluții de automatizare personalizate folosind instrumente puternice precum Zapier, Brevo, n8n și altele. 
                Abordarea mea se concentrează pe identificarea nevoilor unice ale afacerii tale și dezvoltarea de soluții adaptate 
                care se integrează perfect cu sistemele tale existente. Prin automatizarea sarcinilor repetitive, echipa ta 
                se poate concentra pe activități cu valoare ridicată, reducând în același timp erorile și costurile.
            </p>
            <button onclick="openBookingModal()">Programează o Consultație</button>
        </div>
    </div>
</section>

<!-- Enhanced Capabilities Section -->
<section class="automation_capabilities_section">
    <div class="container">
        <div class="section-header">
            <h2>Ce Poți Automatiza?</h2>
            <div class="section-divider"></div>
            <p class="section-description">Descoperă procesele de afaceri care pot fi transformate prin automatizare strategică</p>
        </div>
        
        <div class="capabilities-grid">
            <!-- Capability 1: Lead Management -->
            <div class="capability-card">
                <div class="capability-icon">
                    <span class="material-symbols-outlined">person_add</span>
                </div>
                <div class="capability-content">
                    <h3>Gestionarea Lead-urilor</h3>
                    <p>Captează, califică și direcționează automat lead-urile de pe site-ul tău web, social media și alte canale către CRM-ul tău. Urmărește cu e-mailuri personalizate în funcție de comportamentul lead-urilor.</p>
                    
                    <div class="capability-metrics">
                        <div class="metric">
                            <span class="metric-value">68%</span>
                            <span class="metric-label">Răspuns mai Rapid la Lead-uri</span>
                        </div>
                        <div class="metric">
                            <span class="metric-value">37%</span>
                            <span class="metric-label">Creștere a Conversiei</span>
                        </div>
                    </div>
                    
                    <div class="tools-used">
                        <span class="tool-tag">Brevo</span>
                        <span class="tool-tag">Zapier</span>
                        <span class="tool-tag">Make</span>
                    </div>
                </div>
            </div>
            
            <!-- Capability 2: Order Processing -->
            <div class="capability-card">
                <div class="capability-icon">
                    <span class="material-symbols-outlined">shopping_cart</span>
                </div>
                <div class="capability-content">
                    <h3>Procesarea Comenzilor</h3>
                    <p>Automatizează actualizările stocului, confirmările comenzilor, notificările de expediere și crearea facturilor. Conectează platforma ta de e-commerce cu sistemele de contabilitate și de îndeplinire.</p>
                    
                    <div class="capability-metrics">
                        <div class="metric">
                            <span class="metric-value">75%</span>
                            <span class="metric-label">Timp de Procesare Redus</span>
                        </div>
                        <div class="metric">
                            <span class="metric-value">93%</span>
                            <span class="metric-label">Mai Puține Erori</span>
                        </div>
                    </div>
                    
                    <div class="tools-used">
                        <span class="tool-tag">n8n</span>
                        <span class="tool-tag">Make</span>
                        <span class="tool-tag">Zapier</span>
                    </div>
                </div>
            </div>
            
            <!-- Capability 3: Document Processing -->
            <div class="capability-card">
                <div class="capability-icon">
                    <span class="material-symbols-outlined">description</span>
                </div>
                <div class="capability-content">
                    <h3>Procesarea Documentelor</h3>
                    <p>Extrage date din e-mailuri, PDF-uri și alte documente și direcționează-le către sistemele potrivite. Generează automat contracte, propuneri și rapoarte bazate pe șabloane.</p>
                    
                    <div class="capability-metrics">
                        <div class="metric">
                            <span class="metric-value">85%</span>
                            <span class="metric-label">Reducere a Introducerii de Date</span>
                        </div>
                        <div class="metric">
                            <span class="metric-value">67%</span>
                            <span class="metric-label">Creare Mai Rapidă a Documentelor</span>
                        </div>
                    </div>
                    
                    <div class="tools-used">
                        <span class="tool-tag">Zapier</span>
                        <span class="tool-tag">Make</span>
                        <span class="tool-tag">Docusign</span>
                    </div>
                </div>
            </div>
            
            <!-- Capability 4: Customer Support -->
            <div class="capability-card">
                <div class="capability-icon">
                    <span class="material-symbols-outlined">support_agent</span>
                </div>
                <div class="capability-content">
                    <h3>Suport Clienți</h3>
                    <p>Direcționează solicitările de suport către membrii potriviți ai echipei, trimite răspunsuri automate la întrebările frecvente și urmărește biletele rezolvate cu sondaje de satisfacție.</p>
                    
                    <div class="capability-metrics">
                        <div class="metric">
                            <span class="metric-value">42%</span>
                            <span class="metric-label">Timp de Rezolvare Mai Rapid</span>
                        </div>
                        <div class="metric">
                            <span class="metric-value">24%</span>
                            <span class="metric-label">Satisfacție Mai Mare</span>
                        </div>
                    </div>
                    
                    <div class="tools-used">
                        <span class="tool-tag">Brevo</span>
                        <span class="tool-tag">n8n</span>
                        <span class="tool-tag">Make</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="capabilities-cta">
            <p>Te întrebi ce procese din afacerea ta pot fi automatizate?</p>
            <button onclick="openBookingModal()" class="capabilities-button">Programează Evaluarea Gratuită de Automatizare</button>
        </div>
    </div>
</section>

<!-- Enhanced Case Study Section -->
<section class="automation_case_study_section">
    <div class="container">
        <div class="section-header">
            <h2>Poveste de Succes în Automatizare</h2>
            <div class="section-divider"></div>
            <p class="section-description">Un exemplu din lumea reală despre cum automatizarea afacerii a transformat operațiunile</p>
        </div>
        
        <div class="featured-case-study">
            <div class="case-study-header">
                <div class="case-study-badge">Automatizare Marketing</div>
                <h3>Cum a Crescut un Furnizor de Servicii B2B Calitatea Lead-urilor cu 45% Reducând în Același Timp Munca Manuală</h3>
            </div>
            
            <div class="case-study-content">
                <div class="case-study-challenge">
                    <h4>Provocarea</h4>
                    <p>Un furnizor de servicii B2B se confrunta cu dificultăți în procesul de gestionare a lead-urilor. Echipa lor de marketing petrecea peste 15 ore săptămânal transferând manual lead-urile din formularele de pe site în CRM, trimițând e-mailuri de follow-up și actualizând statusurile lead-urilor. Acest proces manual a dus la:</p>
                    <ul class="challenge-list">
                        <li>Timpi lenți de răspuns pentru lead-urile noi (peste 24 ore)</li>
                        <li>Secvențe de follow-up inconsistente</li>
                        <li>Lead-uri pierdute pe parcurs</li>
                        <li>Echipa de marketing incapabilă să se concentreze pe activități strategice</li>
                        <li>Lipsă de vizibilitate asupra comportamentului lead-urilor după contactul inițial</li>
                    </ul>
                </div>
                
                <div class="case-study-solution">
                    <h4>Soluția</h4>
                    <p>Am dezvoltat un sistem cuprinzător de nurturing lead-uri folosind Brevo și Zapier care:</p>
                    
                    <div class="solution-steps">
                        <div class="solution-step">
                            <div class="step-number">1</div>
                            <div class="step-content">
                                <h5>Integrare Formular Web</h5>
                                <p>A conectat formularele de pe site direct cu Brevo, capturând toate informațiile despre lead-uri în timp real.</p>
                            </div>
                        </div>
                        
                        <div class="solution-step">
                            <div class="step-number">2</div>
                            <div class="step-content">
                                <h5>Scoring Automatizat al Lead-urilor</h5>
                                <p>A creat un sistem care evaluează automat lead-urile în funcție de industrie, dimensiunea companiei și nevoile exprimate.</p>
                            </div>
                        </div>
                        
                        <div class="solution-step">
                            <div class="step-number">3</div>
                            <div class="step-content">
                                <h5>Secvențe de Nurturing Personalizate</h5>
                                <p>A dezvoltat secvențe diferite de e-mail declanșate de scorul lead-ului și tipul inițial de cerere.</p>
                            </div>
                        </div>
                        
                        <div class="solution-step">
                            <div class="step-number">4</div>
                            <div class="step-content">
                                <h5>Integrare CRM</h5>
                                <p>A sincronizat toate datele despre lead-uri și interacțiunile cu sistemul CRM pentru vizibilitatea echipei de vânzări.</p>
                            </div>
                        </div>
                        
                        <div class="solution-step">
                            <div class="step-number">5</div>
                            <div class="step-content">
                                <h5>Alerte Bazate pe Comportament</h5>
                                <p>A creat notificări instantanee pentru echipa de vânzări atunci când lead-urile au arătat intenție ridicată de cumpărare.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="case-study-results">
                    <h4>Rezultatele</h4>
                    
                    <div class="results-metrics">
                        <div class="result-metric">
                            <span class="result-value">45%</span>
                            <span class="result-label">Creștere a Lead-urilor Calificate</span>
                            <p class="result-description">Targetarea și nurturing-ul îmbunătățite au crescut calitatea lead-urilor</p>
                        </div>
                        
                        <div class="result-metric">
                            <span class="result-value">93%</span>
                            <span class="result-label">Timp de Răspuns Mai Rapid</span>
                            <p class="result-description">De la peste 24 ore la sub 2 ore</p>
                        </div>
                        
                        <div class="result-metric">
                            <span class="result-value">15ore</span>
                            <span class="result-label">Timp Economisit Săptămânal</span>
                            <p class="result-description">Echipa de marketing redirecționată către munca strategică</p>
                        </div>
                        
                        <div class="result-metric">
                            <span class="result-value">28%</span>
                            <span class="result-label">Rată de Conversie Mai Mare</span>
                            <p class="result-description">De la lead inițial la conversație de vânzări</p>
                        </div>
                    </div>
                    
                    <div class="client-quote">
                        <p>"Sistemul de automatizare a transformat complet modul în care gestionăm lead-urile. Echipa noastră de marketing se concentrează acum pe crearea de campanii în loc de introducerea manuală a datelor, iar echipa noastră de vânzări are o vizibilitate mult mai bună asupra comportamentului lead-urilor. ROI-ul a fost remarcabil."</p>
                        <div class="quote-author">— Director de Marketing</div>
                    </div>
                </div>
                
                <div class="case-study-tools">
                    <h4>Instrumente Utilizate</h4>
                    <div class="tools-list">
                        <div class="tool-item">
                            <img src="static/images/automation_programs_logos/Brevo-Logo-1.svg" alt="Brevo">
                            <span>Brevo</span>
                        </div>
                        <div class="tool-item">
                            <img src="static/images/automation_programs_logos/zapier.svg" alt="Zapier">
                            <span>Zapier</span>
                        </div>
                        <div class="tool-item">
                            <img src="static/images/automation_programs_logos/Make-Logo-RGB.svg" alt="Make">
                            <span>Make</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="case-study-cta">
                <p>Vrei să vezi rezultate similare pentru afacerea ta?</p>
                <button onclick="openBookingModal()" class="case-study-button">Programează Evaluarea Gratuită de Automatizare</button>
            </div>
        </div>
    </div>
</section>

<!-- Automation Lead Magnet Section -->
<section class="automation_lead_magnet_section">
    <div class="container">
        <div class="lead-magnet-container">
            <div class="lead-magnet-content">
                <div class="lead-magnet-badge">CHECKLIST GRATUIT</div>
                <h2>Identificator de Oportunități de Automatizare în 27 de Puncte</h2>
                <p>Descoperă ce procese din afacerea ta te costă cel mai mult timp și bani și cum pot fi automatizate pentru un ROI maxim.</p>
                
                <ul class="checklist-features">
                    <li><span class="check-icon">✓</span> Identifică oportunitățile tale de automatizare cu impact maxim</li>
                    <li><span class="check-icon">✓</span> Calculează potențialele economii de timp și costuri</li>
                    <li><span class="check-icon">✓</span> Află care sunt cele mai bune instrumente pentru diferite procese</li>
                    <li><span class="check-icon">✓</span> Creează-ți foaia de parcurs pentru automatizare în ordinea priorităților</li>
                </ul>
                
                <div class="checklist-testimonial">
                    <p>"Acest checklist ne-a ajutat să identificăm peste 12.000 € economii anuale doar prin automatizarea procesului nostru de facturare. Valorează greutatea sa în aur."</p>
                    <div class="testimonial-author">— Manager Operațiuni într-un IMM Românesc</div>
                </div>
            </div>
            
            <div class="lead-magnet-form">
                <div class="checklist-preview">
                    <img src="static/images/resources/automation-checklist-preview.png" alt="Previzualizare Checklist Identificator de Oportunități de Automatizare">
                </div>
                
                <form id="checklistForm" action="includes/download_resource.php" method="POST">
                    <input type="hidden" name="resource_type" value="automation-checklist">
                    
                    <div class="form-group">
                        <label for="checklist-name">Numele Tău</label>
                        <input type="text" id="checklist-name" name="name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="checklist-email">Email pentru Trimiterea Checklist-ului</label>
                        <input type="email" id="checklist-email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="checklist-company">Companie</label>
                        <input type="text" id="checklist-company" name="company">
                    </div>
                    
                    <div class="form-group">
                        <label for="checklist-interest">Ce proces te interesează cel mai mult să automatizezi?</label>
                        <select id="checklist-interest" name="interest">
                            <option value="lead-management">Gestionarea Lead-urilor</option>
                            <option value="order-processing">Procesarea Comenzilor</option>
                            <option value="document-handling">Gestionarea Documentelor</option>
                            <option value="customer-support">Suport Clienți</option>
                            <option value="reporting">Raportare & Analiză</option>
                            <option value="other">Altele (Te rog specifică)</option>
                        </select>
                    </div>
                    
                    <div class="form-group other-container" style="display: none;">
                        <label for="checklist-other">Te rog specifică:</label>
                        <input type="text" id="checklist-other" name="other_interest">
                    </div>
                    
                    <div class="form-checkbox">
                        <input type="checkbox" id="checklist-consent" name="consent" required>
                        <label for="checklist-consent">Sunt de acord să primesc checklist-ul și ocazional sfaturi de automatizare</label>
                    </div>
                    
                    <button type="submit" class="checklist-submit">Descarcă Checklist-ul Gratuit <span class="arrow-right">→</span></button>
                </form>
                
                <div class="downloads-count">
                    <span class="material-symbols-outlined">download</span>
                    <p>Descărcat de 315 profesioniști în afaceri</p>
                </div>
            </div>
        </div>
    </div>
</section>
</main>
<!-- Enhanced Booking Modal -->
<div id="bookingModal" class="booking-modal hidden">
    <div class="booking-modal-content">
        <button class="modal-close" onclick="closeBookingModal()">
            <span>&times;</span>
        </button>
    <div class="modal-header">
        <h2>Programează Evaluarea Gratuită de Automatizare</h2>
        <p>Planifică o consultație de 30 de minute pentru a identifica cele mai bune oportunități de automatizare (<strong>valoare de 150 €</strong>)</p>
    </div>
    
    <div class="booking-columns">
        <div class="booking-form-column">
            <form id="bookingForm" action="includes/submit_booking.php" method="POST">
                <input type="hidden" id="booking-service-type" name="service_type" value="Automation">
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="booking-name">Nume Complet</label>
                        <input type="text" id="booking-name" name="name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="booking-email">Email de Afaceri</label>
                        <input type="email" id="booking-email" name="email" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="booking-company">Numele Companiei</label>
                        <input type="text" id="booking-company" name="company">
                    </div>
                    
                    <div class="form-group">
                        <label for="booking-phone">Număr de Telefon</label>
                        <input type="tel" id="booking-phone" name="phone" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="booking-service">Domeniu de Interes</label>
                    <select id="booking-service" name="service" required>
                        <option value="Automation" selected>Automatizare Afaceri</option>
                        <option value="Marketing Automation">Automatizare Marketing</option>
                        <option value="E-commerce Automation">Automatizare E-commerce</option>
                        <option value="Document Automation">Automatizare Documente</option>
                        <option value="Customer Support Automation">Automatizare Suport Clienți</option>
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
                    <label for="booking-description">Ce procese ai dori să automatizezi?</label>
                    <textarea id="booking-description" name="description" rows="4" placeholder="Te rog să descrii procesele manuale din afacerea ta pe care ai dori să le automatizezi..." required></textarea>
                </div>
                
                <div class="form-group">
                    <label for="booking-team-size">Câte persoane sunt implicate în aceste procese?</label>
                    <select id="booking-team-size" name="team_size" required>
                        <option value="1-5">1-5 persoane</option>
                        <option value="6-15">6-15 persoane</option>
                        <option value="16-50">16-50 persoane</option>
                        <option value="51+">51+ persoane</option>
                    </select>
                </div>
                
                <div class="form-checkbox">
                    <input type="checkbox" id="privacy-policy" name="privacy_policy" required>
                    <label for="privacy-policy">
                        Sunt de acord cu <a href="privacy-policy.php" target="_blank">politica de confidențialitate</a> și îmi dau consimțământul pentru a fi contactat în legătură cu această solicitare.
                    </label>
                </div>
                
                <div class="form-submit">
                    <button type="submit" class="booking-submit-btn">Confirmă Programarea</button>
                </div>
            </form>
        </div>
        
        <div class="booking-info-column">
            <div class="session-includes">
                <h3>Evaluarea Gratuită Include:</h3>
                <ul>
                    <li><span class="check-icon">✓</span> Consultație video de 30 de minute</li>
                    <li><span class="check-icon">✓</span> Revizuirea proceselor tale actuale</li>
                    <li><span class="check-icon">✓</span> Identificarea oportunităților de automatizare</li>
                    <li><span class="check-icon">✓</span> Recomandări de instrumente</li>
                    <li><span class="check-icon">✓</span> Estimarea economiilor de timp și costuri</li>
                </ul>
            </div>
            
            <div class="booking-testimonial">
                <p>"Evaluarea de automatizare a fost revelatoare. Petrică a identificat rapid câteva procese pe care le puteam automatiza la care nici nu ne gândisem. Recomandările lui ne-au ajutat să economisim peste 20 de ore de muncă pe săptămână."</p>
                <div class="booking-testimonial-author">
                    <span>Manager de Marketing într-o Companie B2B Românească</span>
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
                    <p>Dacă nu primești cel puțin 3 idei viabile de automatizare în timpul sesiunii noastre, îți voi trimite un card cadou de 50 € ca scuză pentru timpul tău.</p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Notification Area -->
<div id="notification" class="hidden">
    <p id="notification-message"></p>
</div>
<!-- JavaScript -->
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
        
        // ROI Calculator
        // Update automation percentage value when slider moves
        const automationSlider = document.getElementById('automation-percent');
        const automationValue = document.getElementById('automation-percent-value');
        
        if (automationSlider && automationValue) {
            automationSlider.addEventListener('input', function() {
                automationValue.textContent = this.value + '%';
                calculateSavings();
            });
            
            // Calculate when the calculate button is clicked
            document.getElementById('calculate-roi').addEventListener('click', calculateSavings);
            
            // Also calculate when any input changes
            document.getElementById('employees').addEventListener('input', calculateSavings);
            document.getElementById('hourly-rate').addEventListener('input', calculateSavings);
            document.getElementById('hours-weekly').addEventListener('input', calculateSavings);
            
            // Initial calculation
            calculateSavings();
        }
        
        function calculateSavings() {
            // Get input values
            const employees = parseInt(document.getElementById('employees').value) || 1;
            const hourlyRate = parseInt(document.getElementById('hourly-rate').value) || 20;
            const hoursWeekly = parseInt(document.getElementById('hours-weekly').value) || 10;
            const automationPercent = parseInt(document.getElementById('automation-percent').value) || 70;
            
            // Calculate savings
            const weeklyHoursSaved = employees * hoursWeekly * (automationPercent / 100);
            const monthlyHoursSaved = weeklyHoursSaved * 4;
            const yearlyHoursSaved = weeklyHoursSaved * 48; // Accounting for holidays
            
            const monthlySavings = monthlyHoursSaved * hourlyRate;
            const yearlySavings = yearlyHoursSaved * hourlyRate;
            
            // Estimate ROI (assuming average automation solution costs around €4,000)
            const automationCost = 4000;
            const fiveYearSavings = yearlySavings * 5;
            const roiMultiple = Math.round(fiveYearSavings / automationCost);
            
            // Update results
            document.getElementById('monthly-savings').textContent = monthlySavings.toLocaleString();
            document.getElementById('yearly-savings').textContent = yearlySavings.toLocaleString();
            document.getElementById('monthly-hours').textContent = Math.round(monthlyHoursSaved).toLocaleString();
            document.getElementById('yearly-hours').textContent = Math.round(yearlyHoursSaved).toLocaleString();
            document.getElementById('roi-multiple').textContent = roiMultiple;
            
            // Show results with animation
            const resultsContainer = document.getElementById('calculator-results');
            resultsContainer.style.opacity = '0';
            setTimeout(() => {
                resultsContainer.style.opacity = '1';
            }, 300);
        }
        
        // Checklist form - show/hide the "other" field based on selection
        const interestSelect = document.getElementById('checklist-interest');
        const otherContainer = document.querySelector('.other-container');
        
        if (interestSelect && otherContainer) {
            interestSelect.addEventListener('change', function() {
                if (this.value === 'other') {
                    otherContainer.style.display = 'block';
                } else {
                    otherContainer.style.display = 'none';
                }
            });
        }
        
        // Smooth scroll function
        function scrollToElement(elementId) {
            const element = document.getElementById(elementId);
            if (element) {
                element.scrollIntoView({ behavior: 'smooth' });
            }
        }
        
        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('bookingModal');
            if (event.target === modal) {
                closeBookingModal();
            }
        });
        
        // Expose functions globally
        window.openBookingModal = openBookingModal;
        window.closeBookingModal = closeBookingModal;
        window.scrollToElement = scrollToElement;
        window.calculateSavings = calculateSavings;
    });
</script>
<?php include(ROOT_PATH . '/includes/footer.php'); ?>
</body>
</html>