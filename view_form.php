<!DOCTYPE HTML>
<html lang="en">

<head>
    <link rel="stylesheet" href="feedbackpage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submitted Form</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .page {
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: #f0f0f0;
        }

        .header .logo,
        .header .header-right {
            display: flex;
            align-items: center;
        }

        .header a {
            margin-right: 15px;
            text-decoration: none;
            color: black;
        }

        .profile-icon {
            margin-left: 15px;
        }

        .element {
            margin-left: 50px;
            padding: 0;
        }

        .title {
            text-align: center;
            margin-top: 30px;
        }

        form {
            max-width: 800px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .question {
            width: 100%;
            margin-bottom: 20px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }

        label,
        p {
            margin-top: 0;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="radio"],
        input[type="checkbox"] {
            margin-bottom: 10px;
        }

        input[type="radio"],
        input[type="checkbox"] {
            margin-right: 5px;
        }

        input[type="submit"] {
            align-self: flex-end;
            margin-top: 10px;
            margin-left: auto;
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 4px;
        }

        .button2 {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 4px;
            align-self: flex-end;
            margin-top: 10px; /* Add some margin for spacing */
            margin-left: auto; /* Align to the right */
        }

        .volunteer-form {
            max-width: 1000px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            margin-top: 20px; /* Add margin at the top */
        }
        .short-nav {
            font-style: Verdana(sans serif);
        }
    </style>
</head>

<body>

    <div class="header">
        <a href="#default" class="logo">
            <img id="first-logo" src="utm-logo.png">
            <img id="second-logo" src="vol-club.png">
        </a>
        <div class="header-right">
            <a href="welcome.php">About Us</a>
            <a href="index1.php">Get Involved</a>
            <a href="main_page.php">Donate</a>
            <a href="feedback.php">Feedback</a>
            <a href="studentprofile.php"><i class="fas fa-user profile-icon"></i></a>
        </div>
    </div>

    <div style="font-family: Arial; background-color: #f0f0f0; padding: 10px;">
    <ul style="list-style-type: none; padding: 0; margin: 0;">
        <li style="display: inline-block; margin-right: 10px;">
            <a href="feedback.php" style="text-decoration: none; color: #333; padding: 5px 10px; background-color: #ddd; border-radius: 5px;">Feedback</a>
        </li>
        <li style="display: inline-block; margin-right: 10px; font-weight: bold; color: #555;">&gt;&gt;</li>
        <li style="display: inline-block;">
            <a href="view_form.php" style="text-decoration: none; color: #333; padding: 5px 10px; background-color: #ddd; border-radius: 5px;">Feedback Form</a>
        </li>
    </ul>
</div>



    <div class="element">
        <div class="page">
            <div class="title">
                <img id="title" src="title.png" alt="Title Image">
                <h1>Volunteer Feedback Form</h1>
            </div>

        <!-- Add a dropdown for event selection -->
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="get" class="volunteer-form">
    <label for="event_id">Select Event:</label>
    <select name="event_id" id="event_id" required>
        <?php
        // Assuming you have a database connection established
        $conn = mysqli_connect("localhost", "DevGenius", "UTMUnity67", "devgenius");

        // Fetch events for the dropdown from events_2 table
        $eventsQuery = "SELECT id, title FROM events_2";
        $eventsResult = mysqli_query($conn, $eventsQuery);

        if (!$eventsResult) {
            die("Error fetching events: " . mysqli_error($conn));
        }

        // Check if any events are retrieved
        if (mysqli_num_rows($eventsResult) > 0) {
            while ($eventRow = mysqli_fetch_assoc($eventsResult)) {
                $eventId = $eventRow['id'];
                $eventName = $eventRow['title'];
                echo "<option value='$eventId'>$eventName</option>";
            }
        } else {
            echo "<option value='' disabled selected>No events available</option>";
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
    </select>
    <input type="submit" class="button2" value="Select Event">
</form>

<?php
// Check if an event is selected
if (isset($_GET['event_id'])) {
    $selectedEventId = $_GET['event_id'];

    // Assuming you have a database connection established
    $conn = mysqli_connect("localhost", "DevGenius", "UTMUnity67", "devgenius");

    // Check if there are forms available for the selected event
    $formsQuery = "SELECT * FROM forms WHERE event_id = $selectedEventId";
    $formsResult = mysqli_query($conn, $formsQuery);

    if ($formsResult && mysqli_num_rows($formsResult) > 0) {
        // Forms are available, proceed with displaying the form questions
        $eventQuery = "SELECT * FROM events_2 WHERE id = $selectedEventId";
        $eventResult = mysqli_query($conn, $eventQuery);

        if ($eventResult && mysqli_num_rows($eventResult) > 0) {
            $eventRow = mysqli_fetch_assoc($eventResult);
            $eventName = $eventRow['title'];
            echo "<h2>Welcome to the Feedback Form for $eventName!</h2>";

            // Display the form questions dynamically
            $questionsQuery = "SELECT * FROM questions WHERE event_id = $selectedEventId";
            $questionsResult = mysqli_query($conn, $questionsQuery);

            echo "<form action='submit_answer.php' method='post' class='volunteer-form'>";
            echo "<input type='hidden' name='event_id' value='$selectedEventId'>"; // Pass the event_id in the form

            while ($questionRow = mysqli_fetch_assoc($questionsResult)) {
                // Display your questions and input fields here
                // Example:
                echo "<div class='question'>";
                echo "<label>{$questionRow['question_text']}</label>";

                // Check the answer format
                if ($questionRow['answer_format'] === 'radio') {
                    // If it's a radio button, fetch the options and create radio buttons
                    $options = explode(',', $questionRow['options']);

                    foreach ($options as $option) {
                        echo "<input type='radio' name='answer_$questionRow[id]' value='$option'>";
                        echo "<label>$option</label>";
                    }
                } else {
                    // If it's not a radio button, assume it's a text input
                    echo "<input type='text' name='answer_$questionRow[id]' required>";
                }

                echo "</div>";
            }

            echo "<input type='submit' class='button2' value='Submit Answers'>";
            echo "</form>";
        } else {
            echo "<p>Event not found.</p>";
        }
    } else {
        // No forms available for the selected event
        echo "<p>No form available for the selected event.</p>";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
        </div>
    </div>
</body>
</html>
