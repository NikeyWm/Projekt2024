<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('authCheck.php');
require_once('dbconnection.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="toDoAnzeigen.css">
    <title>ToDo-Liste</title>
</head>

<body>
    <?php include('header.php'); ?>

    <div style="font-family: Arial, sans-serif; line-height: 1.6; margin: 20px;">
        <div class="dropdown">
            <a href="#" class="dropdown-toggle">
                <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="12" r="3" stroke="#1C274C" stroke-width="1.5" />
                    <path
                        d="M3.66122 10.6392C4.13377 10.9361 4.43782 11.4419 4.43782 11.9999C4.43781 12.558 4.13376 13.0638 3.66122 13.3607C3.33966 13.5627 3.13248 13.7242 2.98508 13.9163C2.66217 14.3372 2.51966 14.869 2.5889 15.3949C2.64082 15.7893 2.87379 16.1928 3.33973 16.9999C3.80568 17.8069 4.03865 18.2104 4.35426 18.4526C4.77508 18.7755 5.30694 18.918 5.83284 18.8488C6.07287 18.8172 6.31628 18.7185 6.65196 18.5411C7.14544 18.2803 7.73558 18.2699 8.21895 18.549C8.70227 18.8281 8.98827 19.3443 9.00912 19.902C9.02332 20.2815 9.05958 20.5417 9.15224 20.7654C9.35523 21.2554 9.74458 21.6448 10.2346 21.8478C10.6022 22 11.0681 22 12 22C12.9319 22 13.3978 22 13.7654 21.8478C14.2554 21.6448 14.6448 21.2554 14.8478 20.7654C14.9404 20.5417 14.9767 20.2815 14.9909 19.9021C15.0117 19.3443 15.2977 18.8281 15.7811 18.549C16.2644 18.27 16.8545 18.2804 17.3479 18.5412C17.6837 18.7186 17.9271 18.8173 18.1671 18.8489C18.693 18.9182 19.2249 18.7756 19.6457 18.4527C19.9613 18.2106 20.1943 17.807 20.6603 17C20.8677 16.6407 21.029 16.3614 21.1486 16.1272M20.3387 13.3608C19.8662 13.0639 19.5622 12.5581 19.5621 12.0001C19.5621 11.442 19.8662 10.9361 20.3387 10.6392C20.6603 10.4372 20.8674 10.2757 21.0148 10.0836C21.3377 9.66278 21.4802 9.13092 21.411 8.60502C21.3591 8.2106 21.1261 7.80708 20.6601 7.00005C20.1942 6.19301 19.9612 5.7895 19.6456 5.54732C19.2248 5.22441 18.6929 5.0819 18.167 5.15113C17.927 5.18274 17.6836 5.2814 17.3479 5.45883C16.8544 5.71964 16.2643 5.73004 15.781 5.45096C15.2977 5.1719 15.0117 4.6557 14.9909 4.09803C14.9767 3.71852 14.9404 3.45835 14.8478 3.23463C14.6448 2.74458 14.2554 2.35523 13.7654 2.15224C13.3978 2 12.9319 2 12 2C11.0681 2 10.6022 2 10.2346 2.15224C9.74458 2.35523 9.35523 2.74458 9.15224 3.23463C9.05958 3.45833 9.02332 3.71848 9.00912 4.09794C8.98826 4.65566 8.70225 5.17191 8.21891 5.45096C7.73557 5.73002 7.14548 5.71959 6.65205 5.4588C6.31633 5.28136 6.0729 5.18269 5.83285 5.15108C5.30695 5.08185 4.77509 5.22436 4.35427 5.54727C4.03866 5.78945 3.80569 6.19297 3.33974 7C3.13231 7.35929 2.97105 7.63859 2.85138 7.87273"
                        stroke="#1C274C" stroke-width="1.5" stroke-linecap="round" />
                </svg>
                <h1 style="margin: 0;">ToDo Liste</h1>
            </a>
            <div class="dropdown-menu">
                <a href="toDoHinzufuegen.php">Neues ToDo</a>
                <hr>
                <a href="toDoAnzeigen.php?filter=alle">Alle ToDos</a>
                <a href="toDoAnzeigen.php?filter=offen">Offene ToDos</a>
                <a href="toDoAnzeigen.php?filter=fertig">Erledigte ToDos</a>
            </div>
        </div>

        <div style="display: flex; flex-wrap: wrap; gap: 20px;">
            <?php

            $filter = $_GET['filter'] ?? 'alle';

            if (isset($_SESSION['uid'])) {
                $uid = $_SESSION['uid'];

                switch ($filter) {
                    case 'fertig':
                        $query = "SELECT * FROM aufgaben WHERE uid = ? AND fertig = 1";
                        break;
                    case 'offen':
                        $query = "SELECT * FROM aufgaben WHERE uid = ? AND fertig = 0";
                        break;
                    default:
                        $query = "SELECT * FROM aufgaben WHERE uid = ?";
                }

                $stmt = $pdo->prepare($query);
                $stmt->execute([$uid]);
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $results = false;
                echo "<p>Fehler: Benutzer nicht angemeldet.</p>";
            }

            if ($results) {
                foreach ($results as $row) {
                    ?>
                    <div class="card"
                        style="border: 1px solid #ccc; padding: 20px; border-radius: 10px; width: 300px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                        <h3 class="card__title" style="margin: 0; font-size: 1.5em;">
                            <?php echo htmlspecialchars($row['titel']); ?>
                        </h3>
                        <p class="card__content" style="margin: 10px 0;"><?php echo htmlspecialchars($row['beschreibung']); ?>
                        </p>
                        <div class="card__date" style="color: #888;"><?php echo htmlspecialchars($row['datum']); ?></div>
                        <div class="card__arrow" style="margin-top: 10px;">
                            <?php if ($row['fertig'] == 0) { ?>
                                <a href="toDoCheck.php?tid=<?php echo $row['tid']; ?>&filter=<?php echo urlencode($_GET['filter'] ?? 'alle'); ?>" title="Als erledigt markieren">
                                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="Interface / Checkbox_Unchecked">
                                            <path id="Vector"
                                                d="M4 7.2002V16.8002C4 17.9203 4 18.4801 4.21799 18.9079C4.40973 19.2842 4.71547 19.5905 5.0918 19.7822C5.5192 20 6.07899 20 7.19691 20H16.8031C17.921 20 18.48 20 18.9074 19.7822C19.2837 19.5905 19.5905 19.2842 19.7822 18.9079C20 18.4805 20 17.9215 20 16.8036V7.19691C20 6.07899 20 5.5192 19.7822 5.0918C19.5905 4.71547 19.2837 4.40973 18.9074 4.21799C18.4796 4 17.9203 4 16.8002 4H7.2002C6.08009 4 5.51962 4 5.0918 4.21799C4.71547 4.40973 4.40973 4.71547 4.21799 5.0918C4 5.51962 4 6.08009 4 7.2002Z"
                                                stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </g>
                                    </svg>
                                </a>
                            <?php } else { ?>
                                <a href="toDoUncheck.php?tid=<?php echo $row['tid']; ?>&filter=<?php echo urlencode($_GET['filter'] ?? 'alle'); ?>" title="Als unerledigt markieren">
                                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="Interface / Checkbox_Check">
                                            <path id="Vector"
                                                d="M8 12L11 15L16 9M4 16.8002V7.2002C4 6.08009 4 5.51962 4.21799 5.0918C4.40973 4.71547 4.71547 4.40973 5.0918 4.21799C5.51962 4 6.08009 4 7.2002 4H16.8002C17.9203 4 18.4796 4 18.9074 4.21799C19.2837 4.40973 19.5905 4.71547 19.7822 5.0918C20 5.5192 20 6.07899 20 7.19691V16.8036C20 17.9215 20 18.4805 19.7822 18.9079C19.5905 19.2842 19.2837 19.5905 18.9074 19.7822C18.48 20 17.921 20 16.8031 20H7.19691C6.07899 20 5.5192 20 5.0918 19.7822C4.71547 19.5905 4.40973 19.2842 4.21799 18.9079C4 18.4801 4 17.9203 4 16.8002Z"
                                                stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </g>
                                    </svg>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No ToDo items found.</p>";
            }
            ?>
        </div>
    </div>

    <?php include('footer.php'); ?>
</body>

</html>