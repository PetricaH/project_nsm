<?php require_once('config.php'); ?>
<?php require_once(ROOT_PATH . '/includes/heading.php'); ?>

<?php
// Check if resource type is provided
$resource_type = isset($_GET['type']) ? $_GET['type'] : '';

// Set up resource details based on type
switch ($resource_type) {
    case 'conversion-framework':
        $resource_title = "Cadrul de Conversie pentru Site-uri Web în 7 Pași";
        $resource_icon = "trending_up";
        $resource_description = "Ghidul tău pentru creșterea ratelor de conversie ale site-urilor web";
        break;
    case 'seo-checklist':
        $resource_title = "Lista de Verificare SEO pentru Afaceri Românești";
        $resource_icon = "search";
        $resource_description = "21 de sfaturi practice pentru îmbunătățirea poziționării tale în căutările locale";
        break;
    default:
        $resource_title = "Resursa Ta Gratuită";
        $resource_icon = "download";
        $resource_description = "Îți mulțumim pentru descărcare";
}
?>

<?php $page_css = 'thank-you.css';?>
<title>Mulțumim pentru Descărcare | Hreniuc Petrică</title>
<meta name="robots" content="noindex, nofollow">
</head>

<body data-context="thank-you">

<?php include(ROOT_PATH . '/includes/navbar.php'); ?>

<main class="thank-you-page">
    <div class="container">
        <div class="thank-you-container">
            <div class="thank-you-header">
                <div class="resource-icon">
                    <span class="material-symbols-outlined"><?php echo $resource_icon; ?></span>
                </div>
                <h1>Ghidul Tău Este pe Drum!</h1>
                <p>Verifică căsuța de email pentru <strong><?php echo $resource_title; ?></strong>.</p>
            </div>
            
            <div class="email-instructions">
                <h2>Pașii Următori</h2>
                <div class="steps-container">
                    <div class="step-item">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <h3>Verifică-ți Inbox-ul</h3>
                            <p>Tocmai ți-am trimis un email cu <?php echo strtolower($resource_title); ?>. Dacă nu îl vezi, te rugăm să verifici și folderul de spam.</p>
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <h3>Descarcă Ghidul Tău</h3>
                            <p>Dă click pe link-ul de descărcare din email pentru a accesa ghidul tău. Salvează-l pentru consultare ulterioară.</p>
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <h3>Implementează Strategiile</h3>
                            <p>Aplică sfaturile practice din ghid pentru a vedea îmbunătățiri reale în performanța site-ului tău web.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bonus-content">
                <h2>Sfaturi Bonus Exclusive</h2>
                
                <?php if ($resource_type == 'conversion-framework'): ?>
                <div class="bonus-tip">
                    <h3>Câștig Rapid: Regula de 5 Secunde</h3>
                    <p>Un vizitator ar trebui să înțeleagă ce oferă site-ul tău în primele 5 secunde de la aterizarea pe pagina ta principală. Testează acest lucru arătând site-ul tău cuiva pentru doar 5 secunde, apoi întrebându-l cu ce se ocupă afacerea ta. Dacă nu poate răspunde clar, mesajul tău trebuie simplificat.</p>
                </div>
                <?php elseif ($resource_type == 'seo-checklist'): ?>
                <div class="bonus-tip">
                    <h3>Câștig Rapid: Schema pentru Afaceri Locale</h3>
                    <p>Implementarea marcajului schema LocalBusiness pe site-ul tău ajută motoarele de căutare românești să înțeleagă locația afacerii tale, programul și serviciile. Această îmbunătățire tehnică SEO simplă poate crește semnificativ vizibilitatea ta în rezultatele căutărilor locale.</p>
                </div>
                <?php else: ?>
                <div class="bonus-tip">
                    <h3>Câștig Rapid: Performanța Site-ului Web</h3>
                    <p>Optimizarea imaginilor tale poate reduce timpul de încărcare a paginii cu până la 80%. Folosește formate moderne precum WebP și implementează încărcarea leneșă (lazy loading) pentru a îmbunătăți dramatic viteza site-ului tău și experiența utilizatorilor.</p>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="next-steps-cta">
                <h2>Ești Gata să Faci Pasul Următor?</h2>
                <p>Programează o sesiune gratuită de strategie pentru a discuta cum aceste strategii pot fi adaptate specific pentru afacerea ta:</p>
                <button onclick="window.location.href='webdev.php#booking-section'" class="cta-button">Programează Sesiunea Gratuită de Strategie</button>
            </div>
        </div>
    </div>
</main>

<?php include(ROOT_PATH . '/includes/footer.php'); ?>
</body>
</html>