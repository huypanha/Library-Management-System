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
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
    <script>
        var offset = 0, limit = 20, searchKey = '';

        function getBorrow(){
            var data = {
                limit: limit,
                offset: offset,
            };

            $.ajax({
                type: "GET",
                url: "actions/get_borrows.php",
                data: data,
                dataType: "JSON",
                success: function (response) {
                    if(response.status == 1){
                        // count result records
                        var reCount = 0;
                        
                        $.each(response.data, function(i, v){
                            const bDate = new Date(v.createdDate), dueDate = new Date(v.due);
                            // create new borrow list row
                            const row = `<tr>
                                <td>`+v.id+`</td>
                                <td>
                                    <div class="row gap10">
                                        <img class="h100 radius-all10" src="../upload/book/`+v.bookCover+`" alt="Book Cover">
                                        <div class="dash-summary-book-title gray">`+v.bookTitle+`</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="`+(v.status == 0 ? "red" : "green")+`">`+(v.status == 0 ? "Borrowing" : "Rreturned")+`</div>
                                </td>
                                <td>`+v.borrower+`</td>
                                <td>`+v.createdBy+`</td>
                                <td>$`+v.amount+`</td>
                                <td>`+bDate.getFullYear()+"/"+(bDate.getMonth()+1)+"/"+bDate.getDate()+`</td>
                                <td>`+dueDate.getFullYear()+"/"+(dueDate.getMonth()+1)+"/"+dueDate.getDate()+`</td>
                                <td>
                                    <a href="#"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="#"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>`;
                            
                            // add new row to the top of the list
                            $("#borrow-list").append(row);
                            reCount = reCount + 1;
                        });

                        // show no result if reCount = 0
                        if(reCount > 0){
                            if(response.hasMore == true){
                                $(".load-more").show();
                            } else {
                                $(".load-more").hide();
                            }
                            $("#no-result").hide();
                        } else {
                            $("no-result").show();
                            $(".load-more").hide();
                        }
                    } else {
                        showBottomRightMessage(response.data);
                    }
                },
                error: function(_, status, msg){
                    showBottomRightMessage('Could not get borrow '+status+': '+msg);
                },
            });
        }

        $(document).ready(function () {
            const now = new Date();
            $("#borrow-dialog").hide();
            $("#no-result").hide();
            var bookIds = [], bookAmounts = [], bookTitles = [], bookCovers = [];
            var studentIds = [], studentNames = [];

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
                // claer old book list
                $("#bookDataList").html("");
                // get all books
                $.ajax({
                    type: "GET",
                    url: "actions/get_books.php",
                    data: {
                        offset: 0,
                        limit: 0,
                    },
                    dataType: "JSON",
                    success: function (response) {
                        if(response.status == 1){
                            $.each(response.data, function(i,v){
                                $("#bookDataList").append("<option value='"+v.title+"'></option>");
                                bookIds.push(v.id);
                                bookAmounts.push(v.price);
                                bookTitles.push(v.title);
                                bookCovers.push(v.cover);
                            });
                        } else {
                            showBottomRightMessage('Could not get book : '+response.data);
                        }
                    },
                    error: function(_, status, msg){
                        showBottomRightMessage('Could not get book '+status+': '+msg);
                    },
                });

                // claer old student list
                $("#studentDataList").html("");
                // get all students
                $.ajax({
                    type: "GET",
                    url: "actions/get_students.php",
                    data: {
                        offset: 0,
                        limit: 0,
                    },
                    dataType: "JSON",
                    success: function (response) {
                        if(response.status == 1){
                            $.each(response.data, function(i,v){
                                $("#studentDataList").append("<option value='"+v.firstName+" "+v.lastName+"'></option>");
                                studentIds.push(v.stuId);
                                studentNames.push(v.firstName+" "+v.lastName);
                            });
                        } else {
                            showBottomRightMessage('Could not get book : '+response.data);
                        }
                    },
                    error: function(_, status, msg){
                        showBottomRightMessage('Could not get book '+status+': '+msg);
                    },
                });

                // set default qty to 1
                $("#qty").val("1");

                // set due date to next 1 day
                $("#due").val(now.getFullYear()+"-"+(now.getMonth()+1+"-"+(now.getDate()+1)));

                // open borrow dialog
                $("#borrow-dialog").dialog("open");
            });

            $("#book").focusout(function(){
                // set borrow amount to book price
                $("#amount").val(bookAmounts[bookTitles.indexOf($("#book").val())]);
            });

            $("#borrow-book-btn").click(function(){
                // validate data
                if(!bookTitles.includes($("#book").val())){
                    $("#bookStatus").text("Please select a book");
                    $("#studentStatus").text("");
                    $("#qtyStatus").text("");
                    $("#amountStatus").text("");
                    $("#famountStatus").text("");
                } else if(!studentNames.includes($("#student").val())){
                    $("#studentStatus").text("Please select a student");
                    $("#bookStatus").text("");
                    $("#qtyStatus").text("");
                    $("#amountStatus").text("");
                    $("#famountStatus").text("");
                } else if($("#qty").val() == ""){
                    $("#qtyStatus").text("Please enter qty");
                    $("#studentStatus").text("");
                    $("#bookStatus").text("");
                    $("#amountStatus").text("");
                    $("#famountStatus").text("");
                } else if($("#amount").val() == ""){
                    $("#amountStatus").text("Please enter amount");
                    $("#studentStatus").text("");
                    $("#bookStatus").text("");
                    $("#qtyStatus").text("");
                    $("#famountStatus").text("");
                } else if($("#famount").val() == ""){
                    $("#famountStatus").text("Please enter fine amount");
                    $("#studentStatus").text("");
                    $("#bookStatus").text("");
                    $("#qtyStatus").text("");
                    $("#amountStatus").text("");
                } else {
                    const due = new Date($("#due").val());
                    $.ajax({
                        type: "POST",
                        url: "actions/create_borrow.php",
                        data: {
                            bookId: bookIds[bookTitles.indexOf($("#book").val())],
                            stuId: studentIds[studentNames.indexOf($("#student").val())],
                            qty: $("#qty").val(),
                            amount: $("#amount").val(),
                            famount: $("#famount").val(),
                            dueDate: due.getFullYear()+"/"+(due.getMonth()+1)+"/"+due.getDate()+' 23:59:59',
                        },
                        dataType: "JSON",
                        success: function (response) {
                            // show success message
                            showBottomRightMessage("Created new borrow #"+response.data.newId, 1);

                            // create new borrow list row
                            const row = `<tr>
                                <td>`+response.data.newId+`</td>
                                <td>
                                    <div class="row gap10">
                                        <img class="h100 radius-all10" src="../upload/book/`+bookCovers[bookTitles.indexOf($("#book").val())]+`" alt="Book Cover">
                                        <div class="dash-summary-book-title gray">`+$("#book").val()+`</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="red">Borrowing</div>
                                </td>
                                <td>`+$("#student").val()+`</td>
                                <td>`+response.data.issuer+`</td>
                                <td>$`+$("#amount").val()+`</td>
                                <td>`+now.getFullYear()+"/"+(now.getMonth()+1)+"/"+now.getDate()+`</td>
                                <td>`+due.getFullYear()+"/"+(due.getMonth()+1)+"/"+due.getDate()+`</td>
                                <td>
                                    <a href="#"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="#"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>`;
                            
                            // add new row to the top of the list
                            $("#borrow-list").prepend(row);

                            // close borrow dialog
                            $("#borrow-dialog").dialog('close');
                        },
                        error: function(_, status, msg){
                            showBottomRightMessage('Could not get book '+status+': '+msg);
                        },
                    });
                }
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
                    <tbody id="borrow-list"></tbody>
                </table>
            </div><br>
            <a class="row content-center primary-color load-more cursor-pointer">
                <i class="fas fa-chevron-down primary-color"></i>&nbsp;&nbsp;Load More
            </a>
            <div id="no-result" class="center w100per">
                <dotlottie-player src="https://lottie.host/368474bf-84db-4d4a-bbd2-65219928b446/3jKzzZOp3j.json" background="transparent" speed="1" style="width: 300px; height: 300px; margin-left: 38%;" loop autoplay></dotlottie-player>
                <p class="gray" >No Result</p>
            </div>
        </div>
        <a id="borrow-btn" class="overlay-bottom-right">
            <i class="fas fa-plus white"></i>
        </a>
    </div>
    <div class="dialog" id="borrow-dialog" title="Issue Book">
        <div class="row gap25 content-top">
            <div class="col w100per">
                <label for="book">Book</label><br>
                <input id="book" class="w100per" autocomplete="on" list="bookDataList">
                <div id="bookStatus" class="input-error-status"></div>
                <datalist id="bookDataList"></datalist>
                <div class="h10"></div>

                <label for="student">Student</label><br>
                <input id="student" class="w100per" autocomplete="on" list="studentDataList">
                <div id="studentStatus" class="input-error-status"></div>
                <datalist id="studentDataList"></datalist>
                <div class="h10"></div>

                <label for="qty">Quantity</label>
                <input class="w100per" type="number" name="qty" id="qty"><br>
                <div id="qtyStatus" class="input-error-status"></div>

                <label for="amount">Borrow Amount ($)</label>
                <input class="w100per" type="number" name="amount" id="amount"><br>
                <div id="amountStatus" class="input-error-status"></div>

                <label for="amount">Fine Amount ($)</label>
                <input class="w100per" type="number" name="famount" id="famount"><br>
                <div id="famountStatus" class="input-error-status"></div>

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
    <!-- message -->
    <div class="message-wrapper">
        <div class="message-bottom-right">Message</div>
    </div>
</body>
</html>

<?php
    if(isset($_GET['searchKey'])){
        echo "<script>
            searchKey = '".$_GET['searchKey']."';
            getBorrow();
        </script>";
    } else {
        echo "<script>getBorrow()</script>";
    }
?>