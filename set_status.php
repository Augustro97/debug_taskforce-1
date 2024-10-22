<?php
include('db.php');
include('header.php');
//session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $status = $_POST['status'];
    $delivery_date = $_POST['delivery_date'];
    $admin_message = $_POST['admin_message'];

    $sql = "UPDATE documents SET status = :status, delivery_date = :delivery_date, admin_message = :admin_message WHERE user_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'status' => $status,
        'delivery_date' => $delivery_date,
        'admin_message' => $admin_message,
        'user_id' => $user_id,
    ]);

    header('Location: admin.php');
}

$user_id = $_GET['user_id'];

?>
<h2>MedShipment<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAI9JREFUWEft110KgCAQBODxZHWz6mZ5sn4gfQhkdqVgkfF1N50+TCwh2EjB8mCYQCuAhehuV/3uc41eIQVizBKSUBHQV8b2Qngh68k6A5jI22YAOxN56nXdt9BhnODrtppDgRq0EmJ7TkLjCIU7GBltqeuCxqQkJCFdYdkekNDfQtb53X29fx3uhawPhAt0AjKFNiX9lAKHAAAAAElFTkSuQmCC"/></h2>
<p>Your trusted partner for medication delivery.</p><br>
<h3>Set Status for Applicant</h3>
<form method="post" action="">
    <input type="hidden" name="user_id" value="<?= $user_id; ?>">
    <div class="form-group">
        <label>Status</label>
        <select name="status" class="form-control" required>
            <option value="approved">Approved</option>
            <option value="rejected">Rejected</option>
        </select>
    </div>
    <div class="form-group">
        <label>Estimated Delivery Date</label>
        <input type="date" name="delivery_date" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Admin Message</label>
        <textarea name="admin_message" class="form-control" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Set Status</button>
</form>
<?php include('footer.php'); ?>
