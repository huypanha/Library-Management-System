<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/fontawesomepro.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="../js/fontawesomepro.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../js/script.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
    <script>
        var offset = 0, limit = 20, searchKey = '', bTitle = '';
        var bookIds = [], bookAmounts = [], bookTitles = [], bookCovers = [];
        var studentIds = [], studentNames = [];

        function getBorrow(){
            var data = {
                limit: limit,
                offset: offset,
            };

            // filter borrow date
            if($('#filter-date-opt').val() == 'custom' && $('#startDate').val() < $("#endDate").val()){
                // convert to date format
                const sDate = new Date($('#startDate').val());
                const eDate = new Date($('#endDate').val());

                // convert to date format for PHP
                data.startDate = sDate.getFullYear()+'/'+(sDate.getMonth()+1)+'/'+sDate.getDate();
                data.endDate = eDate.getFullYear()+'/'+(eDate.getMonth()+1)+'/'+eDate.getDate();
            }

            // filter due date
            if($('#filter-ddate-opt').val() == 'custom' && $('#startDDate').val() < $("#endDDate").val()){
                // convert to date format
                const sDate = new Date($('#startDDate').val());
                const eDate = new Date($('#endDDate').val());

                // convert to date format for PHP
                data.startDDate = sDate.getFullYear()+'/'+(sDate.getMonth()+1)+'/'+sDate.getDate();
                data.endDDate = eDate.getFullYear()+'/'+(eDate.getMonth()+1)+'/'+eDate.getDate();
            }

            // filter by status
            if($("#filter-status").val() != "all"){
                data.status = $("#filter-status").val() == "b" ? 0 : 1;
            }

            // if searching
            if(searchKey != ''){
                data.searchKey = searchKey;
            }

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
                                <td>`+bDate.getDate()+"/"+(bDate.getMonth()+1)+"/"+bDate.getFullYear()+`</td>
                                <td>`+dueDate.getDate()+"/"+(dueDate.getMonth()+1)+"/"+dueDate.getFullYear()+`</td>
                                <td>
                                    <a class="cursor-pointer" onclick="edit('`+v.id+`', '`+v.bookTitle+`', '`+v.borrower+`', '`+v.qty+`', '`+v.amount+`', '`+v.fineAmount+`', '`+dueDate+`','`+v.status+`')"><i class="fas fa-pencil-alt"></i></a>
                                    `+(v.roleTitle == "Admin" ? `<a class="cursor-pointer" onclick="deleteBorrow('`+v.id+`')"><i class="fas fa-trash-alt"></i></a>` : ``)+`
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
                            $("#no-result").show();
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

        function getAllBooks(listId) {
            // claer old book list
            $("#bookDataList").html("");

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
                            $(listId).append("<option value='"+v.title+"'></option>");
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
        }

        function getAllStudents(listId){
            // claer old student list
            $("#studentDataList").html("");

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
                            $(listId).append("<option value='"+v.firstName+" "+v.lastName+"'></option>");
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
        }

        function edit(id, book, student, qty, amount, fineAmount, due, isReturned) {
            // get all books
            getAllBooks("#ubookDataList");

            // get all students
            getAllStudents("#ustudentDataList");
            
            // convert date
            const d = new Date(due);
            var day = ("0" + d.getDate()).slice(-2);
            var month = ("0" + (d.getMonth() + 1)).slice(-2);

            // show existing data on update input
            $("#id").val(id);
            $("#ubook").val(book);
            $("#ustudent").val(student);
            $("#uqty").val(qty);
            $("#uamount").val(amount);
            $("#ufamount").val(fineAmount);
            $("#udue").val(d.getFullYear()+"-"+month+"-"+day);
            $("#isReturned").prop("checked", isReturned == '0' ? false : true);

            $("#update-dialog").dialog('open');
        }

        function validateData(){
            if(!bookTitles.includes($("#book").val())){
                $("#bookStatus").text("Please select a book");
                $("#studentStatus").text("");
                $("#qtyStatus").text("");
                $("#amountStatus").text("");
                $("#famountStatus").text("");
                return false;
            } else if(!studentNames.includes($("#student").val())){
                $("#studentStatus").text("Please select a student");
                $("#bookStatus").text("");
                $("#qtyStatus").text("");
                $("#amountStatus").text("");
                $("#famountStatus").text("");
                return false;
            } else if($("#qty").val() == ""){
                $("#qtyStatus").text("Please enter qty");
                $("#studentStatus").text("");
                $("#bookStatus").text("");
                $("#amountStatus").text("");
                $("#famountStatus").text("");
                return false;
            } else if($("#amount").val() == ""){
                $("#amountStatus").text("Please enter amount");
                $("#studentStatus").text("");
                $("#bookStatus").text("");
                $("#qtyStatus").text("");
                $("#famountStatus").text("");
                return false;
            } else if($("#famount").val() == ""){
                $("#famountStatus").text("Please enter fine amount");
                $("#studentStatus").text("");
                $("#bookStatus").text("");
                $("#qtyStatus").text("");
                $("#amountStatus").text("");
                return false;
            } else {
                // clear all errors
                $("#bookStatus").text("");
                $("#studentStatus").text("");
                $("#qtyStatus").text("");
                $("#amountStatus").text("");
                $("#famountStatus").text("");
                return true;
            }
        }

        function validateUpdateData(){
            if(!bookTitles.includes($("#ubook").val())){
                $("#ubookStatus").text("Please select a book");
                $("#ustudentStatus").text("");
                $("#uqtyStatus").text("");
                $("#uamountStatus").text("");
                $("#ufamountStatus").text("");
                return false;
            } else if(!studentNames.includes($("#ustudent").val())){
                $("#ustudentStatus").text("Please select a student");
                $("#ubookStatus").text("");
                $("#uqtyStatus").text("");
                $("#uamountStatus").text("");
                $("#ufamountStatus").text("");
                return false;
            } else if($("#uqty").val() == ""){
                $("#uqtyStatus").text("Please enter qty");
                $("#ustudentStatus").text("");
                $("#ubookStatus").text("");
                $("#uamountStatus").text("");
                $("#ufamountStatus").text("");
                return false;
            } else if($("#uamount").val() == ""){
                $("#uamountStatus").text("Please enter amount");
                $("#ustudentStatus").text("");
                $("#ubookStatus").text("");
                $("#uqtyStatus").text("");
                $("#ufamountStatus").text("");
                return false;
            } else if($("#ufamount").val() == ""){
                $("#ufamountStatus").text("Please enter fine amount");
                $("#ustudentStatus").text("");
                $("#ubookStatus").text("");
                $("#uqtyStatus").text("");
                $("#uamountStatus").text("");
                return false;
            } else {
                // clear all errors
                $("#ubookStatus").text("");
                $("#ustudentStatus").text("");
                $("#uqtyStatus").text("");
                $("#uamountStatus").text("");
                $("#ufamountStatus").text("");
                return true;
            }
        }

        function deleteBorrow(id) {
            if(confirm("Are you sure you want to delete this borrow (#"+id+")?")){
                $.ajax({
                    type: "POST",
                    url: "actions/delete_borrow.php",
                    data: {
                        id: id,
                    },
                    dataType: "JSON",
                    success: function (response) {
                        if(response.status == 1){
                            // show success message
                            showBottomRightMessage(response.data);

                            // clear old list
                            $("#borrow-list").html("");

                            // get new list
                            getBorrow();
                        } else {
                            // show error message
                            showBottomRightMessage('Could not delete this borrow : '+response.data);
                        }
                    },
                    error: function(_, status, msg){
                        showBottomRightMessage('Could not delete borrow '+status+': '+msg);
                    },
                });
            }
        }

        $(document).ready(function () {
            const now = new Date();
            $("#borrow-dialog").hide();
            $("#update-dialog").hide();
            $(".startDate").hide();
            $(".endDate").hide();
            $(".startDDate").hide();
            $(".endDDate").hide();

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

            $("#update-dialog").dialog({
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

            // if opening this page for borrow from book page
            if(bTitle != ""){
                // get all books
                getAllBooks("#bookDataList");

                // get all students
                getAllStudents("#studentDataList");
                
                // set seletected book to the book from book page
                $("#book").val(bTitle);

                // set default qty to 1
                $("#qty").val("1");

                // set due date to next 1 day
                $("#due").val(now.getFullYear()+"-"+(now.getMonth()+1+"-"+(now.getDate()+1)));

                // open borrow dialog
                $("#borrow-dialog").dialog("open");
            }

            $("#borrow-btn").click(function(){
                // get all books
                getAllBooks("#bookDataList");

                // get all students
                getAllStudents("#studentDataList");

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
                if(validateData()) {
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
                                <td>`+now.getDate()+"/"+(now.getMonth()+1)+"/"+now.getFullYear()+`</td>
                                <td>`+due.getDate()+"/"+(due.getMonth()+1)+"/"+due.getFullYear()+`</td>
                                <td>
                                    <a class="cursor-pointer" onclick="edit('`+response.data.newId+`', '`+$("#book").val()+`', '`+$("#student").val()+`', '`+$("#qty").val()+`', '`+$("#amount").val()+`', '`+$("#famount").val()+`', '`+due+`', '0')"><i class="fas fa-pencil-alt"></i></a>
                                    `+(response.roleTitle == "Admin" ? `<a class="cursor-pointer" onclick="deleteBorrow('`+response.data.newId+`')"><i class="fas fa-trash-alt"></i></a>` : '')+`
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

            $("#update-btn").click(function(){
                if(validateUpdateData()){
                    const due = new Date($("#udue").val());
                    $.ajax({
                        type: "POST",
                        url: "actions/update_borrow.php",
                        data: {
                            id: $("#id").val(),
                            bookId: bookIds[bookTitles.indexOf($("#ubook").val())],
                            stuId: studentIds[studentNames.indexOf($("#ustudent").val())],
                            qty: $("#uqty").val(),
                            amount: $("#uamount").val(),
                            famount: $("#ufamount").val(),
                            dueDate: due.getFullYear()+"/"+(due.getMonth()+1)+"/"+due.getDate()+' 23:59:59',
                            isReturned: $("#isReturned").prop('checked') ? 1 : 0,
                        },
                        dataType: "JSON",
                        success: function (response) {
                            if(response.status == 1){
                                // show success message
                                showBottomRightMessage(response.data, 1);

                                // clear old list
                                $("#borrow-list").html("");

                                // get borrows
                                getBorrow();

                                // close update dialog
                                $("#update-dialog").dialog('close');
                            } else {
                                // show error message
                                showBottomRightMessage(response.data);
                            }
                        },
                        error: function(_, status, msg){
                            showBottomRightMessage('Could not update '+status+': '+msg);
                        },
                    });
                }
            });

            $("#filter-date-opt").change(function(){
                if($(this).val() == 'custom'){
                    // show start & end date
                    $(".startDate").show();
                    $(".endDate").show();

                    if($("#startDate").val() < $("#endDate").val()){
                        // clear old list
                        $("#borrow-list").html("");

                        // get borrows
                        getBorrow();
                    }
                } else {
                    // hide start & end date
                    $(".startDate").hide();
                    $(".endDate").hide();

                    // clear old list
                    $("#borrow-list").html("");

                    // get borrows
                    getBorrow();
                }
            });

            $("#startDate").change(function(){
                if($(this).val() < $("#endDate").val()){
                    // clear old list
                    $("#borrow-list").html("");

                    // get borrows
                    getBorrow();
                }
            });

            $("#endDate").change(function(){
                if($("#startDate").val() < $(this).val()){
                    // clear old list
                    $("#borrow-list").html("");

                    // get borrows
                    getBorrow();
                }
            });

            $("#filter-ddate-opt").change(function(){
                if($(this).val() == 'custom'){
                    // show start & end date
                    $(".startDDate").show();
                    $(".endDDate").show();

                    if($("#startDDate").val() < $("#endDDate").val()){
                        // clear old list
                        $("#borrow-list").html("");

                        // get borrows
                        getBorrow();
                    }
                } else {
                    // hide start & end date
                    $(".startDDate").hide();
                    $(".endDDate").hide();

                    // clear old list
                    $("#borrow-list").html("");

                    // get borrows
                    getBorrow();
                }
            });

            $("#startDDate").change(function(){
                if($(this).val() < $("#endDDate").val()){
                    // clear old list
                    $("#borrow-list").html("");

                    // get borrows
                    getBorrow();
                }
            });

            $("#endDDate").change(function(){
                if($("#startDDate").val() < $(this).val()){
                    // clear old list
                    $("#borrow-list").html("");

                    // get borrows
                    getBorrow();
                }
            });

            $("#filter-status").change(function(){
                // clear old list
                $("#borrow-list").html("");

                // get borrows
                getBorrow();
            });

            // when user click load more
            $(".load-more").click(function() {
                offset += limit;
                
                // get more user
                getBorrow();
            });
        });
    </script>
</head>
<body>
    <div class="wrapper padding-20">
        <div class="wrapper padding-20 back-white radius-all20 shadow-gray">
            <div class="row space-between">
                <div class="row gap10 content-top">
                    <div class="col w100">
                        <label for="filter-date-opt">Borrow Date</label><br>
                        <div class="filter-box">
                            <select class="w100per" name="filter-date-opt" id="filter-date-opt">
                                <option value="all">All</option>
                                <option value="custom">Custom</option>
                            </select>
                            <i class="fas fa-caret-down"></i>
                        </div>
                    </div>
                    <div class="col w100 startDate">
                        <label for="startDate">Start Date</label><br>
                        <input class="filter-date" type="date" name="startDate" id="startDate">
                    </div>
                    <div class="col w100 endDate">
                        <label for="endDate">End Date</label><br>
                        <input class="filter-date" type="date" name="endDate" id="endDate">
                    </div>
                    <div class="col w100">
                        <label for="filter-ddate-opt">Due Date</label><br>
                        <div class="filter-box">
                            <select class="w100per" name="filter-ddate-opt" id="filter-ddate-opt">
                                <option value="all">All</option>
                                <option value="custom">Custom</option>
                            </select>
                            <i class="fas fa-caret-down"></i>
                        </div>
                    </div>
                    <div class="col w100 startDDate">
                        <label for="startDDate">Start Date</label><br>
                        <input class="filter-date" type="date" name="startDDate" id="startDDate">
                    </div>
                    <div class="col w100 endDDate">
                        <label for="endDDate">End Date</label><br>
                        <input class="filter-date" type="date" name="endDDate" id="endDDate">
                    </div>
                    <div class="col w130">
                        <label for="filter-status">Status</label><br>
                        <div class="filter-box">
                            <select class="w100per" name="filter-status" id="filter-status">
                                <option value="all">All</option>
                                <option value="b">Borrowing</option>
                                <option value="r">Returned</option>
                            </select>
                            <i class="fas fa-caret-down"></i>
                        </div>
                    </div>
                </div>
                <div class="stu-list-title"></div>
                <!-- <div class="list-options row gap10">
                    <a href="#"><i class="fas fa-file-export"></i>&nbsp;&nbsp;Export</a>
                    <a href="#"><i class="fas fa-filter"></i>&nbsp;&nbsp;Filter</a>
                </div> -->
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
                <input type="text" id="book" class="w100per input-back-gray" autocomplete="on" list="bookDataList" placeholder="Select a book">
                <div id="bookStatus" class="input-error-status"></div>
                <datalist id="bookDataList"></datalist>
                <div class="h10"></div>

                <label for="student">Student</label><br>
                <input type="text" id="student" class="w100per input-back-gray" autocomplete="on" list="studentDataList" placeholder="Select a student">
                <div id="studentStatus" class="input-error-status"></div>
                <datalist id="studentDataList"></datalist>
                <div class="h10"></div>

                <label for="qty">Quantity</label>
                <input class="w100per" type="number" name="qty" id="qty" placeholder="Quantity"><br>
                <div id="qtyStatus" class="input-error-status"></div>

                <label for="amount">Borrow Amount ($)</label>
                <input class="w100per" type="number" name="amount" id="amount" placeholder="Amount"><br>
                <div id="amountStatus" class="input-error-status"></div>

                <label for="afmount">Fine Amount ($)</label>
                <input class="w100per" type="number" name="famount" id="famount" placeholder="Fine Amount"><br>
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
    <div class="dialog" id="update-dialog" title="Issue Book">
        <div class="row gap25 content-top">
            <div class="col w100per">
                <input type="hidden" name="id" id="id">
                <label for="ubook">Book</label><br>
                <input type="text" id="ubook" class="w100per input-back-gray" autocomplete="on" list="ubookDataList" placeholder="Select a book">
                <div id="ubookStatus" class="input-error-status"></div>
                <datalist id="ubookDataList"></datalist>
                <div class="h10"></div>

                <label for="ustudent">Student</label><br>
                <input type="text" id="ustudent" class="w100per input-back-gray" autocomplete="on" list="ustudentDataList" placeholder="Select a student">
                <div id="ustudentStatus" class="input-error-status"></div>
                <datalist id="ustudentDataList"></datalist>
                <div class="h10"></div>

                <label for="uqty">Quantity</label>
                <input class="w100per" type="number" name="uqty" id="uqty" placeholder="Quantity"><br>
                <div id="uqtyStatus" class="input-error-status"></div>

                <label for="uamount">Borrow Amount ($)</label>
                <input class="w100per" type="number" name="uamount" id="uamount" placeholder="Borrow Amount"><br>
                <div id="uamountStatus" class="input-error-status"></div>

                <label for="ufamount">Fine Amount ($)</label>
                <input class="w100per" type="number" name="ufamount" id="ufamount" placeholder="Fine Amount"><br>
                <div id="ufamountStatus" class="input-error-status"></div>

                <label for="udue">Due Date</label>
                <input class="w100per" type="date" name="udue" id="udue"><br>
                <div id="udueStatus" class="input-error-status"></div>

                <input type="checkbox" name="isReturned" id="isReturned">&nbsp;&nbsp;
                <label for="isReturned">Returned</label>
            </div><br>
        </div> <br>
        <div class="row content-right gap10">
            <a class="btn cursor-pointer" onclick="$('#update-dialog').dialog('close');">Close</a>
            <a class="primary-btn cursor-pointer" id="update-btn">Update</a>
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
    } else if(isset($_GET['action']) && isset($_GET['bTitle'])){
        echo "<script>
            bTitle = '".$_GET['bTitle']."';
            getBorrow();
        </script>";
    } else {
        echo "<script>getBorrow()</script>";
    }
?>