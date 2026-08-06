<?php
// Include database connection and shared header
require_once "db.php";
require_once "header.php";

// Fetch the next 3 upcoming cybersecurity events
$query = "SELECT * FROM events WHERE event_date >= CURDATE() ORDER BY event_date ASC LIMIT 3";
$rs = mysqli_query($cn, $query);
?>

<section class="panel">

    <h2>Welcome to the Cybersecurity Club</h2>

    <p>
        Welcome to the Cybersecurity Club! We organize workshops, Capture the Flag (CTF)
        competitions, seminars, and hands-on training sessions to help students build
        practical cybersecurity skills and stay informed about the latest security trends.
    </p>

<img src="cybersecurity.jpg?v=1" alt="Cybersecurity Club Event" class="event-image">

</section>

<section class="panel">

    <h2>Upcoming Cybersecurity Events</h2>

    <ul>

    <?php while($row = mysqli_fetch_assoc($rs)): ?>

        <li>

            <strong><?php echo htmlspecialchars($row['title']); ?></strong>

            -

            <?php echo date("M d, Y", strtotime($row['event_date'])); ?>

            (<a href="event.php?id=<?php echo $row['id']; ?>">View Details</a>)

        </li>

    <?php endwhile; ?>

    </ul>

    <p>
        <a href="events.php">View All Events</a>
    </p>

</section>

<?php
require_once "footer.php";
?>