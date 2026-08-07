<?php
require_once "db.php";
require_once "header.php";

$msg = "";
$msg_class = "";

// Handle form submission
if (isset($_POST['action']) && $_POST['action'] == 'update') {
    $reg_id = intval($_POST['reg_id']);
    $email = trim($_POST['email']);
    $event_id = intval($_POST['event_id']);

    if (empty($email) || empty($event_id)) {
        $msg = "Email address and event selection are required.";
        $msg_class = "error-msg";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = "Please enter a valid email address.";
        $msg_class = "error-msg";
    } else {
        $email = mysqli_real_escape_string($cn, $email);

        // Update registration
        $q = "UPDATE registrations
              SET email = '$email', event_id = $event_id
              WHERE id = $reg_id";

        if (mysqli_query($cn, $q)) {
            $msg = "Your Cybersecurity Club registration has been updated successfully!";
            $msg_class = "success-msg";
        } else {
            $msg = "Unable to update your registration. Please try again.";
            $msg_class = "error-msg";
        }
    }
}

// Get registration information
$reg_id = 0;

if (isset($_GET['id'])) {
    $reg_id = intval($_GET['id']);
} elseif (isset($_POST['reg_id'])) {
    $reg_id = intval($_POST['reg_id']);
}

$reg_query = "SELECT * FROM registrations WHERE id = $reg_id";
$reg_rs = mysqli_query($cn, $reg_query);
$registration = mysqli_fetch_assoc($reg_rs);

// Get all events
$events_rs = mysqli_query($cn, "SELECT id, title FROM events ORDER BY event_date ASC");
?>

<section class="panel">

    <h2>Update Event Registration</h2>

    <?php if ($msg != ""): ?>
        <div class="<?php echo $msg_class; ?>">
            <?php echo $msg; ?>
        </div>
    <?php endif; ?>

    <?php if ($registration): ?>

    <form action="edit_registration.php" method="post">

        <input type="hidden" name="action" value="update">
        <input type="hidden" name="reg_id" value="<?php echo $registration['id']; ?>">

        <div class="form-group">
            <label>Student Name (Read Only)</label>
            <input
                type="text"
                value="<?php echo htmlspecialchars($registration['student_name']); ?>"
                disabled>
        </div>

        <div class="form-group">
            <label>Student ID (Read Only)</label>
            <input
                type="text"
                value="<?php echo htmlspecialchars($registration['student_id']); ?>"
                disabled>
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input
                type="email"
                id="email"
                name="email"
                value="<?php echo htmlspecialchars($registration['email']); ?>">
        </div>

        <div class="form-group">
            <label for="event_id">Select Another Event</label>

            <select id="event_id" name="event_id">

                <?php while($e = mysqli_fetch_assoc($events_rs)): ?>

                <option
                    value="<?php echo $e['id']; ?>"
                    <?php if($registration['event_id'] == $e['id']) echo "selected"; ?>>

                    <?php echo htmlspecialchars($e['title']); ?>

                </option>

                <?php endwhile; ?>

            </select>

        </div>

        <button type="submit">Update Registration</button>

    </form>

    <?php else: ?>

        <p>Registration record not found.</p>

    <?php endif; ?>

</section>

<?php require_once "footer.php"; ?>