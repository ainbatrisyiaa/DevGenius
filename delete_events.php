<?php
require 'database_connection.php';

$event_id = $_POST['event_id'];

$delete_query = "DELETE FROM calendar_event_master WHERE event_id = $event_id";

if (mysqli_query($con, $delete_query)) {
    $data = array(
        'status' => true,
        'msg' => 'Event deleted successfully!'
    );
} else {
    $data = array(
        'status' => false,
        'msg' => 'Sorry, Event not deleted.'
    );
}

echo json_encode($data);
?>
