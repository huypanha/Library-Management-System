<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/fontawesomepro.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/fontawesomepro.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../js/script.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $(".loading-animation").hide();

            $("#sendBtn").click(function(){
                // clear error status
                $("#descStatus").text("");

                // validate data
                if($("#desc").val() == ""){
                    $("#descStatus").text("Please enter description");
                } else if($("#desc").val().length < 50){
                    $("#descStatus").text("Please enter description at least 50 characters");
                } else {
                    // hide btn and show loading
                    $(this).hide();
                    $(".loading-animation").show();

                    // create form data to send
                    var data = new FormData();
                    data.append("desc", $("#desc").val());
                    data.append("type", $("#type").val());

                    // if user choose img
                    if($("#img1").prop("files")[0]){
                        data.append("img1", $("#img1").prop("files")[0]);
                    }

                    if($("#img2").prop("files")[0]){
                        data.append("img2", $("#img2").prop("files")[0]);
                    }

                    if($("#img3").prop("files")[0]){
                        data.append("img3", $("#img3").prop("files")[0]);
                    }

                    // send email
                    $.ajax({
                        method: "POST",
                        url: "../auth/send_report.php",
                        data: data,
                        dataType: "JSON",
                        processData: false,
                        contentType: false,
                        cache: false,
                        success: function (data) {
                            // hide loading and show btn
                            $("#sendBtn").show();
                            $(".loading-animation").hide();

                            // show success message
                            showBottomRightMessage(data.data, data.status);
                        },
                        error: function (_, status, msg) {
                            // hide loading and show btn
                            $("#sendBtn").show();
                            $(".loading-animation").hide();
                            showBottomRightMessage(msg);
                        }
                    });
                }
            });
        });
    </script>
</head>
<body>
    <div class="wrapper padding-20 back-white radius-all20 shadow-gray w100per h95vh scroll-y">
        <h2>Report & Feedback</h2><br>
        <div class="row gap50 content-top">
            <div class="col w100per">
                <label for="type">Type</label><br>
                <div class="h10"></div>
                <div class="filter-box w100per input-back-gray">
                    <select class="w100per size-15" name="type" id="type">
                        <option value="0">Feedback</option>
                        <option value="1">Report</option>
                    </select>
                    <i class="fas fa-caret-down"></i>
                </div>
                <div class="h20"></div>
                <label class="row">Attachments&nbsp;&nbsp;<div class="gray">(Optional)</div></label>
                <div class="h10"></div>
                <div class="row gap10">
                    <label class="w100per" for="img1">
                        <div id="choose-img-pre-box-1" class="choose-img-pre-box cursor-pointer">
                            <img id="img-1" class="w100per" src="../media/Plus.png" alt="img">
                        </div>
                    </label>
                    <input type="file" name="img1" id="img1" onchange="document.getElementById('img-1').src = window.URL.createObjectURL(this.files[0]);">
                    <label class="w100per" for="img2">
                        <div id="choose-img-pre-box-2" class="choose-img-pre-box cursor-pointer">
                            <img id="img-2" class="w100per" src="../media/Plus.png" alt="img">
                        </div>
                    </label>
                    <input type="file" name="img2" id="img2" onchange="document.getElementById('img-2').src = window.URL.createObjectURL(this.files[0]);">
                    <label class="w100per" for="img3">
                        <div id="choose-img-pre-box-3" class="choose-img-pre-box cursor-pointer">
                            <img id="img-3" class="w100per" src="../media/Plus.png" alt="img">
                        </div>
                    </label>
                    <input type="file" name="img3" id="img3" onchange="document.getElementById('img-3').src = window.URL.createObjectURL(this.files[0]);">
                </div>
            </div>
            <div class="col w100per">
                <label for="desc">Description</label><br>
                <div class="h10"></div>
                <textarea class="w100per" name="desc" id="desc" rows="10" placeholder="Tell us what are you thinking?"></textarea>
                <div id="descStatus" class="input-error-status"></div>
            </div>
        </div><br>
        <div class="row content-right">
            <div id="sendBtn" class="primary-btn row gap10">
                <i class="fad fa-paper-plane white"></i> Send
            </div>
            <a class="loading-animation"></a>
        </div>
        <div class="h100"></div>
    </div>
    <!-- message -->
    <div class="message-wrapper">
        <div class="message-bottom-right">Message</div>
    </div>
</body>
</html>