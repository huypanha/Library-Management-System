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
        var offset = 0, limit = 20, searchKey = '';
        var roleIds = [], roleTitles = [];

        // get users list function
        function getUsersList(){
            const startDate = new Date($("#startDate").val());
            const endDate = new Date($("#endDate").val());
            const isBlackList = $("#filter-balck-list").find(":selected").val();

            var data = {
                offset: offset,
                limit: limit,
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

            if(searchKey != ''){
                data.searchKey = searchKey;
            }

            $.ajax({
                method: "GET",
                url: "actions/get_users.php",
                dataType: "JSON",
                data: data,
                success: function(re){
                    if(re.status == 1){
                        var reCount = 0;
                        $.each(re.data, function(i, v){
                            const cDate = new Date(v.createdDate);
                            var row = `<tr>
                                <td>`+v.id+`</td>
                                <td>
                                    <div class="row gap10 gray">
                                        <div class="profile">
                                            <img  src="../upload/user/`+v.profile+`" alt="profile">
                                        </div>
                                        `+v.username+`
                                    </div>
                                </td>
                                <td>`+(v.gender == 0 ? "Male" : "Female")+`</td>
                                <td>`+v.phone+`</td>
                                <td>`+v.email+`</td>
                                <td>`+v.addr+`</td>
                                <td>`+v.roleTitle+`</td>
                                <td>`+cDate.getDate()+`/`+(cDate.getMonth()+1)+`/`+cDate.getFullYear()+`</td>
                                <td>
                                    <a class='cursor-pointer' onclick="openUpdateDialog('`+v.id+`','`+v.username+`','`+v.gender+`','`+v.phone+`','`+v.email+`','`+v.roleTitle+`','`+v.addr+`','`+v.profile+`');"><i class='fas fa-pencil-alt'></i></a>
                                    <a class='cursor-pointer' onclick="deleteUser(`+ data.data +`)"><i class='fas fa-trash-alt'></i></a>
                                </td>
                            </tr>`;
                            $("#user-list").append(row);
                            reCount = reCount + 1;
                        });

                        if(reCount > 0){
                            $("#no-result").hide();
                            $("#data-table").show();
                            // hide load more button when no more data
                            if(!re.hasMore){
                                $("#load-more").hide();
                            } else {
                                $("#load-more").show();
                            }
                        } else {
                            $("#data-table").hide();
                            $("#no-result").show();
                        }
                    } else {
                        showBottomRightMessage(re.data);
                    }
                },
                error: function(_, status, msg){
                    showBottomRightMessage(status+': '+msg);
                }
            });
        }

        function getAllUserRoles(listId){
            // clear old list
            $(listId).html("");

            $.ajax({
                method: "GET",
                url: "actions/get_user_roles.php",
                dataType: "JSON",
                data: {},
                success: function(re){
                    if(re.status == 1){
                        $.each(re.data, function(i, v){
                            $(listId).append("<option value='"+v.title+"'></option>");
                            roleIds.push(v.id);
                            roleTitles.push(v.title);
                        });
                    } else {
                        showBottomRightMessage(re.data);
                    }
                },
                error: function(_, status, msg){
                    showBottomRightMessage(status+': '+msg);
                }
            });
        }

        function openCreateDialog() {
            // get all roles
            getAllUserRoles("#roleDataList");

            // set default user roles
            $("#role").val("Librarian");

            // open create dialog
            $("#create-dialog").dialog('open');
        }

        function openUpdateDialog(id, username, gender, phone, email, roleTitle, addr, profile){
            // send existing value to input
            $("#id").val(id);
            $("#uusername").val(username);
            $("#uphone").val(phone);
            $("#uemail").val(email);
            $("#ugender").val(gender);
            $("#urole").val(roleTitle);
            $("#uaddr").val(addr);
            $("#uprofile-pre").prop('scr', '../uploads/user/'+profile);

            // get all role list
            getAllUserRoles("#uroleDataList");

            // show update dialog
            $("#update-dialog").dialog('open');
        }

        function deleteUser(stuId){
            if(confirm("Are you sure want to delete user #"+stuId+" ?")){
                $.ajax({
                    method: "POST",
                    url: "actions/delete_user.php",
                    data: {
                        "stuId": stuId,
                    },
                    dataType: "JSON",
                    success: function(data){
                        if(data.status == 1){
                            // show status message
                            showBottomRightMessage(data.data, 1);

                            // reload list
                            $("#stu-list").html("");
                            getUsersList();
                        }
                    },
                    error: function(_, status, msg){
                        showBottomRightMessage(status+': '+msg, 2);
                    }
                });
            }
        }

        $(document).ready(async function(){
            $(".startDate").hide();
            $(".endDate").hide();
            $("#create-dialog").hide();
            $("#update-dialog").hide();

            // create create user dialog
            $("#create-dialog").dialog({
                autoOpen: false,
                modal: true,
                width: 700,
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

            // create create user dialog
            $("#update-dialog").dialog({
                autoOpen: false,
                modal: true,
                width: 700,
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

            // send data to db when user click create user button on create user dialog
            $(".createBtn").click(function(){
                // get data from input
                var username = $("#username").val();
                var pass = $("#pass").val();
                var phone = $("#phone").val();
                var email = $("#email").val();
                var gender = $("#gender").find(":selected").val();
                var role = $("#role").val();
                var addr = $("#addr").val();
                var profile = $("#profile").prop('files');

                // clear status
                $("#profileStatus").text("");
                $("#usernameStatus").text("");
                $("#passStatus").text("");
                $("#phoneStatus").text("");
                $("#emailStatus").text("");
                $("#roleStatus").text("");
                $("#addrStatus").text("");

                // validate data
                if(username == ""){
                    $("#usernameStatus").text("Please enter username");
                } else if(pass == "" || pass.length < 6){
                    $("#passStatus").text("Please enter password at least 6 characters");
                } else if(phone == ""){
                    $("#phoneStatus").text("Please enter phone number");
                } else if(email == ""){
                    $("#emailStatus").text("Please enter email address");
                } else if(addr == ""){
                    $("#addrStatus").text("Please enter user address");
                } else if(role == ""){
                    $("#roleStatus").text("Please select a role");
                } else if(!profile[0]){
                    $("#profileStatus").text("Please choose a profile");
                } else {
                    // create a form data to send image to php
                    var formData = new FormData();
                    formData.append('img', profile[0]);
                    formData.append('username', username);
                    formData.append('pass', pass);
                    formData.append('email', email);
                    formData.append('phone', phone);
                    formData.append('gender', gender);
                    formData.append('roleId', roleIds[roleTitles.indexOf(role)]);
                    formData.append('addr', addr);

                    // sending data to db
                    $.ajax({
                        method: "POST",
                        url: "actions/create_user.php",
                        data: formData,
                        dataType: "JSON",
                        processData: false,
                        cache: false,
                        contentType: false,
                        success: function(data) {
                            // get message text by status
                            if(data.status == 1){
                                showBottomRightMessage("Created new user! ID: "+ data.data.newId, 1);

                                // close create user dialog
                                $("#create-dialog").dialog("close");

                                const now = new Date();
                                // add new user to the list
                                var row = `<tr>
                                    <td>`+data.data.newId+`</td>
                                    <td>
                                        <div class="row gap10 gray">
                                            <div class="profile">
                                                <img  src="../upload/user/`+data.data.profileImg+`" alt="profile">
                                            </div>
                                            `+username+`
                                        </div>
                                    </td>
                                    <td>`+(gender == 0 ? "Male" : "Female")+`</td>
                                    <td>`+phone+`</td>
                                    <td>`+email+`</td>
                                    <td>`+addr+`</td>
                                    <td>`+role+`</td>
                                    <td>`+now.getDate()+`/`+(now.getMonth()+1)+`/`+now.getFullYear()+`</td>
                                    <td>
                                        <a class='cursor-pointer' onclick=""><i class='fas fa-pencil-alt'></i></a>
                                        <a class='cursor-pointer' onclick="deleteUser(`+ data.data.newId +`)"><i class='fas fa-trash-alt'></i></a>
                                    </td>
                                </tr>`;
                                $("#user-list").prepend(row);
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
                
                // get more user
                getUsersList();
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
                getUsersList();
            });

            // when user change filter start date
            $("#startDate").change(function(){
                if($(this).val() < $("#endDate").val()){
                    $("#stu-list").html("");
                    getUsersList();
                }
            });

            // when user change filter end date
            $("#endDate").change(function(){
                if($(this).val() > $("#startDate").val()){
                    $("#stu-list").html("");
                    getUsersList();
                }
            });

            // when user change filter black list
            $("#filter-balck-list").change(function(){
                $("#stu-list").html("");
                getUsersList();
            });

            // when user click update button on update user dialog
            $(".updateBtn").click(function(){
                // get data from input
                var stuId = $("#uStuId").val();
                var firstName = $("#ufirstName").val();
                var lastName = $("#ulastName").val();
                var contact = $("#ucontact").val();
                var addr = $("#uaddr").val();
                var gender = $("#ugender").find(":selected").val();
                var dob = new Date($("#udob").val());
                var isBlackList = $("#uBlackList").is(":checked") ? 1 : 0;

                // clear status
                $("#ufirstNameStatus").text("");
                $("#ulastNameStatus").text("");
                $("#ucontactStatus").text("");
                $("#uaddrStatus").text("");
                $("#udobStatus").text("");

                // validate data
                if(firstName == ""){
                    $("#ufirstNameStatus").text("Please enter user first name");
                } else if(lastName == ""){
                    $("#ulastNameStatus").text("Please enter user last name");
                } else if(dob == "Invalid Date"){
                    $("#udobStatus").text("Please enter user date of birth");
                } else if(contact == ""){
                    $("#ucontactStatus").text("Please enter user contact");
                } else if(addr == ""){
                    $("#uaddrStatus").text("Please enter user address");
                } else {
                    // sending data to db
                    $.ajax({
                        method: "POST",
                        url: "actions/update_user.php",
                        data: {
                            stuId: stuId,
                            fn: firstName,
                            ln: lastName,
                            c: contact,
                            addr: addr,
                            g: gender,
                            dob: dob.getFullYear()+'/'+(dob.getMonth()+1)+'/'+dob.getDate(),
                            isBlackList: isBlackList,
                        },
                        dataType: "json",
                        success: function(data) {
                            // get message text by status
                            if(data.status == 1){
                                showBottomRightMessage(data.data, 1);

                                // close create user dialog
                                $("#update-dialog").dialog("close");

                                // reload list
                                $("#stu-list").html("");
                                getUsersList();
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
        });
    </script>
</head>
<body>
    <div class="wrapper padding-20">
        <div class="row space-between">
            <div class="row gap10 content-top">
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
                <a class="add-new-btn" onclick="openCreateDialog();"><i class="fad fa-user-plus white"></i>&nbsp;&nbsp;Add New</a>
            </div>
        </div><br>
        <div class="wrapper padding-20 back-white radius-all20 shadow-gray">
            <div class="row scroll-x">
                <table id="data-table">
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Role</th>
                        <th>Join Date</th>
                        <th>Actions</th>
                    </tr>
                    <tbody id="user-list"></tbody>
                </table>
                <div id="no-result" class="center w100per">
                    <dotlottie-player src="https://lottie.host/368474bf-84db-4d4a-bbd2-65219928b446/3jKzzZOp3j.json" background="transparent" speed="1" style="width: 300px; height: 300px; margin-left: 38%;" loop autoplay></dotlottie-player>
                    <p class="gray">No Result</p>
                </div>
            </div><br>
            <a id="load-more" class="row content-center primary-color load-more cursor-pointer">
                <i class="fas fa-chevron-down primary-color"></i>&nbsp;&nbsp;Load More
            </a>
        </div>
    </div>
    <!-- create dialog -->
    <div class="dialog" id="create-dialog" title="New User">
        <div class="row content-center">
            <label for="profile" class="center">
                <div class="profile-100 cursor-pointer">
                    <img id="profile-pre" src="../upload/user/SNOW_20230709_103003_332.jpg" alt="profile">
                </div>
                <div id="profileStatus" class="input-error-status"></div>
            </label>
            <input accept="image/*" type="file" name="profile" id="profile" onchange="$('#profile-pre').prop('src',window.URL.createObjectURL(this.files[0]));">
        </div>
        <div class="row gap25">
            <div class="col w100per">
                <label for="username">Username</label><br>
                <input class="w100per" type="text" name="username" id="username" placeholder="User Name">
                <div id="usernameStatus" class="input-error-status"></div>
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
                <label for="pass">Password</label><br>
                <input class="w100per" type="password" name="pass" id="pass" placeholder="Password">
                <div id="passStatus" class="input-error-status"></div>
            </div>
            <div class="col w100per">
                <label for="phone">Phone</label><br>
                <input class="w100per" type="text" name="phone" id="phone" placeholder="012345678">
                <div id="phoneStatus" class="input-error-status"></div>
            </div>
        </div>
        <div class="row gap25">
            <div class="col w100per">
                <label for="email">Email</label><br>
                <input class="w100per" type="email" name="email" id="email" placeholder="panha@gmail.com">
                <div id="emailStatus" class="input-error-status"></div>
            </div>
            <div class="col w100per">
                <label for="role">Role</label><br>
                <input id="role" class="w100per" autocomplete="on" list="roleDataList" placeholder="Admin">
                <div id="roleStatus" class="input-error-status"></div>
                <datalist id="roleDataList"></datalist>
            </div>
        </div>
        <div class="row gap25">
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
    <!-- update dialog -->
    <div class="dialog" id="update-dialog" title="New User">
        <input type="hidden" name="id" id="id">
        <div class="row content-center">
            <label for="uprofile" class="center">
                <div class="profile-100 cursor-pointer">
                    <img id="uprofile-pre" src="../upload/user/SNOW_20230709_103003_332.jpg" alt="profile">
                </div>
                <div id="uprofileStatus" class="input-error-status"></div>
            </label>
            <input accept="image/*" type="file" name="uprofile" id="uprofile" onchange="$('#uprofile-pre').prop('src',window.URL.createObjectURL(this.files[0]));">
        </div>
        <div class="row gap25">
            <div class="col w100per">
                <label for="uusername">Username</label><br>
                <input class="w100per" type="text" name="uusername" id="uusername" placeholder="User Name">
                <div id="uusernameStatus" class="input-error-status"></div>
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
                <label for="upass">Password</label><br>
                <input class="w100per" type="password" name="upass" id="upass" placeholder="Password">
                <div id="upassStatus" class="input-error-status"></div>
            </div>
            <div class="col w100per">
                <label for="uphone">Phone</label><br>
                <input class="w100per" type="text" name="uphone" id="uphone" placeholder="012345678">
                <div id="uphoneStatus" class="input-error-status"></div>
            </div>
        </div>
        <div class="row gap25">
            <div class="col w100per">
                <label for="uemail">Email</label><br>
                <input class="w100per" type="email" name="uemail" id="uemail" placeholder="panha@gmail.com">
                <div id="uemailStatus" class="input-error-status"></div>
            </div>
            <div class="col w100per">
                <label for="urole">Role</label><br>
                <input id="urole" class="w100per" autocomplete="on" list="uroleDataList" placeholder="Admin">
                <div id="uroleStatus" class="input-error-status"></div>
                <datalist id="uroleDataList"></datalist>
            </div>
        </div>
        <div class="row gap25">
            <div class="col w100per">
                <label for="uaddr">Address</label><br>
                <input class="w100per" type="address" name="uaddr" id="uaddr" placeholder="Address">
                <div id="uaddrStatus" class="input-error-status"></div>
            </div>
        </div><br>
        <div class="row content-right">
            <button class="closeBtn" onclick="$('#update-dialog').dialog('close');">Close</button>&nbsp;&nbsp;&nbsp;
            <input class="updateBtn" type="submit" value="Update">
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
            getUsersList();
        </script>";
    } else {
        echo "<script>getUsersList();</script>";
    }
?>