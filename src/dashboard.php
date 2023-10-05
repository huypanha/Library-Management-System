<?php
    // start session to use session
    session_start();

    // check logged in or not
    if(!$_SESSION['login']){
        header("location: ../auth/login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/fontawesomepro.css">
    <link rel="stylesheet" href="../js/fontawesomepro.js">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <div class="wrapper padding-20">
        <div class="row">
            <div class="row w100per">
                <h2 class="greeting">
                    Hello, 
                    <span id="current-username" class="primary-color">Huy Panha!</span>
                </h2>
            </div>
        </div><br>
        <div class="row flex-wrap-300 gap25">
            <a class="dash-box" href="#">
                <div class="row">
                    <div class="col">
                        <div class="dash-box-num" id="dash-total-student">1234</div>
                        <div class="dash-box-title">Total Students</div>
                    </div>
                    <i class="fad fa-users size80 white op50"></i>
                </div>
            </a>
            <a class="dash-box" href="#">
                <div class="row">
                    <div class="col">
                        <div class="dash-box-num" id="dash-total-book">1234</div>
                        <div class="dash-box-title">Total Books</div>
                    </div>
                    <i class="fad fa-books size80 white op50" style="--fa-primary-opacity: 0.4; --fa-secondary-opacity: 1;"></i>
                </div>
            </a>
            <a class="dash-box" href="#">
                <div class="row">
                    <div class="col">
                        <div class="dash-box-num" id="dash-total-borrow">1234</div>
                        <div class="dash-box-title">Borrowed Books</div>
                    </div>
                    <i class="fad fa-book-reader size80 white op50"></i>
                </div>
            </a>
            <a class="dash-box" href="#">
                <div class="row">
                    <div class="col">
                        <div class="dash-box-num" id="dash-total-overdue">1234</div>
                        <div class="dash-box-title">Overdue</div>
                    </div>
                    <i class="fad fa-user-clock size80 white op50" style="--fa-primary-opacity: 0.4; --fa-secondary-opacity: 1;"></i>
                </div>
            </a>
        </div><br>
        <div class="row wrap gap25">
            <div class="dash-summary-box">
                <div class="row space-between w100per">
                    <div class="dash-summary-title">New Borrows</div>
                    <a href="#">Borrow</a>
                </div>
                <div class="row pad-v10 pad-left10 gap10">
                    <div class="row w10per gray">#</div>
                    <div class="row w50per gray">Book</div>
                    <div class="row w20per gray">Borrow Date</div>
                    <div class="row w20per gray">Due Date</div>
                </div>
                <a href="#" class="row overline-1-gray size-15 gap10 pad-v10 hover-gray pad-left10 radius-all10">
                    <div class="row w10per gray">1</div>
                    <div class="row w50per gap10">
                        <img src="../media/book-cover.jpg" alt="Book Cover">
                        <div class="dash-summary-book-title gray">WBD asdf asdf asdf asdf asd fasdasd fasdf asdf asdf asdfasd fasdf asdf asdf asdf  f</div>
                    </div>
                    <div class="row w20per gray">01/10/2023</div>
                    <div class="row w20per gray">02/10/2023</div>
                </a>
                <a href="#" class="row overline-1-gray size-15 gap10 pad-v10 hover-gray pad-left10 radius-all10">
                    <div class="row w10per gray">1</div>
                    <div class="row w50per gap10">
                        <img src="../media/book-cover.jpg" alt="Book Cover">
                        <div class="dash-summary-book-title gray">WBD asdf asdf asdf asdf asd fasdasd fasdf asdf asdf asdfasd fasdf asdf asdf asdf  f</div>
                    </div>
                    <div class="row w20per gray">01/10/2023</div>
                    <div class="row w20per gray">02/10/2023</div>
                </a>
                <a href="#" class="row overline-1-gray size-15 gap10 pad-v10 hover-gray pad-left10 radius-all10">
                    <div class="row w10per gray">1</div>
                    <div class="row w50per gap10">
                        <img src="../media/book-cover.jpg" alt="Book Cover">
                        <div class="dash-summary-book-title gray">WBD asdf asdf asdf asdf asd fasdasd fasdf asdf asdf asdfasd fasdf asdf asdf asdf  f</div>
                    </div>
                    <div class="row w20per gray">01/10/2023</div>
                    <div class="row w20per gray">02/10/2023</div>
                </a>
                <a href="#" class="row overline-1-gray size-15 gap10 pad-v10 hover-gray pad-left10 radius-all10">
                    <div class="row w10per gray">1</div>
                    <div class="row w50per gap10">
                        <img src="../media/book-cover.jpg" alt="Book Cover">
                        <div class="dash-summary-book-title gray">WBD asdf asdf asdf asdf asd fasdasd fasdf asdf asdf asdfasd fasdf asdf asdf asdf  f</div>
                    </div>
                    <div class="row w20per gray">01/10/2023</div>
                    <div class="row w20per gray">02/10/2023</div>
                </a>
                <a href="#" class="row overline-1-gray size-15 gap10 pad-v10 hover-gray pad-left10 radius-all10">
                    <div class="row w10per gray">1</div>
                    <div class="row w50per gap10">
                        <img src="../media/book-cover.jpg" alt="Book Cover">
                        <div class="dash-summary-book-title gray">WBD asdf asdf asdf asdf asd fasdasd fasdf asdf asdf asdfasd fasdf asdf asdf asdf  f</div>
                    </div>
                    <div class="row w20per gray">01/10/2023</div>
                    <div class="row w20per gray">02/10/2023</div>
                </a>
                <div class="row content-right">
                    <a href="#" class="viewall hover-text-white">View All</a>
                </div>
            </div>
            <div class="dash-summary-box">
                <div class="row space-between w100per">
                    <div class="dash-summary-title">New Books</div>
                    <a href="#">Create Book</a>
                </div>
                <div class="row pad-v10 pad-left10 gap10">
                    <div class="row w10per gray">#</div>
                    <div class="row w50per gray">Book</div>
                    <div class="row w20per gray">Author</div>
                    <div class="row w20per gray">Import Date</div>
                </div>
                <a href="#" class="row overline-1-gray size-15 gap10 pad-v10 pad-left10 hover-gray radius-all10">
                    <div class="row w10per gray">1</div>
                    <div class="row w50per gap10">
                        <img src="../media/book-cover.jpg" alt="Book Cover">
                        <div class="dash-summary-book-title gray">WBD asdf asdf asdf asdf asd fasdasd fasdf asdf asdf asdfasd fasdf asdf asdf asdf  f</div>
                    </div>
                    <div class="row w20per gray">Huy Panha</div>
                    <div class="row w20per gray">02/10/2023</div>
                </a>
                <a href="#" class="row overline-1-gray size-15 gap10 pad-v10 pad-left10 hover-gray radius-all10">
                    <div class="row w10per gray">1</div>
                    <div class="row w50per gap10">
                        <img src="../media/book-cover.jpg" alt="Book Cover">
                        <div class="dash-summary-book-title gray">WBD asdf asdf asdf asdf asd fasdasd fasdf asdf asdf asdfasd fasdf asdf asdf asdf  f</div>
                    </div>
                    <div class="row w20per gray">Huy Panha</div>
                    <div class="row w20per gray">02/10/2023</div>
                </a>
                <a href="#" class="row overline-1-gray size-15 gap10 pad-v10 pad-left10 hover-gray radius-all10">
                    <div class="row w10per gray">1</div>
                    <div class="row w50per gap10">
                        <img src="../media/book-cover.jpg" alt="Book Cover">
                        <div class="dash-summary-book-title gray">WBD asdf asdf asdf asdf asd fasdasd fasdf asdf asdf asdfasd fasdf asdf asdf asdf  f</div>
                    </div>
                    <div class="row w20per gray">Huy Panha</div>
                    <div class="row w20per gray">02/10/2023</div>
                </a>
                <a href="#" class="row overline-1-gray size-15 gap10 pad-v10 pad-left10 hover-gray radius-all10">
                    <div class="row w10per gray">1</div>
                    <div class="row w50per gap10">
                        <img src="../media/book-cover.jpg" alt="Book Cover">
                        <div class="dash-summary-book-title gray">WBD asdf asdf asdf asdf asd fasdasd fasdf asdf asdf asdfasd fasdf asdf asdf asdf  f</div>
                    </div>
                    <div class="row w20per gray">Huy Panha</div>
                    <div class="row w20per gray">02/10/2023</div>
                </a>
                <a href="#" class="row overline-1-gray size-15 gap10 pad-v10 pad-left10 hover-gray radius-all10">
                    <div class="row w10per gray">1</div>
                    <div class="row w50per gap10">
                        <img src="../media/book-cover.jpg" alt="Book Cover">
                        <div class="dash-summary-book-title gray">WBD asdf asdf asdf asdf asd fasdasd fasdf asdf asdf asdfasd fasdf asdf asdf asdf  f</div>
                    </div>
                    <div class="row w20per gray">Huy Panha</div>
                    <div class="row w20per gray">02/10/2023</div>
                </a>
                <div class="row content-right">
                    <a href="#" class="viewall hover-text-white">View All</a>
                </div>
            </div>
        </div><br>
        <div class="top-choices">
            <h2>Top Choices</h2>
            <div class="row scroll-x gap25 padding-20">
                <a href="#"><img src="../media/book-cover.jpg" alt="Book Cover"></a>
                <a href="#"><img src="../media/book-cover.jpg" alt="Book Cover"></a>
                <a href="#"><img src="../media/book-cover.jpg" alt="Book Cover"></a>
                <a href="#"><img src="../media/book-cover.jpg" alt="Book Cover"></a>
                <a href="#"><img src="../media/book-cover.jpg" alt="Book Cover"></a>
                <a href="#"><img src="../media/book-cover.jpg" alt="Book Cover"></a>
                <a href="#"><img src="../media/book-cover.jpg" alt="Book Cover"></a>
                <a href="#"><img src="../media/book-cover.jpg" alt="Book Cover"></a>
                <a href="#"><img src="../media/book-cover.jpg" alt="Book Cover"></a>
                <a href="#"><img src="../media/book-cover.jpg" alt="Book Cover"></a>
            </div>
        </div>
    </div>
</body>
</html>