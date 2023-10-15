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
        var offset = 0, limit = 20, searchKey = '';

        function getBooks() {
            var data = {
                limit: limit,
                offset: offset,
            };

            $.ajax({
                type: "GET",
                url: "actions/get_books.php",
                data: data,
                dataType: "JSON",
                success: function (response) {
                    if(response.status == 1){
                        $.each(response.data, function (i, v) { 
                             // create new book item
                             var newBook = `
                                <a class="book-box" onclick="showDetails('`+v.title+`','`+v.desc+`','`+v.cate+`','`+v.author+`','`+v.pub+`','`+v.price+`','`+v.cover+`','`+v.createdDate+`','`+v.updatedDate+`');">
                                    <div class="book-cover">
                                        <img src="../upload/book/`+v.cover+`" alt="cover">
                                    </div>
                                    <div class="book-title center">`+v.title+`</div>
                                </a>
                            `;

                            // add new book to the book list
                            $("#book-list").append(newBook);
                        });
                    } else {
                        showBottomRightMessage(response.data);
                    }
                },
                error: function(_, status, msg){
                    showBottomRightMessage(status+': '+msg);
                }
            });
        }

        function showDetails(title, desc, cate, author, pub, price, cover, createdDate, updatedDate){
            const cDate = new Date(createdDate);

            // set value to dialog
            $("#d-title").text(": "+title);
            $("#d-desc").text(": "+desc);
            $("#d-cate").text(": "+cate);
            $("#d-author").text(": "+author);
            $("#d-pub").text(": "+pub);
            $("#d-price").text(": $"+price);
            $("#d-cover").prop("src", "../upload/book/"+cover);
            $("#d-created-date").text(": "+cDate.toLocaleString());

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
                                    <a class="book-box" onclick="showDetails('`+title+`','`+desc+`','`+cate+`','`+author+`','`+publisher+`','`+price+`','`+response.data.cover+`','`+date+`','null');">
                                        <div class="book-cover">
                                            <img src="../upload/book/`+response.data.cover+`" alt="cover">
                                        </div>
                                        <div class="book-title center">`+title+`</div>
                                    </a>
                                `;

                                // add new book to the book list
                                $("#book-list").prepend(newBook);

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

            $("#d-btn-update").click(function(){
                $('#book-details').dialog('close');
                $("#update-dialog").dialog('open');
            });
        });
    </script>
</head>
<body>
    <div class="wrapper padding-20">
        <div id="book-list" class="row wrap gap25 content-bottom"></div><br>
        <a href="#" class="row content-center primary-color load-more">
            <i class="fas fa-chevron-down primary-color"></i>&nbsp;&nbsp;Load More
        </a>
        <a href="#" class="overlay-bottom-right" onclick="$('#create-dialog').dialog('open')">
            <i class="fas fa-plus white"></i>
        </a>
    </div>
    <div class="dialog" id="book-details" title="Book Details">
        <div class="row gap25 content-top">
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
        <div class="row space-between gap10">
            <button class="deleteBtn" onclick="$('#book-details').dialog('close');">Delete</button>
            <div class="row gap10">
                <button class="closeBtn" onclick="$('#book-details').dialog('close');">Close</button>
                <button id="d-btn-update" class="createBtn">Update</button>
            </div>
        </div>
    </div>
    <div class="dialog" id="create-dialog" title="Create Book">
        <div class="row gap25 content-top">
            <div class="col w200">
                <div id="book-cover">
                    <img id="book-cover-img" src="../media/book-cover.jpg" alt="Book Cover">
                </div><br>
                <div id="imgStatus" class="input-error-status"></div><br>
                <label class="choose-file-btn w100per back-gray" for="cover"><span class="gray">Choose Book Cover</span></label>
                <input type="file" accept="image/*" name="cover" id="cover" onchange="document.getElementById('book-cover-img').src = window.URL.createObjectURL(this.files[0])">
            </div>
            <div class="col w100per">
                <label for="title">Title</label>
                <input class="w100per" type="text" name="title" id="title"><br>
                <div id="titleStatus" class="input-error-status"></div>
                <label for="desc">Description</label>
                <textarea class="w100per" type="text" name="desc" id="desc" rows="3"></textarea><br>
                <label for="cate">Category</label>
                <div class="filter-box w100per">
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
                <input class="w100per" type="text" name="author" id="author"><br>
                <div id="authorStatus" class="input-error-status"></div>
                <label for="pub">Publisher</label>
                <input class="w100per" type="text" name="pub" id="pub"><br>
                <div id="pubStatus" class="input-error-status"></div>
                <label for="price">Price</label>
                <input class="w100per" type="number" name="price" id="price"><br>
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
                    <img id="book-cover-img" src="../media/book-cover.jpg" alt="Book Cover">
                </div><br>
                <div id="imgStatus" class="input-error-status"></div><br>
                <label class="choose-file-btn w100per back-gray" for="cover"><span class="gray">Choose Book Cover</span></label>
                <input type="file" accept="image/*" name="cover" id="cover" onchange="document.getElementById('book-cover-img').src = window.URL.createObjectURL(this.files[0])">
            </div>
            <div class="col w100per">
                <label for="title">Title</label>
                <input class="w100per" type="text" name="title" id="title"><br>
                <div id="titleStatus" class="input-error-status"></div>
                <label for="desc">Description</label>
                <textarea class="w100per" type="text" name="desc" id="desc" rows="3"></textarea><br>
                <label for="cate">Category</label>
                <div class="filter-box w100per">
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
                <input class="w100per" type="text" name="author" id="author"><br>
                <div id="authorStatus" class="input-error-status"></div>
                <label for="pub">Publisher</label>
                <input class="w100per" type="text" name="pub" id="pub"><br>
                <div id="pubStatus" class="input-error-status"></div>
                <label for="price">Price</label>
                <input class="w100per" type="number" name="price" id="price"><br>
                <div id="priceStatus" class="input-error-status"></div>
            </div><br>
        </div> <br>
        <div class="row content-right gap10">
            <a class="btn cursor-pointer" onclick="$('#update-dialog').dialog('close');">Close</a>
            <a class="primary-btn cursor-pointer" id="create-book-btn">Create</a>
        </div>
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