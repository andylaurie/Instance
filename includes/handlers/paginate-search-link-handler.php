<?php

    echo("<div class='osl'>");

    $range = 3;

    if ($currentPage > 1) {
        echo "<a href='?search=$searchTerm&page=1'>First</a><div></div>";
        $prevPage = $currentPage - 1;
        echo "<a href='?search=$searchTerm&page=$prevPage'>Prev</a><div></div>";
    } else {
        echo "<a href='#' class='disabled'>First</a><div></div>";
        echo "<a href='#' class='disabled'>Prev</a><div></div>";
    }

    for ($x = ($currentPage - $range); $x < (($currentPage + $range) + 1); $x++) {
        if (($x > 0) && ($x <= $totalPages)) {
            if ($x == $currentPage) {
                echo "<div></div><a href='#' class='disabled'>$x</a>";
            } else {
                echo "<div></div><a href='?search=$searchTerm&page=$x'>$x</a>";
            }
        }
    }

    if ($currentPage != $totalPages) {
        $nextPage = $currentPage + 1;
        echo "<div></div><a href='?search=$searchTerm&page=$nextPage'>Next</a>";
        echo "<div></div><a href='?search=$searchTerm&page=$totalPages'>Last</a>";
    } else {
        echo "<a href='#' class='disabled'>Next</a><div></div>";
        echo "<a href='#' class='disabled'>Last</a><div></div>";
    }

    echo("</div>");
