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
        var offset = 0, limit = 20;

        $(document).ready(async function(){
            $(".startDate").hide();
            $(".endDate").hide();

            // get student list function
            function getStudentsList(){
                const startDate = new Date($("#startDate").val());
                const endDate = new Date($("#endDate").val());
                const isBlackList = $("#filter-balck-list").find(":selected").val();

                var data = {
                    offset: offset,
                    limit: limit,
                    startDate: '',
                    endDate: '',
                    isBlackList: '',
                };
                
                if($("#filter-date-opt").find(":selected").val() == "custom"){
                    if(startDate != "Invalid Date"){
                        data.startDate = startDate.getFullYear()+'/'+(startDate.getMonth()+1)+'/'+startDate.getDate();
                        data.endDate = endDate.getFullYear()+'/'+(endDate.getMonth()+1)+'/'+endDate.getDate();
                    }
                }

                if(isBlackList == "bl"){
                    data.isBlackList = 1;
                } else if(isBlackList == "nbl"){
                    data.isBlackList = 0;
                }

                $.ajax({
                    method: "GET",
                    url: "actions/get_students.php",
                    dataType: "JSON",
                    data: data,
                    success: function(re){
                        $.each(re.data, function(i, v){
                            const dob = new Date(v.dob);
                            var row = `<tr>
                                <td>`+ v.stuId +`</td>
                                <td>`+ v.firstName + ' ' + v.lastName +`</td>
                                <td>`+ (v.gender == 0 ? 'Male' : 'Female') +`</td>
                                <td>`+ dob.getDate() + '/' + (dob.getMonth()+1) + '/' + dob.getFullYear() +`</td>
                                <td>`+ v.contact +`</td>
                                <td>`+ v.addr +`</td>
                                <td>`+ (v.isBlackList == 0 ? "False" : "True") +`</td>
                                <td>`+ v.createdDate +`</td>
                                <td>
                                    <a class='cursor-pointer' onclick="openUpdateDialog();"><i class='fas fa-pencil-alt'></i></a>
                                    <a class='cursor-pointer'><i class='fas fa-trash-alt'></i></a>
                                </td>
                            </tr>`;
                            $("#stu-list").append(row);
                        });

                        // hide load more button when no more data
                        if(!re.hasMore){
                            $("#load-more").hide();
                        }
                    },
                    error: function(_, status, msg){
                        showBottomRightMessage(status+': '+msg);
                    }
                });
            }

            // first init
            getStudentsList();

            // create create student dialog
            $("#create-dialog").dialog({
                autoOpen: false,
                modal: true,
                height: 400,
                width: 500,
                button: [{
                    text: "Close",
                    click: function() {
                        $( this ).dialog( "close" );
                    }
                }],
                classes: {
                    "ui-dialog": "highlight",
                }
            });

            // create create student dialog
            $("#update-dialog").dialog({
                autoOpen: false,
                modal: true,
                height: 400,
                width: 500,
                button: [{
                    text: "Close",
                    click: function() {
                        $( this ).dialog( "close" );
                    }
                }],
                classes: {
                    "ui-dialog": "highlight",
                }
            });

            // send data to db when user click create student button on create student dialog
            $(".createBtn").click(function(){
                // get data from input
                const firstName = $("#firstName").val();
                const lastName = $("#lastName").val();
                const contact = $("#contact").val();
                const addr = $("#addr").val();
                const gender = $("#gender").find(":selected").val();
                const dob = new Date($("#dob").val());

                // clear status
                $("#firstNameStatus").text("");
                $("#lastNameStatus").text("");
                $("#contactStatus").text("");
                $("#addrStatus").text("");
                $("#dobStatus").text("");

                // validate data
                if(firstName == ""){
                    $("#firstNameStatus").text("Please enter student first name");
                } else if(lastName == ""){
                    $("#lastNameStatus").text("Please enter student last name");
                } else if(dob == "Invalid Date"){
                    $("#dobStatus").text("Please enter student date of birth");
                } else if(contact == ""){
                    $("#contactStatus").text("Please enter student contact");
                } else if(addr == ""){
                    $("#addrStatus").text("Please enter student address");
                } else {
                    // sending data to db
                    $.ajax({
                        method: "POST",
                        url: "actions/create_student.php",
                        data: {
                            fn: firstName,
                            ln: lastName,
                            c: contact,
                            addr: addr,
                            g: gender,
                            dob: dob.getFullYear()+'/'+(dob.getMonth()+1)+'/'+dob.getDate(),
                        },
                        dataType: "json",
                        success: function(data) {
                            // get message text by status
                            if(data.status == 1){
                                showBottomRightMessage("Created new student! ID: "+ data.data, 1);

                                // close create student dialog
                                $("#create-dialog").dialog("close");

                                const now = new Date();
                                // add new student to the list
                                var row = `<tr>
                                    <td>`+ data.data +`</td>
                                    <td>`+ firstName + ' ' + lastName +`</td>
                                    <td>`+ (gender == 0 ? 'Male' : 'Female') +`</td>
                                    <td>`+ dob.getDate() + '/' + (dob.getMonth()+1) + '/' + dob.getFullYear() +`</td>
                                    <td>`+ contact +`</td>
                                    <td>`+ addr +`</td>
                                    <td>False</td>
                                    <td>`+ now.getDate() + '/' + (now.getMonth()+1) + '/' + now.getFullYear() +`</td>
                                    <td>
                                        <a class='cursor-pointer' onclick="openUpdateDialog();"><i class='fas fa-pencil-alt'></i></a>
                                        <a class='cursor-pointer'><i class='fas fa-trash-alt'></i></a>
                                    </td>
                                </tr>`;
                                $("#stu-list").prepend(row);
                            } else {
                                showBottomRightMessage(data.data, 0);
                            }
                        },
                        error: function(_, status, msg){
                            showBottomRightMessage(status+': '+msg, 2);
                        }
                    });
                }
            });

            // when user click load more
            $("#load-more").click(function() {
                offset += limit;
                
                // get more student
                getStudentsList();
            });

            // when user change filter date options
            $("#filter-date-opt").change(function(){
                if($(this).val() == "custom"){
                    $(".startDate").show();
                    $(".endDate").show();
                } else {
                    $(".startDate").hide();
                    $(".endDate").hide();
                }
                $("#stu-list").html("");
                getStudentsList();
            });

            // when user change filter start date
            $("#startDate").change(function(){
                if($(this).val() < $("#endDate").val()){
                    $("#stu-list").html("");
                    getStudentsList();
                }
            });

            // when user change filter end date
            $("#endDate").change(function(){
                if($(this).val() > $("#startDate").val()){
                    $("#stu-list").html("");
                    getStudentsList();
                }
            });

            // when user change filter black list
            $("#filter-balck-list").change(function(){
                $("#stu-list").html("");
                getStudentsList();
            });
        });

        function openUpdateDialog(){
            $("#update-dialog").dialog('open');
        }
    </script>
