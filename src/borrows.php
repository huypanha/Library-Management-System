<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/fontawesomepro.css">
    <link rel="stylesheet" href="../js/fontawesomepro.js">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../js/script.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $(document).ready(function () {
            const now = new Date();
            $("#borrow-dialog").hide();

            $("#borrow-dialog").dialog({
                autoOpen: false,
                modal: true,
                width: 500,
                button: [
                    {
                        text: "Close",
                        click: function() {
                            $( this ).dialog( "close" );
                        }
                    }
                ],
                classes: {
                    "ui-dialog": "highlight",
                }
            });

            $("#borrow-btn").click(function(){
                $("#borrow-dialog").dialog("open");
            });
        });
    </script>
</head>
<body>
    <div class="wrapper padding-20">
        <div class="wrapper padding-20 back-white radius-all20 shadow-gray">
            <div class="row space-between">
                <div class="stu-list-title"></div>
                <div class="list-options row gap10">
                    <a href="#"><i class="fas fa-file-export"></i>&nbsp;&nbsp;Export</a>
                    <a href="#"><i class="fas fa-filter"></i>&nbsp;&nbsp;Filter</a>
                </div>
            </div>
            <div class="row scroll-x mt10">
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Book</th>
                        <th>Status</th>
                        <th>Borrowed By</th>
                        <th>Issue By</th>
                        <th>Borrow Amount</th>
                        <th>Borrow Date</th>
                        <th>Due Date</th>
                        <th>Actions</th>
                    </tr>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>
                                <div class="row gap10">
                                    <img class="h100 radius-all10" src="../media/book-cover.jpg" alt="Book Cover">
                                    <div class="dash-summary-book-title gray">កាដូជីវិត</div>
                                </div>
                            </td>
                            <td>
                                <div class="red">Borrowing</div>
                            </td>
                            <td>Huy Samrech</td>
                            <td>Huy Panha</td>
                            <td>$100</td>
                            <td>03/10/2023</td>
                            <td>10/10/2023</td>
                            <td>
                                <a href="#"><i class="fas fa-pencil-alt"></i></a>
                                <a href="#"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>
                                <div class="row gap10">
                                    <img class="h100 radius-all10" src="../media/book-cover.jpg" alt="Book Cover">
                                    <div class="dash-summary-book-title gray">កាដូជីវិត 2</div>
                                </div>
                            </td>
                            <td>
                                <div class="green">Returned</div>
                            </td>
                            <td>Huy Samrech</td>
                            <td>Huy Panha</td>
                            <td>$100</td>
                            <td>03/10/2023</td>
                            <td>10/10/2023</td>
                            <td>
                                <a href="#"><i class="fas fa-pencil-alt"></i></a>
                                <a href="#"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>
                                <div class="row gap10">
                                    <img class="h100 radius-all10" src="../media/book-cover.jpg" alt="Book Cover">
                                    <div class="dash-summary-book-title gray">កាដូជីវិត 2</div>
                                </div>
                            </td>
                            <td>
                                <div class="green">Returned</div>
                            </td>
                            <td>Huy Samrech</td>
                            <td>Huy Panha</td>
                            <td>$100</td>
                            <td>03/10/2023</td>
                            <td>10/10/2023</td>
                            <td>
                                <a href="#"><i class="fas fa-pencil-alt"></i></a>
                                <a href="#"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>
                                <div class="row gap10">
                                    <img class="h100 radius-all10" src="../media/book-cover.jpg" alt="Book Cover">
                                    <div class="dash-summary-book-title gray">កាដូជីវិត 2</div>
                                </div>
                            </td>
                            <td>
                                <div class="green">Returned</div>
                            </td>
                            <td>Huy Samrech</td>
                            <td>Huy Panha</td>
                            <td>$100</td>
                            <td>03/10/2023</td>
                            <td>10/10/2023</td>
                            <td>
                                <a href="#"><i class="fas fa-pencil-alt"></i></a>
                                <a href="#"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>
                                <div class="row gap10">
                                    <img class="h100 radius-all10" src="../media/book-cover.jpg" alt="Book Cover">
                                    <div class="dash-summary-book-title gray">កាដូជីវិត 2</div>
                                </div>
                            </td>
                            <td>
                                <div class="green">Returned</div>
                            </td>
                            <td>Huy Samrech</td>
                            <td>Huy Panha</td>
                            <td>$100</td>
                            <td>03/10/2023</td>
                            <td>10/10/2023</td>
                            <td>
                                <a href="#"><i class="fas fa-pencil-alt"></i></a>
                                <a href="#"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div><br>
            <a href="#" class="row content-center primary-color load-more">
                <i class="fas fa-chevron-down primary-color"></i>&nbsp;&nbsp;Load More
            </a>
        </div>
        <a id="borrow-btn" class="overlay-bottom-right">
            <i class="fas fa-plus white"></i>
        </a>
    </div>
    <div class="dialog" id="borrow-dialog" title="Issue Book">
        <div class="row gap25 content-top">
            <div class="col w100per">
                <label for="book">Book</label>
                <div class="filter-box w100per">
                    <select name="cate" id="book">
                        <option value="Anthologies">Anthologies</option>
                    </select>
                    <i class="fas fa-caret-down"></i>
                </div>
                <div class="h10"></div>
                <label for="student">Student</label>
                <div class="filter-box w100per">
                    <select name="cate" id="student">
                        <option value="Anthologies">Anthologies</option>
                    </select>
                    <i class="fas fa-caret-down"></i>
                </div>
                <div class="h10"></div>
                <label for="qty">Quantity</label>
                <input class="w100per" type="number" name="qty" id="qty"><br>
                <div id="qtyStatus" class="input-error-status"></div>
                <label for="amount">Borrow Amount</label>
                <input class="w100per" type="number" name="amount" id="amount"><br>
                <div id="amountStatus" class="input-error-status"></div>
                <label for="due">Due Date</label>
                <input class="w100per" type="date" name="due" id="due"><br>
                <div id="dueStatus" class="input-error-status"></div>
            </div><br>
        </div> <br>
        <div class="row content-right gap10">
            <a class="btn cursor-pointer" onclick="$('#borrow-dialog').dialog('close');">Close</a>
            <a class="primary-btn cursor-pointer" id="borrow-book-btn">Borrow</a>
        </div>
    </div>
</body>
</html>