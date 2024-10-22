<?php
include('db.php');
include('header.php');
//session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    header('Location: login.php');
    exit();
}

// Get the user ID from the query string
$user_id = $_GET['user_id'];

// Fetch the document details for the specific user
$sql = "SELECT * FROM documents WHERE user_id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->execute(['user_id' => $user_id]);
$documents = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if documents exist
if (!$documents) {
    die("No documents found for this user.");
}


?>
<h2>MedShipment<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAI9JREFUWEft110KgCAQBODxZHWz6mZ5sn4gfQhkdqVgkfF1N50+TCwh2EjB8mCYQCuAhehuV/3uc41eIQVizBKSUBHQV8b2Qngh68k6A5jI22YAOxN56nXdt9BhnODrtppDgRq0EmJ7TkLjCIU7GBltqeuCxqQkJCFdYdkekNDfQtb53X29fx3uhawPhAt0AjKFNiX9lAKHAAAAAElFTkSuQmCC"/></h2>
<p>Your trusted partner for medication delivery.</p><br>
<h3>Documents for Applicant ID: <?= htmlspecialchars($user_id); ?></h3>
<table class="table">
    <thead>
        <tr>
            <th>Description</th>
            <th>ID Document</th>
            <th>Proof of Residence</th>
            <th>Medical Aid</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?= htmlspecialchars($documents['doctor_description']); ?></td>
            <td><a href="uploads/<?= htmlspecialchars($documents['id_document']); ?>" target="_blank">View ID Document</a></td>
            <td><a href="uploads/<?= htmlspecialchars($documents['proof_of_residence']); ?>" target="_blank">View Proof of Residence</a></td>
            <td><a href="uploads/<?= htmlspecialchars($documents['medical_aid']); ?>" target="_blank">View Medical Aid</a></td>
        </tr>
    </tbody>
</table>
<a href="admin.php" class="btn btn-secondary">Back to Admin Dashboard</a>
<?php include('footer.php'); ?>