</head>
<body>
    <div class="wrapper padding-20">
        <div class="row space-between">
            <!-- <ul class="tabbar">
                <li class="tabbar-item tabbar-item-active">Students</li>
                <li class="tabbar-item">Users</li>
            </ul> -->
            <div class="row gap10 content-top">
                <!-- <a class="add-new-btn" onclick="$('#filter-dialog').dialog('open');"><i class="fas fa-filter white"></i>&nbsp;&nbsp;Filter</a> -->
                <div class="col w100">
                    <label for="filter-date-opt">Date</label><br>
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
                <div class="col w130">
                    <label for="filter-balck-list">Black List</label><br>
                    <div class="filter-box">
                        <select class="w100per" name="filter-balck-list" id="filter-balck-list">
                            <option value="all">All</option>
                            <option value="bl">Black list</option>
                            <option value="nbl">Not black list</option>
                        </select>
                        <i class="fas fa-caret-down"></i>
                    </div>
                </div>
            </div>
            <div class="row gap10">
                <!-- <a class="add-new-btn" href="#"><div class="row white"><i class="fas fa-file-export white"></i>&nbsp;&nbsp;Export to Excel</div></a> -->
                <a class="add-new-btn" onclick="$('#create-dialog').dialog('open');"><i class="fad fa-user-plus white"></i>&nbsp;&nbsp;Add New</a>
            </div>
        </div><br>
        <div class="wrapper padding-20 back-white radius-all20 shadow-gray">
            <!-- <div class="row space-between">
                <div class="stu-list-title">Students</div>
                <div class="list-options row gap10">
                    <a href="#"><i class="fas fa-file-export"></i>&nbsp;&nbsp;Export</a>
                    <a onclick="$('#filter-dialog').dialog('open');"><i class="fas fa-filter"></i>&nbsp;&nbsp;Filter</a>
                </div>
            </div> -->
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
                    <tbody id="stu-list"></tbody>
                </table>
            </div><br>
            <a id="load-more" class="row content-center primary-color load-more cursor-pointer">
                <i class="fas fa-chevron-down primary-color"></i>&nbsp;&nbsp;Load More
            </a>
        </div>
    </div>
    <!-- <div id="filter-dialog" title="Filters">
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
    </div> -->
    <div id="create-dialog" title="New Student">
        <div class="row gap25">
            <div class="col w100per">
                <label for="firstName">First Name</label><br>
                <input class="w100per" type="text" name="firstName" id="firstName" placeholder="First Name">
                <div id="firstNameStatus" class="input-error-status"></div>
            </div>
            <div class="col w100per">
                <label for="gender">Gender</label><br>
                <div class="filter-box w100per">
                    <select class="w100per" name="gender" id="gender">
                        <option value="0">Male</option>
                        <option value="1">Female</option>
                    </select>
                    <i class="fas fa-caret-down"></i>
                </div>
            </div>
        </div>
        <div class="row gap25">
            <div class="col w100per">
                <label for="lastName">Last Name</label><br>
                <input class="w100per" type="text" name="lastName" id="lastName" placeholder="Last Name">
                <div id="lastNameStatus" class="input-error-status"></div>
            </div>
            <div class="col w100per">
                <label for="dob">Date of Birth</label><br>
                <input class="w100per" type="date" name="dob" id="dob">
                <div id="dobStatus" class="input-error-status"></div>
            </div>
        </div>
        <div class="row gap25">
            <div class="col w100per">
                <label for="contact">Contact</label><br>
                <input class="w100per" type="text" name="contact" id="contact" placeholder="Contact">
                <div id="contactStatus" class="input-error-status"></div>
            </div>
            <div class="col w100per">
                <label for="addr">Address</label><br>
                <input class="w100per" type="address" name="addr" id="addr" placeholder="Address">
                <div id="addrStatus" class="input-error-status"></div>
            </div>
        </div><br>
        <div class="row content-right">
            <button class="closeBtn" onclick="$('#create-dialog').dialog('close');">Close</button>&nbsp;&nbsp;&nbsp;
            <input class="createBtn" type="submit" value="Register">
        </div>
    </div>
    <div id="update-dialog" title="Update Student">
        <div class="row gap25">
            <div class="col w100per">
                <label for="ufirstName">First Name</label><br>
                <input class="w100per" type="text" name="ufirstName" id="ufirstName" placeholder="First Name">
                <div id="firstNameStatus" class="input-error-status"></div>
            </div>
            <div class="col w100per">
                <label for="ugender">Gender</label><br>
                <div class="filter-box w100per">
                    <select class="w100per" name="ugender" id="ugender">
                        <option value="0">Male</option>
                        <option value="1">Female</option>
                    </select>
                    <i class="fas fa-caret-down"></i>
                </div>
            </div>
        </div>
        <div class="row gap25">
            <div class="col w100per">
                <label for="ulastName">Last Name</label><br>
                <input class="w100per" type="text" name="ulastName" id="ulastName" placeholder="Last Name">
                <div id="lastNameStatus" class="input-error-status"></div>
            </div>
            <div class="col w100per">
                <label for="udob">Date of Birth</label><br>
                <input class="w100per" type="udate" name="udob" id="udob">
                <div id="dobStatus" class="input-error-status"></div>
            </div>
        </div>
        <div class="row gap25">
            <div class="col w100per">
                <label for="ucontact">Contact</label><br>
                <input class="w100per" type="text" name="ucontact" id="ucontact" placeholder="Contact">
                <div id="contactStatus" class="input-error-status"></div>
            </div>
            <div class="col w100per">
                <label for="uaddr">Address</label><br>
                <input class="w100per" type="address" name="uaddr" id="uaddr" placeholder="Address">
                <div id="addrStatus" class="input-error-status"></div>
            </div>
        </div><br>
        <div class="row content-right">
            <button class="closeBtn" onclick="$('#update-dialog').dialog('close');">Close</button>&nbsp;&nbsp;&nbsp;
            <input class="createBtn" type="submit" value="Register">
        </div>
    </div>
    <div class="message-bottom-right">Message</div>
</body>
</html>