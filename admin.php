<?php
include('db.php');
include('header.php');
//session_start(); // Ensure session is started

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    header('Location: login.php');
    exit();
}

// Fetch the admin's name from the database
$user_id = $_SESSION['user_id'];
$sql = "SELECT name FROM users WHERE id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->execute(['user_id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch all applicants
$sql = "SELECT * FROM users WHERE role = 'applicant'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$applicants = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<h2><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAIBJREFUSEvtlTEOgCAQBIePGS38tYn6Mm3EQoNOLoFGaVnYzN0tJCqvVPl+mhvMQF+gWoDh2FuBTuhuBNtLyTKx1f0GxYKew3OdIltbqwv34GnaJmDMbFECnc/mBhY9HDSLHm5ydQP7FoUJ7EGrC+fgwwY2B1bX/su0OdC66p/+DmVNKBlfzGUIAAAAAElFTkSuQmCC"/>MedShipment<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAI9JREFUWEft110KgCAQBODxZHWz6mZ5sn4gfQhkdqVgkfF1N50+TCwh2EjB8mCYQCuAhehuV/3uc41eIQVizBKSUBHQV8b2Qngh68k6A5jI22YAOxN56nXdt9BhnODrtppDgRq0EmJ7TkLjCIU7GBltqeuCxqQkJCFdYdkekNDfQtb53X29fx3uhawPhAt0AjKFNiX9lAKHAAAAAElFTkSuQmCC"/></h2>
<p>Your trusted partner for medication delivery.</p><br>
<h3>Welcome, <?= htmlspecialchars($user['name']); ?></h3>
<p>Admin dashboard</p><br>
<h4>Applicants</h4>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Documents Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($applicants as $applicant): ?>
        <tr>
            <td><?= htmlspecialchars($applicant['id']); ?></td>
            <td><?= htmlspecialchars($applicant['name']); ?></td>
            <td><?= htmlspecialchars($applicant['email']); ?></td>
            <td>
                <a href="view_documents.php?user_id=<?= $applicant['id']; ?>" class="btn btn-info">View Documents</a>
            </td>
            <td>
                <a href="set_status.php?user_id=<?= $applicant['id']; ?>" class="btn btn-warning">Set Status</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include('footer.php'); ?>
