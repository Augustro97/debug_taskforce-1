<?php
include('db.php');
include('header.php');
//session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'applicant') {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user data
$sql = "SELECT * FROM users WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->execute(['id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch documents for user
$sql = "SELECT * FROM documents WHERE user_id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->execute(['user_id' => $user_id]);
$documents = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<h2><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAIBJREFUSEvtlTEOgCAQBIePGS38tYn6Mm3EQoNOLoFGaVnYzN0tJCqvVPl+mhvMQF+gWoDh2FuBTuhuBNtLyTKx1f0GxYKew3OdIltbqwv34GnaJmDMbFECnc/mBhY9HDSLHm5ydQP7FoUJ7EGrC+fgwwY2B1bX/su0OdC66p/+DmVNKBlfzGUIAAAAAElFTkSuQmCC"/>MedShipment<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAI9JREFUWEft110KgCAQBODxZHWz6mZ5sn4gfQhkdqVgkfF1N50+TCwh2EjB8mCYQCuAhehuV/3uc41eIQVizBKSUBHQV8b2Qngh68k6A5jI22YAOxN56nXdt9BhnODrtppDgRq0EmJ7TkLjCIU7GBltqeuCxqQkJCFdYdkekNDfQtb53X29fx3uhawPhAt0AjKFNiX9lAKHAAAAAElFTkSuQmCC"/></h2>
<p>Your trusted partner for medication delivery.</p><br>
<h3>Welcome, <?= htmlspecialchars($user['name']); ?></h3>
<p>Client dasboard</p><br>
<h4>Your Documents</h4>
<?php if (count($documents) > 0): ?>
    <ul>
        <?php foreach ($documents as $doc): ?>
            <li>
                Doctor's Description: <?= htmlspecialchars($doc['doctor_description']); ?> 
                | Status: <?= htmlspecialchars($doc['status']); ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No documents uploaded.</p>
<?php endif; ?><br>
<p>Press the button below to request for medication.</p>
<a href="upload.php" class="btn btn-primary">Upload Documents</a>
<?php include('footer.php'); ?>
