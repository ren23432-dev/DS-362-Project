<?php
require_once "db.php";
require_once "header.php";

// Delete a registration
if (isset($_GET['delete_id'])) {

    $del_id = intval($_GET['delete_id']);
    $del_query = "DELETE FROM registrations WHERE id = $del_id";
    mysqli_query($cn, $del_query);

    echo "<div class='success-msg' style='margin:16px auto; max-width:980px;'>
            Registration deleted successfully!
          </div>";
}

// Retrieve all registrations with the corresponding event name
$query = "SELECT r.id,
                 r.student_name,
                 r.student_id,
                 r.email,
                 e.title
          FROM registrations r
          JOIN events e ON r.event_id = e.id
          ORDER BY r.id DESC";

$rs = mysqli_query($cn, $query);
?>

<section class="panel">

    <h2>Cybersecurity Club Registrations</h2>

    <p>
        The table below displays all students registered for Cybersecurity Club events.
    </p>

    <div class="table-wrap">

        <table>

            <thead>

                <tr>
                    <th>Student Name</th>
                    <th>Student ID</th>
                    <th>University Email</th>
                    <th>Registered Event</th>
                    <th>Actions</th>
                </tr>

            </thead>

            <tbody>

            <?php if(mysqli_num_rows($rs) > 0): ?>

                <?php while($row = mysqli_fetch_assoc($rs)): ?>

                <tr>

                    <td><?php echo htmlspecialchars($row['student_name']); ?></td>

                    <td><?php echo htmlspecialchars($row['student_id']); ?></td>

                    <td><?php echo htmlspecialchars($row['email']); ?></td>

                    <td><?php echo htmlspecialchars($row['title']); ?></td>

                    <td>

                        <a href="edit_registration.php?id=<?php echo $row['id']; ?>">
                            Edit
                        </a>

                        |

                        <a href="registrations.php?delete_id=<?php echo $row['id']; ?>"
                           onclick="return confirm('Are you sure you want to delete this registration?');">

                            Delete

                        </a>

                    </td>

                </tr>

                <?php endwhile; ?>

            <?php else: ?>

                <tr>

                    <td colspan="5" style="text-align:center;">
                        No registrations have been found.
                    </td>

                </tr>

            <?php endif; ?>

            </tbody>

        </table>

    </div>

</section>

<?php require_once "footer.php"; ?>