<?php
    require '../config/db.php';

    // start session to use session
    session_start();

    // check logged in or not
    if(!$_SESSION['loggedIn']){
        header("location: ../auth/login.php");
    }

    $user = json_decode($_SESSION['user']);

    try {
        $db = DB::connect();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/fontawesomepro.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../js/fontawesomepro.js" type="text/javascript"></script>
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
</head>
<body>
    <div class="wrapper padding-20">
        <div class="row">
            <div class="row w100per">
                <h2 class="greeting">
                    Hello, 
                    <span id="current-username" class="primary-color"><?php echo $user->userName; ?>!</span>
                </h2>
            </div>
        </div><br>
        <div class="row flex-wrap-300 gap25">
            <a class="dash-box cursor-pointer" onclick="window.location.href='students.php'">
                <div class="row">
                    <div class="col">
                        <div class="dash-box-num" id="dash-total-student"><?php 
                            try {
                                $sql = "SELECT COUNT(*) FROM student WHERE status = 1";
                                $stmt = $db->prepare($sql);
                                $stmt->execute();
                                echo $stmt->fetchColumn();
                            } catch (PDOException $e) {
                                echo "0";
                            }
                        ?></div>
                        <div class="dash-box-title">Total Students</div>
                    </div>
                    <i class="fad fa-users size80 white op50"></i>
                </div>
            </a>
            <a class="dash-box cursor-pointer" onclick="window.location.href='books.php'">
                <div class="row">
                    <div class="col">
                        <div class="dash-box-num" id="dash-total-book"><?php 
                            try {
                                $sql = "SELECT COUNT(*) FROM books WHERE status = 1";
                                $stmt = $db->prepare($sql);
                                $stmt->execute();
                                echo $stmt->fetchColumn();
                            } catch (PDOException $e) {
                                echo "0";
                            }
                        ?></div>
                        <div class="dash-box-title">Total Books</div>
                    </div>
                    <i class="fad fa-books size80 white op50" style="--fa-primary-opacity: 0.4; --fa-secondary-opacity: 1;"></i>
                </div>
            </a>
            <a class="dash-box cursor-pointer" onclick="window.location.href='borrows.php'">
                <div class="row">
                    <div class="col">
                        <div class="dash-box-num" id="dash-total-borrow"><?php 
                            try {
                                $sql = "SELECT COUNT(*) FROM borrow WHERE status = 1";
                                $stmt = $db->prepare($sql);
                                $stmt->execute();
                                echo $stmt->fetchColumn();
                            } catch (PDOException $e) {
                                echo "0";
                            }
                        ?></div>
                        <div class="dash-box-title">Borrowed Books</div>
                    </div>
                    <i class="fad fa-book-reader size80 white op50"></i>
                </div>
            </a>
            <a class="dash-box cursor-pointer" onclick="window.location.href='borrows.php'">
                <div class="row">
                    <div class="col">
                        <div class="dash-box-num" id="dash-total-overdue"><?php 
                            try {
                                $sql = "SELECT COUNT(*) FROM borrow WHERE status = 1 AND due_date < NOW() AND returned = 0";
                                $stmt = $db->prepare($sql);
                                $stmt->execute();
                                echo $stmt->fetchColumn();
                            } catch (PDOException $e) {
                                echo "0";
                            }
                        ?></div>
                        <div class="dash-box-title">Overdue</div>
                    </div>
                    <i class="fad fa-user-clock size80 white op50" style="--fa-primary-opacity: 0.4; --fa-secondary-opacity: 1;"></i>
                </div>
            </a>
        </div><br>
        <div class="row wrap gap25 content-top">
            <div class="dash-summary-box">
                <div class="row space-between w100per">
                    <div class="dash-summary-title">New Borrows</div>
                </div>
                <div class="row pad-v10 pad-left10 gap10">
                    <div class="row w10per gray">#</div>
                    <div class="row w50per gray">Book</div>
                    <div class="row w20per gray">Borrow Date</div>
                    <div class="row w20per gray">Due Date</div>
                </div>
                <?php
                    try {
                        $sql = "SELECT br.*, b.title bookTitle, b.cover bookCover FROM borrow br LEFT JOIN books b ON br.book_id=b.id WHERE br.status = 1 ORDER BY created_date DESC LIMIT 5";
                        $stmt = $db->prepare($sql);
                        $stmt->execute();
                        $rows = $stmt->fetchAll();
                        
                        if(count($rows) > 0) {
                            foreach($rows as $row) {
                                echo "<a href='borrows.php?searchKey=".$row['id']."' class='row overline-1-gray size-15 gap10 pad-v10 hover-gray pad-left10 radius-all10'>
                                    <div class='row w10per gray'>".$row['id']."</div>
                                    <div class='row w50per gap10'>
                                        <img src='../upload/book/".$row['bookCover']."' alt='Book Cover'>
                                        <div class='dash-summary-book-title gray'>".$row['bookTitle']."</div>
                                    </div>
                                    <div class='row w20per gray'>".date_format(date_create($row['created_date']), 'd/m/Y')."</div>
                                    <div class='row w20per gray'>".date_format(date_create($row['due_date']), 'd/m/Y')."</div>
                                </a>";
                            }
                        } else {
                            echo "<div id='no-result' class='center w100per'>
                                <dotlottie-player src='https://lottie.host/368474bf-84db-4d4a-bbd2-65219928b446/3jKzzZOp3j.json' background='transparent' speed='1' style='width: 300px; height: 300px; margin-left: 38%;' loop autoplay></dotlottie-player>
                                <p class='gray'>No Data</p>
                            </div>";
                        }
                    } catch(PDOException $e) {
                        echo "<div id='no-result' class='center w100per'>
                            <dotlottie-player src='https://lottie.host/368474bf-84db-4d4a-bbd2-65219928b446/3jKzzZOp3j.json' background='transparent' speed='1' style='width: 300px; height: 300px; margin-left: 38%;' loop autoplay></dotlottie-player>
                            <p class='gray'>".$e->getMessage()."</p>
                        </div>";
                    }
                ?>
                <div class="row content-right">
                    <a href="borrows.php" class="viewall hover-text-white">View All</a>
                </div>
            </div>
            <div class="dash-summary-box">
                <div class="row space-between w100per">
                    <div class="dash-summary-title">New Arrived Books</div>
                </div>
                <div class="row pad-v10 pad-left10 gap10">
                    <div class="row w10per gray">#</div>
                    <div class="row w50per gray">Book</div>
                    <div class="row w20per gray">Author</div>
                    <div class="row w20per gray">Import Date</div>
                </div>
                <?php
                    try {
                        $bsql = "SELECT * FROM books WHERE status = 1 ORDER BY created_date DESC LIMIT 5";
                        $bstmt = $db->prepare($bsql);
                        $bstmt->execute();
                        $brows = $bstmt->fetchAll();
                        
                        if(count($brows) > 0) {
                            foreach($brows as $brow) {
                                echo "<a href='books.php?searchKey=".$brow['id']."' class='row overline-1-gray size-15 gap10 pad-v10 pad-left10 hover-gray radius-all10'>
                                    <div class='row w10per gray'>".$brow['id']."</div>
                                    <div class='row w50per gap10'>
                                        <img src='../upload/book/".$brow['cover']."' alt='Book Cover'>
                                        <div class='dash-summary-book-title gray'>".$brow['title']."</div>
                                    </div>
                                    <div class='row w20per gray'>".$brow['author']."</div>
                                    <div class='row w20per gray'>".date_format(date_create($brow['created_date']), 'd/m/Y')."</div>
                                </a>";
                            }
                        } else {
                            echo "<div id='no-result' class='center w100per'>
                                <dotlottie-player src='https://lottie.host/368474bf-84db-4d4a-bbd2-65219928b446/3jKzzZOp3j.json' background='transparent' speed='1' style='width: 300px; height: 300px; margin-left: 38%;' loop autoplay></dotlottie-player>
                                <p class='gray'>No Data</p>
                            </div>";
                        }
                    } catch(PDOException $e) {
                        echo "<div id='no-result' class='center w100per'>
                            <dotlottie-player src='https://lottie.host/368474bf-84db-4d4a-bbd2-65219928b446/3jKzzZOp3j.json' background='transparent' speed='1' style='width: 300px; height: 300px; margin-left: 38%;' loop autoplay></dotlottie-player>
                            <p class='gray'>".$e->getMessage()."</p>
                        </div>";
                    }
                ?>
                <div class="row content-right">
                    <a href="books.php" class="viewall hover-text-white">View All</a>
                </div>
            </div>
        </div><br>
        <div class="top-choices">
            <h2>Top Choices</h2>
            <div class="row scroll-x gap25 padding-20">
                <?php
                    try {
                        $tsql = "SELECT * FROM books WHERE status = 1 ORDER BY borrow_count DESC LIMIT 10";
                        $tstmt = $db->prepare($tsql);
                        $tstmt->execute();
                        $trows = $tstmt->fetchAll();
                        
                        if(count($trows) > 0) {
                            foreach($trows as $trow) {
                                echo "<a href='books.php?searchKey=".$trow['id']."'><img src='../upload/book/".$trow['cover']."' alt='Book Cover'></a>";
                            }
                        } else {
                            echo "<div id='no-result' class='center w100per'>
                                <dotlottie-player src='https://lottie.host/368474bf-84db-4d4a-bbd2-65219928b446/3jKzzZOp3j.json' background='transparent' speed='1' style='width: 300px; height: 300px; margin-left: 38%;' loop autoplay></dotlottie-player>
                                <p class='gray'>No Data</p>
                            </div>";
                        }
                    } catch(PDOException $e) {
                        echo "<div id='no-result' class='center w100per'>
                            <dotlottie-player src='https://lottie.host/368474bf-84db-4d4a-bbd2-65219928b446/3jKzzZOp3j.json' background='transparent' speed='1' style='width: 300px; height: 300px; margin-left: 38%;' loop autoplay></dotlottie-player>
                            <p class='gray'>".$e->getMessage()."</p>
                        </div>";
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>