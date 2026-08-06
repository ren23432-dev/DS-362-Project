<?php
require_once "header.php";

$contact_msg = "";

// Check if the form was submitted
if (isset($_POST['action']) && $_POST['action'] == 'contact') {

    // Server-side validation
    if (empty(trim($_POST['name'])) || empty(trim($_POST['message']))) {
        $contact_msg = "<div class='error-msg'>Please enter your name and message.</div>";
    } else {
        $contact_msg = "<div class='success-msg'>Thank you, " . htmlspecialchars($_POST['name']) . "! Your message has been received. The Cybersecurity Club team will contact you soon.</div>";
    }
}
?>

<section class="panel">

    <h2>Contact Cybersecurity Club</h2>

    <p>
        Have a question about our workshops, competitions, or upcoming events?
        Send us a message and our team will get back to you as soon as possible.
    </p>

    <?php echo $contact_msg; ?>

    <form action="contact.php" method="post" onsubmit="return validateContact(this)">

        <input type="hidden" name="action" value="contact">

        <div class="form-group">
            <label for="name">Full Name</label>
            <input
                type="text"
                id="name"
                name="name"
                placeholder="Enter your full name">
        </div>

        <div class="form-group">
            <label for="message">Message</label>
            <textarea
                id="message"
                name="message"
                rows="5"
                placeholder="Write your question or feedback here..."></textarea>
        </div>

        <button type="submit">Send Message</button>

    </form>

</section>

<?php require_once "footer.php"; ?>