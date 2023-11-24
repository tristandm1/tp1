<?php

function formattedDate($unixTimestamp) {
    // Set locale to French
    setlocale(LC_TIME, 'fr_FR.UTF-8', 'French_France.1252');

    // Format the date in French
    $formattedDate = strftime("%A %d %B %Y %H:%M:%S", $unixTimestamp);

    return $formattedDate;
}

?>


