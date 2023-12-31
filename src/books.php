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
        var offset = 0, limit = 10, searchKey = '';

        function getBooks() {
            var data = {
                limit: limit,
                offset: offset,
            };

            if(searchKey != ''){
                data.searchKey = searchKey;
            }

            $.ajax({
                type: "GET",
                url: "actions/get_books.php",
                data: data,
                dataType: "JSON",
                success: function (response) {
                    if(response.status == 1){
                        var reCount = 0;
                        $.each(response.data, function (i, v) { 
                             // create new book item
                             var newBook = `
                                <a class="book-box" onclick="showDetails('`+v.id+`','`+v.title+`','`+v.desc+`','`+v.cate+`','`+v.author+`','`+v.pub+`','`+v.price+`','`+v.cover+`','`+v.createdDate+`','`+v.updatedDate+`', '`+response.roleTitle+`');">
                                    <div class="book-cover">
                                        <img src="../upload/book/`+v.cover+`" alt="cover">
                                    </div>
                                    <div class="book-title center">`+v.title+`</div>
                                </a>
                            `;

                            // add new book to the book list
                            $("#book-list").append(newBook);
                            reCount = reCount + 1;
                        });

                        if(reCount > 0){
                            $("#no-result").hide();
                            if(response.hasMore){
                                $(".load-more").show();
                            } else {
                                $(".load-more").hide();
                            }
                        } else {
                            $(".load-more").hide();
                            $("#no-result").show();
                        }
                    } else {
                        showBottomRightMessage(response.data);
                    }
                },
                error: function(_, status, msg){
                    showBottomRightMessage(status+': '+msg);
                }
            });
        }

        function showDetails(id, title, desc, cate, author, pub, price, cover, createdDate, updatedDate, roleTitle){
            const cDate = new Date(createdDate);

            // set value to dialog
            $("#id").val(id);
            $("#d-title").text(": "+title);
            $("#d-desc").text(": "+desc);
            $("#d-cate").text(": "+cate);
            $("#d-author").text(": "+author);
            $("#d-pub").text(": "+pub);
            $("#d-price").text(": $"+price);
            $("#d-cover").prop("src", "../upload/book/"+cover);
            $("#d-created-date").text(": "+cDate.toLocaleString());

            // hide delete btn if not admin
            if(roleTitle != "Admin"){
                $("#update-actions").removeClass("space-between");
                $("#update-actions").addClass("content-right");
                $("#d-btn-delete").hide();
            }

            if(updatedDate != 'null'){
                const uDate = new Date(updatedDate);
                $("#d-updated-date").text(": "+uDate.toLocaleString());
                $("#d-update-date-section").show();
            } else {
                $("#d-update-date-section").hide();
            }

            // open dialog
            $('#book-details').dialog('open');
        }

        $(document).ready(function(){
            $("#book-details").hide();
            $("#create-dialog").hide();

            $("#book-details").dialog({
                autoOpen: false,
                modal: true,
                width: 700,
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

            $("#create-dialog").dialog({
                autoOpen: false,
                modal: true,
                width: 700,
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
                width: 700,
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

            $("#create-book-btn").click(function (e) { 
                e.preventDefault();
                
                // get value from input
                const title = $("#title").val();
                const desc = $("#desc").val();
                const cate = $("#cate").val();
                const author = $("#author").val();
                const publisher = $("#pub").val();
                const price = $("#price").val();
                const cover = $("#cover").prop("files");

                // clear error
                $("#titleStatus").text('');
                $("#authorStatus").text('');
                $("#pubStatus").text('');
                $("#priceStatus").text('');
                $("#imgStatus").text('');

                if(title == ''){
                    $("#titleStatus").text('Please enter book title');
                } else if(author == ''){
                    $("#authorStatus").text('Please enter author name');
                } else if(publisher == ''){
                    $("#pubStatus").text('Please enter publisher name');
                } else if(price == ''){
                    $("#priceStatus").text('Please enter book borrow price as number');
                } else if(!cover[0]){
                    $("#imgStatus").text('Please select a book cover');
                } else {
                    // create form data to send to php
                    var fdata = new FormData();
                    fdata.append("cover", cover[0]);
                    fdata.append("title", title);
                    fdata.append("desc", desc);
                    fdata.append("cate", cate);
                    fdata.append("author", author);
                    fdata.append("pub", publisher);
                    fdata.append("price", price);

                    $.ajax({
                        method: "POST",
                        url: "actions/create_book.php",
                        data: fdata,
                        dataType: "JSON",
                        processData: false,
                        cache: false,
                        contentType: false,
                        success: function (response) {
                            if(response.status == 1){
                                // show message
                                showBottomRightMessage("Created new book! ID: "+ response.data.newId, 1);

                                const date = new Date();

                                // create new book item
                                var newBook = `
                                    <a class="book-box" onclick="showDetails('`+response.data.newId+`','`+title+`','`+desc+`','`+cate+`','`+author+`','`+publisher+`','`+price+`','`+response.data.cover+`','`+date+`','null', '`+response.roleTitle+`');">
                                        <div class="book-cover">
                                            <img src="../upload/book/`+response.data.cover+`" alt="cover">
                                        </div>
                                        <div class="book-title center">`+title+`</div>
                                    </a>
                                `;

                                // add new book to the book list
                                $("#book-list").prepend(newBook);

                                // hide no results
                                $("#no-result").hide();

                                // clear inputed data
                                $("#book-cover-img").prop("src", "../media/add_img.png");
                                $("#title").val("");
                                $("#desc").val("");
                                $("#cate").val("Anthologies");
                                $("#author").val("");
                                $("#pub").val("");
                                $("#price").val("");
                                $("#cover").val(null);

                                // close create dialog
                                $('#create-dialog').dialog('close');
                            } else {
                                showBottomRightMessage(response.data);
                            }
                        },
                        error: function(_, status, msg){
                            showBottomRightMessage(status+': '+msg);
                        }
                    });
                }
            });

            // when user click on update button on details dialog
            $("#d-btn-update").click(function(){
                // close details dialog
                $('#book-details').dialog('close');

                // transfer existing value to update dialog
                $("#u-cover").prop("src", $("#d-cover").prop("src"));
                $("#utitle").val($("#d-title").text().replace(": ", ""));
                $("#udesc").val($("#d-desc").text().replace(": ", ""));
                $("#ucate").val($("#d-cate").text().replace(": ", ""));
                $("#uauthor").val($("#d-author").text().replace(": ", ""));
                $("#upub").val($("#d-pub").text().replace(": ", ""));
                $("#uprice").val($("#d-price").text().replace(": $", ""));

                // open update dialog
                $("#update-dialog").dialog('open');
            });

            // when user click on update button on update dialog
            $("#update-book-btn").click(function(){
                // get value from input
                const title = $("#utitle").val();
                const desc = $("#udesc").val();
                const cate = $("#ucate").val();
                const author = $("#uauthor").val();
                const publisher = $("#upub").val();
                const price = $("#uprice").val();
                const cover = $("#ucover").prop("files");
                const oldCover = $("#d-cover").prop("src");

                // clear error
                $("#titleStatus").text('');
                $("#authorStatus").text('');
                $("#pubStatus").text('');
                $("#priceStatus").text('');
                $("#imgStatus").text('');

                if(title == ''){
                    $("#titleStatus").text('Please enter book title');
                } else if(author == ''){
                    $("#authorStatus").text('Please enter author name');
                } else if(publisher == ''){
                    $("#pubStatus").text('Please enter publisher name');
                } else if(price == ''){
                    $("#priceStatus").text('Please enter book borrow price as number');
                } else {
                    // create form data to send to php
                    var fdata = new FormData();
                    fdata.append("title", title);
                    fdata.append("desc", desc);
                    fdata.append("cate", cate);
                    fdata.append("author", author);
                    fdata.append("pub", publisher);
                    fdata.append("price", price);
                    fdata.append("id", $("#id").val());

                    // if use chosen img
                    if(cover !== undefined){
                        fdata.append("cover", cover[0]);
                        fdata.append("oldCover", oldCover);
                    }

                    $.ajax({
                        method: "POST",
                        url: "actions/update_book.php",
                        data: fdata,
                        dataType: "JSON",
                        processData: false,
                        cache: false,
                        contentType: false,
                        success: function (response) {
                            if(response.status == 1){
                                // show success message
                                showBottomRightMessage(response.data, 1);

                                // clear book list
                                $("#book-list").html("");

                                // get new data
                                getBooks();

                                // close update dialog
                                $('#update-dialog').dialog('close');
                            } else {
                                showBottomRightMessage(response.data);
                            }
                        },
                        error: function(_, status, msg){
                            showBottomRightMessage(status+': '+msg);
                        }
                    });
                }
            });

            // when user click on delete button on details dialog
            $("#d-btn-delete").click(function(){
                if(confirm("Are you sure want to delete this book?")){
                    $.ajax({
                        type: "POST",
                        url: "actions/delete_book.php",
                        data: {
                            "id": $("#id").val(),
                            "cover": $("#d-cover").prop("src"),
                        },
                        dataType: "JSON",
                        success: function (response) {
                            if(response.status == 1){
                                // show success message
                                showBottomRightMessage(response.data, 1);

                                // clear current book list
                                $("#book-list").html("");

                                // get new data
                                getBooks();

                                // close details dialog
                                $('#book-details').dialog('close');
                            } else {
                                showBottomRightMessage(response.data);
                            }
                        },
                        error: function(_, status, msg){
                            showBottomRightMessage(status+': '+msg);
                        }
                    });
                }
            });

            $("#d-btn-borrow").click(function (e) { 
                e.preventDefault();
                window.location.href = "borrows.php?action=borrows&bTitle="+$("#d-title").text().replace(": ", "");
            });

            // when user click load more
            $(".load-more").click(function() {
                offset += limit;
                
                // get more user
                getBooks();
            });
        });
    </script>
</head>
<body>
    <div class="wrapper padding-20">
        <div id="book-list" class="row wrap gap25 content-bottom"></div><br>
        <div id="no-result" class="center w100per">
            <dotlottie-player src="https://lottie.host/368474bf-84db-4d4a-bbd2-65219928b446/3jKzzZOp3j.json" background="transparent" speed="1" style="width: 300px; height: 300px; margin-left: 38%;" loop autoplay></dotlottie-player>
            <p class="gray" >No Result</p>
        </div>
        <a class="row content-center primary-color load-more cursor-pointer">
            <i class="fas fa-chevron-down primary-color"></i>&nbsp;&nbsp;Load More
        </a>
        <a href="#" class="overlay-bottom-right" onclick="$('#create-dialog').dialog('open')">
            <i class="fas fa-plus white"></i>
        </a>
    </div>
    <div class="dialog" id="book-details" title="Book Details">
        <div class="row gap25 content-top">
            <input type="hidden" name="id" id="id">
            <div id="book-cover">
                <img id="d-cover" src="../media/book-cover.jpg" alt="Book Cover">
            </div>
            <table>
                <tr>
                    <td width="100px">Title</td>
                    <td id="d-title"></td>
                </tr>
                <tr>
                    <td width="100px">Description</td>
                    <td id="d-desc"></td>
                </tr>
                <tr>
                    <td width="100px">Category</td>
                    <td id="d-cate"></td>
                </tr>
                <tr>
                    <td width="100px">Author</td>
                    <td id="d-author"></td>
                </tr>
                <tr>
                    <td width="100px">Publisher</td>
                    <td id="d-pub"></td>
                </tr>
                <tr>
                    <td width="100px">Price</td>
                    <td id="d-price"></td>
                </tr>
                <tr>
                    <td width="100px">Created Date</td>
                    <td id="d-created-date"></td>
                </tr>
                <tr id="d-update-date-section">
                    <td width="100px">Last Updated</td>
                    <td id="d-updated-date"></td>
                </tr>
            </table>
        </div> <br>
        <div id="update-actions" class="row space-between gap10">
            <button class="deleteBtn" id="d-btn-delete">Delete</button>
            <div class="row gap10">
                <button class="closeBtn" onclick="$('#book-details').dialog('close');">Close</button>
                <button id="d-btn-borrow" class="createBtn">Borrow</button>
                <button id="d-btn-update" class="createBtn">Update</button>
            </div>
        </div>
    </div>
    <div class="dialog" id="create-dialog" title="Create Book">
        <div class="row gap25 content-top">
            <div class="col w200">
                <div id="book-cover">
                    <img id="book-cover-img" src="../media/add_img.png" alt="Book Cover">
                </div><br>
                <div id="imgStatus" class="input-error-status"></div><br>
                <label class="choose-file-btn w100per back-gray" for="cover"><span class="gray">Choose Book Cover</span></label>
                <input type="file" accept="image/*" name="cover" id="cover" onchange="document.getElementById('book-cover-img').src = window.URL.createObjectURL(this.files[0])">
            </div>
            <div class="col w100per">
                <label for="title">Title</label>
                <input class="w100per" type="text" name="title" id="title" placeholder="Title"><br>
                <div id="titleStatus" class="input-error-status"></div>
                <label for="desc">Description</label>
                <textarea class="w100per" type="text" name="desc" id="desc" rows="3" placeholder="Description"></textarea><br>
                <label for="cate">Category</label>
                <div class="filter-box w100per back-gray">
                    <select name="cate" id="cate">
                        <option value="Anthologies">Anthologies</option>
                        <option value="Art Books">Art Books</option>
                        <option value="Bussiness">Bussiness</option>
                        <option value="Children's Books">Children's Books</option>
                        <option value="Cookbooks">Cookbooks</option>
                        <option value="Fiction">Fiction</option>
                        <option value="Graphic Novels">Graphic Novels</option>
                        <option value="Mystery">Mystery</option>
                        <option value="Non-fiction">Non-fiction</option>
                        <option value="Poetry">Poetry</option>
                        <option value="Reference Books">Reference Books</option>
                        <option value="Religious">Religious</option>
                        <option value="Science">Science</option>
                        <option value="Technology">Technology</option>
                        <option value="Textbooks">Textbooks</option>
                        <option value="Travel">Travel</option>
                    </select>
                    <i class="fas fa-caret-down"></i>
                </div>
                <div class="h10"> </div>
                <label for="author">Author</label>
                <input class="w100per" type="text" name="author" id="author" placeholder="Author"><br>
                <div id="authorStatus" class="input-error-status"></div>
                <label for="pub">Publisher</label>
                <input class="w100per" type="text" name="pub" id="pub" placeholder="Publisher"><br>
                <div id="pubStatus" class="input-error-status"></div>
                <label for="price">Price ($)</label>
                <input class="w100per" type="number" name="price" id="price" placeholder="Price"><br>
                <div id="priceStatus" class="input-error-status"></div>
            </div><br>
        </div> <br>
        <div class="row content-right gap10">
            <a class="btn cursor-pointer" onclick="$('#create-dialog').dialog('close');">Close</a>
            <a class="primary-btn cursor-pointer" id="create-book-btn">Create</a>
        </div>
    </div>
    <div class="dialog" id="update-dialog" title="Update Book">
        <div class="row gap25 content-top">
            <div class="col w200">
                <div id="book-cover">
                    <img id="u-cover" src="../media/add_img.png" alt="Book Cover">
                </div><br>
                <div id="imgStatus" class="input-error-status"></div><br>
                <label class="choose-file-btn w100per back-gray" for="ucover"><span class="gray">Choose Book Cover</span></label>
                <input type="file" accept="image/*" name="ucover" id="ucover" onchange="document.getElementById('u-cover').src = window.URL.createObjectURL(this.files[0])">
            </div>
            <div class="col w100per">
                <label for="utitle">Title</label>
                <input class="w100per" type="text" name="utitle" id="utitle" placeholder="Title"><br>
                <div id="titleStatus" class="input-error-status"></div>
                <label for="udesc">Description</label>
                <textarea class="w100per" type="text" name="udesc" id="udesc" rows="3" placeholder="Desctiption"></textarea><br>
                <label for="ucate">Category</label>
                <div class="filter-box w100per back-gray">
                    <select name="ucate" id="ucate">
                        <option value="Anthologies">Anthologies</option>
                        <option value="Art Books">Art Books</option>
                        <option value="Bussiness">Bussiness</option>
                        <option value="Children's Books">Children's Books</option>
                        <option value="Cookbooks">Cookbooks</option>
                        <option value="Fiction">Fiction</option>
                        <option value="Graphic Novels">Graphic Novels</option>
                        <option value="Mystery">Mystery</option>
                        <option value="Non-fiction">Non-fiction</option>
                        <option value="Poetry">Poetry</option>
                        <option value="Reference Books">Reference Books</option>
                        <option value="Religious">Religious</option>
                        <option value="Science">Science</option>
                        <option value="Technology">Technology</option>
                        <option value="Textbooks">Textbooks</option>
                        <option value="Travel">Travel</option>
                    </select>
                    <i class="fas fa-caret-down"></i>
                </div>
                <div class="h10"></div>
                <label for="uauthor">Author</label>
                <input class="w100per" type="text" name="uauthor" id="uauthor" placeholder="Author"><br>
                <div id="authorStatus" class="input-error-status"></div>
                <label for="upub">Publisher</label>
                <input class="w100per" type="text" name="upub" id="upub" placeholder="Publisher"><br>
                <div id="pubStatus" class="input-error-status"></div>
                <label for="uprice">Price ($)</label>
                <input class="w100per" type="number" name="uprice" id="uprice" placeholder="Price"><br>
                <div id="priceStatus" class="input-error-status"></div>
            </div><br>
        </div> <br>
        <div class="row content-right gap10">
            <a class="btn cursor-pointer" onclick="$('#update-dialog').dialog('close');">Close</a>
            <a class="primary-btn cursor-pointer" id="update-book-btn">Update</a>
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
            getBooks();
        </script>";
    } else {
        echo "<script>getBooks()</script>";
    }
?>