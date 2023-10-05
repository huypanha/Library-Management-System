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
        });
    </script>
</head>
<body>
    <div class="wrapper padding-20">
        <div class="row wrap gap25 content-top">
            <a class="book-box" onclick="$('#book-details').dialog('open');">
                <div class="book-cover">
                    <img src="../media/book-cover.jpg" alt="cover">
                </div>
                <div class="book-title center">កាដូជីវិត</div>
            </a>
            <a class="book-box">
                <div class="book-cover">
                    <img src="../media/angel-bookstore.jpg" alt="cover">
                </div>
                <div class="book-title center">កាដូជីវិត</div>
            </a>
            <a class="book-box">
                <div class="book-cover">
                    <img src="../media/book-cover.jpg" alt="cover">
                </div>
                <div class="book-title center">កាដូជីវិត</div>
            </a>
            <a class="book-box">
                <div class="book-cover">
                    <img src="../media/book-cover.jpg" alt="cover">
                </div>
                <div class="book-title center">កាដូជីវិត</div>
            </a>
            <a class="book-box">
                <div class="book-cover">
                    <img src="../media/book-cover.jpg" alt="cover">
                </div>
                <div class="book-title center">កាដូជីវិត</div>
            </a>
            <a class="book-box">
                <div class="book-cover">
                    <img src="../media/book-cover.jpg" alt="cover">
                </div>
                <div class="book-title center">កាដូជីវិត</div>
            </a>
            <a class="book-box">
                <div class="book-cover">
                    <img src="../media/book-cover.jpg" alt="cover">
                </div>
                <div class="book-title center">កាដូជីវិត</div>
            </a>
            <a class="book-box">
                <div class="book-cover">
                    <img src="../media/book-cover.jpg" alt="cover">
                </div>
                <div class="book-title center">កាដូជីវិត</div>
            </a>
            <a class="book-box">
                <div class="book-cover">
                    <img src="../media/book-cover.jpg" alt="cover">
                </div>
                <div class="book-title center">កាដូជីវិត</div>
            </a>
            <a class="book-box">
                <div class="book-cover">
                    <img src="../media/book-cover.jpg" alt="cover">
                </div>
                <div class="book-title center">កាដូជីវិត</div>
            </a>
        </div><br>
        <a href="#" class="row content-center primary-color load-more">
            <i class="fas fa-chevron-down primary-color"></i>&nbsp;&nbsp;Load More
        </a>
        <a href="#" class="overlay-bottom-right" onclick="$('#create-dialog').dialog('open')">
            <i class="fas fa-plus white"></i>
        </a>
    </div>
    <div id="book-details" title="Book Details">
        <div class="row gap25">
            <div id="book-cover">
                <img src="../media/book-cover.jpg" alt="Book Cover">
            </div>
            <table>
                <tr>
                    <td width="100px">Title</td>
                    <td>: កាដូជីវិត</td>
                </tr>
                <tr>
                    <td width="100px">Type</td>
                    <td>: Love</td>
                </tr>
                <tr>
                    <td width="100px">Edition</td>
                    <td>: Edition</td>
                </tr>
                <tr>
                    <td width="100px">Author</td>
                    <td>: Huy Panha</td>
                </tr>
                <tr>
                    <td width="100px">Publisher</td>
                    <td>: Huy Panha</td>
                </tr>
                <tr>
                    <td width="100px">Price</td>
                    <td>: $10</td>
                </tr>
                <tr>
                    <td width="100px">Status</td>
                    <td>: Available</td>
                </tr>
            </table>
        </div> <br>
        <div class="row content-right">
            <a href="#" onclick="$('#book-details').dialog('close');">Close</a>
        </div>
    </div>
    <div id="create-dialog" title="Create Book">
        <div class="row gap25">
            <div class="col w200">
                <div id="book-cover">
                    <img src="../media/book-cover.jpg" alt="Book Cover">
                </div><br>
                <label class="choose-file-btn w100per back-gray" for="cover"><span>Choose Book Cover</span></label>
                <input type="file" name="cover" id="cover">
            </div>
            <div class="col w100per">
                <label for="title">Title</label>
                <input class="w100per" type="text" name="title" id="title" requeried><br>
                <label for="type">Type</label>
                <!-- <input class="w100per" type="text" name="type" id="type" requeried><br> -->
                <div class="filter-box w100per">
                    <select name="filter" id="filter">
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
                </div><br>
                <label for="edition">Edition</label>
                <input class="w100per" type="text" name="edition" id="edition" requeried><br>
                <label for="author">Author</label>
                <input class="w100per" type="text" name="author" id="author" requeried><br>
                <label for="pub">Publisher</label>
                <input class="w100per" type="text" name="pub" id="pub" requeried><br>
                <label for="price">Price</label>
                <input class="w100per" type="number" name="price" id="price" requeried><br>
            </div><br>
        </div> <br>
        <div class="row content-right gap10">
            <a class="btn" href="#" onclick="$('#create-dialog').dialog('close');">Close</a>
            <a class="primary-btn" href="#" onclick="$('#create-dialog').dialog('close');">Create</a>
        </div>
    </div>
</body>
</html>