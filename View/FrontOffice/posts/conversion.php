<?php
function time_elapsed_string($datetime, $full = false) {
    // Set your local time zone
    $timezone = new DateTimeZone('Africa/Tunis'); // Replace with your actual time zone

    $now = new DateTime('now', $timezone);
    $ago = new DateTime($datetime, $timezone);

    $diff = $now->diff($ago);

    $string = array(
        'y' => 'année',
        'm' => 'mois',
        'w' => 'semaine',
        'd' => 'jour',
        'h' => 'heure',
        'i' => 'minute',
        's' => 'seconde',
    );

    // Calculate weeks and adjust days accordingly
    $days = $diff->days;
    $weeks = floor($days / 7);
    $days -= $weeks * 7;

    foreach ($string as $k => &$v) {
        if ($k == 'w') {
            if ($weeks) {
                $v = $weeks . ' ' . $v . ($weeks > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        } elseif ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) {
        $string = array_slice($string, 0, 1);
    }

    return $string ? implode(', ', $string) . ' ' : 'A l instant';
}
?>
