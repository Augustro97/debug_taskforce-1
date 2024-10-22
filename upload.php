<?php
include('db.php');
include('header.php');
//session_start();

// Check if the user is logged in and is an applicant
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'applicant') {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Handle the document upload form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture form data
    $doctor_description = $_POST['doctor_description'];
    
    // Handle file uploads
    $id_document = $_FILES['id_document']['name'];
    $proof_of_residence = $_FILES['proof_of_residence']['name'];
    $medical_aid = $_FILES['medical_aid']['name'];

    // Define a directory to store uploaded files
    $uploadDir = 'uploads/'; // Ensure this directory exists and is writable

    // Move uploaded files to the designated directory
    move_uploaded_file($_FILES['id_document']['tmp_name'], $uploadDir . $id_document);
    move_uploaded_file($_FILES['proof_of_residence']['tmp_name'], $uploadDir . $proof_of_residence);
    move_uploaded_file($_FILES['medical_aid']['tmp_name'], $uploadDir . $medical_aid);

    // Insert document details into the database
    $sql = "INSERT INTO documents (user_id, doctor_description, id_document, proof_of_residence, medical_aid) 
            VALUES (:user_id, :doctor_description, :id_document, :proof_of_residence, :medical_aid)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'user_id' => $user_id,
        'doctor_description' => $doctor_description,
        'id_document' => $id_document,
        'proof_of_residence' => $proof_of_residence,
        'medical_aid' => $medical_aid,
    ]);

    // Redirect to dashboard after successful upload
    header('Location: dashboard.php');
    exit();
}


?>
<h2>MedShipment<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAI9JREFUWEft110KgCAQBODxZHWz6mZ5sn4gfQhkdqVgkfF1N50+TCwh2EjB8mCYQCuAhehuV/3uc41eIQVizBKSUBHQV8b2Qngh68k6A5jI22YAOxN56nXdt9BhnODrtppDgRq0EmJ7TkLjCIU7GBltqeuCxqQkJCFdYdkekNDfQtb53X29fx3uhawPhAt0AjKFNiX9lAKHAAAAAElFTkSuQmCC"/></h2>
<p>Your trusted partner for medication delivery.</p><br>
<h2>Upload Documents</h2>
<form method="post" action="" enctype="multipart/form-data">
    <div class="form-group">
        <label>Doctor's Description</label>
        <input type="text" name="doctor_description" class="form-control" required>
    </div>
    <div class="form-group">
        <label>ID Document</label>
        <input type="file" name="id_document" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Proof of Residence</label>
        <input type="file" name="proof_of_residence" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Medical Aid</label>
        <input type="file" name="medical_aid" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Upload</button>
</form>
<?php include('footer.php'); ?>
