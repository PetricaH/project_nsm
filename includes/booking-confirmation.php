<?php require_once('../config.php');?>
<?php require_once(ROOT_PATH . '/includes/heading.php'); ?>

<?php
// Check if booking ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: ../webdev.php");
    exit();
}

$booking_id = intval($_GET['id']);

// Get booking details
$sql = "SELECT * FROM bookings WHERE booking_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    header("Location: ../webdev.php");
    exit();
}

$booking = $result->fetch_assoc();

// Format date and time
$formatted_date = date('l, j F, Y', strtotime($booking['booking_date'])); // Poți ajusta formatul datei dacă dorești
$formatted_time = date('H:i', strtotime($booking['booking_time']));
?>

<?php $page_css = 'confirmation.css';?>
<title>Confirmare Rezervare | Sesiune de Strategie | NOTSO</title>
<meta name="robots" content="noindex, nofollow">

<script>
  gtag('event', 'ads_conversion_SUBMIT_LEAD_FORM_1', {
    'value': 1,
    'currency': 'EUR',
    'transaction_id': <?php echo $booking_id; ?>
  });
</script>

<!-- Event snippet for Submit lead form conversion page -->
<script>
  gtag('event', 'conversion', {'send_to': 'AW-17115045461/JFouCL3wiN8aENW8i-E_'});
</script>


</head>

<body data-context="confirmation">

<?php include(ROOT_PATH . '/includes/navbar.php'); ?>

<main class="confirmation-page">
    <div class="container">
        <div class="confirmation-container">
            <div class="confirmation-header">
                <div class="check-icon">
                    <span class="material-symbols-outlined">check_circle</span>
                </div>
                <h1>Sesiunea ta de Strategie este Confirmată!</h1>
                <p>Îți mulțumesc pentru programarea consultației gratuite. Verifică-ți emailul pentru toate detaliile.</p>
            </div>
            
            <div class="confirmation-details">
                <div class="details-row">
                    <div class="detail-item">
                        <span class="detail-label">Numele Tău</span>
                        <span class="detail-value"><?php echo htmlspecialchars($booking['name']); ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Email</span>
                        <span class="detail-value"><?php echo htmlspecialchars($booking['email']); ?></span>
                    </div>
                </div>
                
                <div class="details-row">
                    <div class="detail-item">
                        <span class="detail-label">Data</span>
                        <span class="detail-value"><?php echo $formatted_date; ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Ora</span>
                        <span class="detail-value"><?php echo $formatted_time; ?></span>
                    </div>
                </div>
                
                <div class="details-row">
                    <div class="detail-item">
                        <span class="detail-label">Serviciu</span>
                        <span class="detail-value"><?php echo htmlspecialchars($booking['service']); ?></span>
                    </div>
                </div>
                
                <div class="add-to-calendar">
                    <h3>Adaugă în Calendar</h3>
                    <div class="calendar-buttons">
                        <a href="#" class="calendar-button google-calendar" onclick="addToGoogleCalendar(); return false;">Google Calendar</a>
                        <a href="#" class="calendar-button outlook-calendar" onclick="addToOutlookCalendar(); return false;">Outlook</a>
                        <a href="#" class="calendar-button ical-calendar" onclick="addToiCalendar(); return false;">iCalendar</a>
                    </div>
                </div>
            </div>
            
            <div class="confirmation-next-steps">
                <h2>Ce Urmează?</h2>
                <div class="steps-container">
                    <div class="step-item">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <h3>Verifică-ți Emailul</h3>
                            <p>Am trimis un email de confirmare la <?php echo htmlspecialchars($booking['email']); ?> cu toate detaliile sesiunii și un link pentru apelul video.</p>
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <h3>Pregătește-te pentru Discuție</h3>
                            <p>Gândește-te la obiectivele principale ale afacerii tale și la provocările legate de website. Pregătește întrebările specifice pe care ai dori să le discutăm în timpul sesiunii.</p>
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <h3>Intră în Apelul Video</h3>
                            <p>La ora programată, accesează linkul pentru apelul video din emailul de confirmare. Asigură-te că ai camera și microfonul funcționale.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="confirmation-resource">
                <h2>În Timp ce Aștepți</h2>
                <p>Fă un pas înainte și descarcă ghidul meu gratuit pentru optimizarea conversiilor pe website:</p>
                <div class="resource-container">
                    <div class="resource-image">
                        <img src="../static/images/resources/conversion-guide-preview.png" alt="Ghid Cadru Conversie Website">
                    </div>
                    <div class="resource-content">
                        <h3>Cadrul în 7 Pași pentru Creșterea Conversiilor</h3>
                        <p>Descoperă strategiile exacte pe care le folosesc pentru a crește rata de conversie a clienților mei cu o medie de 40%.</p>
                        <a href="#" class="resource-button" onclick="showResourceForm(); return false;">Descarcă Ghidul Gratuit</a>
                    </div>
                </div>
            </div>
            
            <div class="resource-form-container" id="resourceFormContainer" style="display: none;">
                <form id="confirmationResourceForm" action="download_resource.php" method="POST">
                    <div class="form-group">
                        <label for="resource-name">Numele Tău</label>
                        <input type="text" id="resource-name" name="name" value="<?php echo htmlspecialchars($booking['name']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="resource-email">Emailul pe care să trimit ghidul</label>
                        <input type="email" id="resource-email" name="email" value="<?php echo htmlspecialchars($booking['email']); ?>" required>
                    </div>
                    
                    <div class="form-checkbox">
                        <input type="checkbox" id="resource-consent" name="consent" required>
                        <label for="resource-consent">Sunt de acord să primesc ghidul gratuit și, ocazional, sfaturi utile.</label>
                    </div>
                    
                    <button type="submit" class="resource-submit">Descarcă Ghidul Gratuit</button>
                </form>
            </div>
            
            <div class="need-help">
                <h3>Ai Nevoie să Reprogramezi?</h3>
                <p>Dacă trebuie să reprogramezi sau ai întrebări, te rog să-mi scrii un email la <a href="mailto:hello@notsomarketing.com">hello@notsomarketing.com</a></p>
            </div>
        </div>
    </div>
</main>

<script>
function showResourceForm() {
    document.getElementById('resourceFormContainer').style.display = 'block';
    document.getElementById('resourceFormContainer').scrollIntoView({behavior: 'smooth'});
}

// Calendar functions would actually need proper implementation with
// the booking details encoded for each calendar type
function addToGoogleCalendar() {
    // Implementation for adding to Google Calendar
    alert('Integrarea cu Google Calendar va fi disponibilă în curând!');
}

function addToOutlookCalendar() {
    // Implementation for adding to Outlook
    alert('Integrarea cu Outlook va fi disponibilă în curând!');
}

function addToiCalendar() {
    // Implementation for adding to iCalendar
    alert('Integrarea cu iCalendar va fi disponibilă în curând!');
}
</script>

<?php include(ROOT_PATH . '/includes/footer.php'); ?>
</body>
</html>