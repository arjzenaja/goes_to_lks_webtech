<?php
date_default_timezone_set('Asia/Jakarta');

if (isset($_GET['month']) && isset($_GET['year'])) {
    $currentMonth = (int)$_GET['month'];
    $currentYear = (int)$_GET['year'];
}   else {
    $currentMonth = date('n');
    $currentYear = date('Y');
}

$prevMonth = $currentMonth - 1;
$nextMonth = $currentMonth + 1;
$prevYear = $currentYear;
$nextYear = $currentYear;

if ($prevMonth < 1) {
    $prevMonth = 12;
    $prevYear--;
}

if ($nextMonth > 12) {
    $nextMonth = 1;
    $nextYear++;
}

$firstDay = strtotime("$currentYear-$currentMonth-01");
$daysInMonth = date('t', $firstDay);
$firstDayofWeek = date('w', $firstDay);

$today = date('j');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="month-nav">
        <a href="?month=<?php echo $prevMonth; ?>&year=<?php echo $prevYear; ?>">
            <button>&lt;</button>
        </a>
        <div class=bulantahun>
        <span class="bulan"><?php echo strtoupper (date('F', $firstDay)); ?></span>
        <span class="tahun"><?php echo date('Y', $firstDay); ?></span>
        </div>
        <a href="?month=<?php echo $nextMonth; ?>&year=<?php echo $nextYear; ?>">
            <button>&gt;</button>
        </a>
    </div>

    <div class="calendar">
        <?php
        // buat label hari
        $daysofWeek = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];
        foreach ($daysofWeek as $day) {
            echo "<div class='day'><strong>$day</strong></div>";
        }

        for ($i = 0; $i < $firstDayofWeek; $i++) {
            echo "<div class='day'></div>";
        }

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $class = ($day == $today && $currentMonth == date('n') && $currentYear == date('Y') ? 'day today' : 'day');
            echo "<div class='$class'>$day</div>";
        }
        ?>
    </div>
</body>
</html>