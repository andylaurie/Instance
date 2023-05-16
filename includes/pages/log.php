<?php
    include('log-controller.php');
?>

<div class="objectContainer">
    <h3>Log</h3>
    <div class="sectionContainer">
        <div class="contentContainer">

            <div class="och">
                <h5 class="time">Time and Date</h5>
                <h5 class="user">User</h5>
                <h5 class="action">Action</h5>
            </div>
            <?php
                echo("<div class='hPad'></div>");
                foreach($result as $row) {
                    echo "<div class='ocb'>
                            <a href='#' class='noPoint'>
                                <h6 class='time'>" . date('d-m-Y - g:ia',strtotime($row['logTime'])) . "</h6>
                                <h6 class='user'>" . $row['user'] . "</h6>
                                <h6 class='action'>" . $row['action'] . "</h6>
                            </a>
                        </div>";
                }
            ?>
        </div>
        <div class="osl">
            <?php
                if($rowQty > 45) {
                    include('includes/handlers/paginate-link-handler.php');
                }
            ?>
        </div>
    </div>
</div>
