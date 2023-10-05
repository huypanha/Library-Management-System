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
            $("#create-dialog").dialog({
                autoOpen: false,
                modal: true,
                height: 400,
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

            $("#filter-dialog").dialog({
                autoOpen: false,
                modal: true,
                height: 350,
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
        });
    </script>
</head>
<body>
    <div class="wrapper padding-20">
        <div class="row space-between">
            <ul class="tabbar">
                <li class="tabbar-item tabbar-item-active">Students</li>
                <li class="tabbar-item">Users</li>
            </ul>
            <a class="add-new-btn" onclick="$('#create-dialog').dialog('open');"><i class="fad fa-user-plus white"></i>&nbsp;&nbsp;Add New</a>
        </div><br>
        <div class="wrapper padding-20 back-white radius-all20 shadow-gray">
            <div class="row space-between">
                <div class="stu-list-title">Students</div>
                <div class="list-options row gap10">
                    <a href="#"><i class="fas fa-file-export"></i>&nbsp;&nbsp;Export</a>
                    <a onclick="$('#filter-dialog').dialog('open');"><i class="fas fa-filter"></i>&nbsp;&nbsp;Filter</a>
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
    <div id="filter-dialog" title="Filters">
        <div class="row gap25">
            <div class="col w100per">
                <label for="sratDate">Start Date</label><br>
                <input class="w100per" type="date" name="sratDate" id="sratDate">
            </div>
            <div class="col w100per">
                <label for="endDate">End Date</label><br>
                <input class="w100per" type="date" name="endDate" id="endDate">
            </div>
        </div>
        <label for="black-list">Black List : </label><br><br>
        <input type="radio" name="blacklist-opt" id="opt1" checked>&nbsp;&nbsp;
        <label for="blacklist-all">All</label>&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" name="blacklist-opt" id="opt2">&nbsp;&nbsp;
        <label for="blacklist-only">Black List</label>&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" name="blacklist-opt" id="opt3">&nbsp;&nbsp;
        <label for="not-blacklist">Not Black List</label><br><br>
        <div class="row content-right">
            <button class="btn" onclick="$('#filter-dialog').dialog('close');">Close</button>&nbsp;&nbsp;&nbsp;
            <button class="btn" onclick="$('#filter-dialog').dialog('close');">Reset</button>&nbsp;&nbsp;&nbsp;
            <input class="primary-btn" type="submit" value="Filter">
        </div>
    </div>
    <div id="create-dialog" title="New Student">
        <form action="" method="post">
            <div class="row gap25">
                <div class="col w100per">
                    <label for="firstName">First Name</label><br>
                    <input class="w100per" type="text" name="firstName" id="firstName" placeholder="First Name" required>
                </div>
                <div class="col w100per">
                    <label for="gender">Gender</label><br>
                    <div class="filter-box w100per">
                        <select class="w100per" name="gender" id="gender">
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                        </select>
                        <i class="fas fa-caret-down"></i>
                    </div>
                </div>
            </div>
            <div class="row gap25">
                <div class="col w100per">
                    <label for="lastName">Last Name</label><br>
                    <input class="w100per" type="text" name="lastName" id="lastName" placeholder="Last Name" required>
                </div>
                <div class="col w100per">
                    <label for="dob">Date of Birth</label><br>
                    <input class="w100per" type="date" name="dob" id="dob">
                </div>
            </div>
            <div class="row gap25">
                <div class="col w100per">
                    <label for="contact">Contact</label><br>
                    <input class="w100per" type="text" name="contact" id="contact" placeholder="Contact" required>
                </div>
                <div class="col w100per">
                    <label for="addr">Address</label><br>
                    <input class="w100per" type="a" name="addr" id="addr" placeholder="Address" required>
                </div>
            </div><br>
            <div class="row content-right">
                <button class="closeBtn" onclick="$('#create-dialog').dialog('close');">Close</button>&nbsp;&nbsp;&nbsp;
                <input class="createBtn" type="submit" value="Register">
            </div>
        </form>
    </div>
</body>
</html>