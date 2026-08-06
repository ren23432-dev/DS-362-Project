<?php
require_once "db.php";
require_once "header.php";

// Get the selected event ID from the URL
$event_id = 0;
if (isset($_GET['id'])) {
    $event_id = intval($_GET['id']);
}

// Retrieve event details
$query = "SELECT * FROM events WHERE id = $event_id";
$rs = mysqli_query($cn, $query);
$event = mysqli_fetch_assoc($rs);
?>

<section class="panel">

<?php if($event): ?>

    <h2><?php echo htmlspecialchars($event['title']); ?></h2>

    <p><strong>Event Date:</strong>
        <?php echo date("l, F d, Y", strtotime($event['event_date'])); ?>
    </p>

    <p><strong>Location:</strong>
        <?php echo htmlspecialchars($event['location']); ?>
    </p>

    <p><strong>Event Description:</strong></p>

    <p>
        <?php echo nl2br(htmlspecialchars($event['description'])); ?>
    </p>

    <form action="register.php" method="get">

        <input
            type="hidden"
            name="preselect"
            value="<?php echo $event['id']; ?>">

        <button type="submit">
            Register for This Cybersecurity Event
        </button>

    </form>

<?php else: ?>

    <h2>Event Not Found</h2>

    <p>
        Sorry, the requested cybersecurity event could not be found.
    </p>

<?php endif; ?>

</section>

<?php require_once "footer.php"; ?>