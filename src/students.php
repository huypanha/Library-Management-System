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
            $("#dialog").dialog({
                autoOpen: true,
                button: [
                    {
                        text: "Close",
                        click: function() {
                            $( this ).dialog( "close" );
                        }
                    }
                ]
            });

            // function closeDialog() {
            //     $("#dialog").dialog("close");
            // }
        });
    </script>
</head>
<body>
    <div id="dialog" title="Dialog Title">
        <h1>Title</h1>
        <button onclick="$('#dialog').dialog('close');">Close</button>
    </div>
    <div class="wrapper padding-20">
        <div class="row space-between">
            <ul class="tabbar">
                <li class="tabbar-item tabbar-item-active">Students</li>
                <li class="tabbar-item">Users</li>
            </ul>
            <a class="add-new-btn" href="#"><i class="fad fa-user-plus white"></i>&nbsp;&nbsp;Add New</a>
        </div><br>
        <div class="wrapper padding-20 back-white radius-all20 shadow-gray">
            <div class="row space-between">
                <div class="stu-list-title">Students</div>
                <div class="list-options row gap10">
                    <a href="#"><i class="fas fa-file-export"></i>&nbsp;&nbsp;Export</a>
                    <a href="#"><i class="fas fa-filter"></i>&nbsp;&nbsp;Filter</a>
                    <!-- <div class="filter-box w200 ml20">
                        <select name="filter" id="filter">
                            <option value="today">Today</option>
                            <option value="week">This Week</option>
                            <option value="month">This Month</option>
                            <option value="year">This Year</option>
                        </select>
                        <i class="fas fa-caret-down"></i>
                    </div> -->
                </div>
            </div>
            <div class="row scroll-x mt10">
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Gender</th>
                        <th>Date of Birth</th>
                        <th>Contact</th>
                        <th>Address</th>
                        <th>Black List</th>
                        <th>Join Date</th>
                        <th>Actions</th>
                    </tr>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Huy Panha</td>
                            <td>Male</td>
                            <td>26/05/2002</td>
                            <td>093681313</td>
                            <td>Preaek Lieb, Chroy Chanva, Phnom Penh</td>
                            <td>False</td>
                            <td>01/10/2023</td>
                            <td>
                                <a href="#"><i class="fas fa-pencil-alt"></i></a>
                                <a href="#"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Huy Panha</td>
                            <td>Male</td>
                            <td>26/05/2002</td>
                            <td>093681313</td>
                            <td>Preaek Lieb, Chroy Chanva, Phnom Penh</td>
                            <td>False</td>
                            <td>01/10/2023</td>
                            <td>
                                <a href="#"><i class="fas fa-pencil-alt"></i></a>
                                <a href="#"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Huy Panha</td>
                            <td>Male</td>
                            <td>26/05/2002</td>
                            <td>093681313</td>
                            <td>Preaek Lieb, Chroy Chanva, Phnom Penh</td>
                            <td>False</td>
                            <td>01/10/2023</td>
                            <td>
                                <a href="#"><i class="fas fa-pencil-alt"></i></a>
                                <a href="#"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Huy Panha</td>
                            <td>Male</td>
                            <td>26/05/2002</td>
                            <td>093681313</td>
                            <td>Preaek Lieb, Chroy Chanva, Phnom Penh</td>
                            <td>False</td>
                            <td>01/10/2023</td>
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
    </div>
</body>
</html>