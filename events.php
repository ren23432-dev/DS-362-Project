<?php
require_once "db.php";
require_once "header.php";

// Get all cybersecurity events from the database
$query = "SELECT * FROM events ORDER BY event_date ASC";
$rs = mysqli_query($cn, $query);
?>

<section class="panel">

    <h2>Cybersecurity Club Events</h2>

    <table>

        <thead>

            <tr>
                <th>Event</th>
                <th>Date</th>
                <th>Location</th>
                <th>View Details</th>
            </tr>

        </thead>

        <tbody>

        <?php while($row = mysqli_fetch_assoc($rs)): ?>

            <tr>

                <td><?php echo htmlspecialchars($row['title']); ?></td>

                <td>
                    <?php echo date("F d, Y", strtotime($row['event_date'])); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($row['location']); ?>
                </td>

                <td>
                    <a href="event.php?id=<?php echo $row['id']; ?>">
                        View Event
                    </a>
                </td>

            </tr>

        <?php endwhile; ?>

        </tbody>

    </table>

</section>

<?php require_once "footer.php"; ?>