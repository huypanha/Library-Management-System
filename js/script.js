$(document).ready(function(){
    // on click admin dashboard menu
    $(".menu-item").click(function(){
        const oldSelectedMenuIndex = $(".nav-menu-active").index();
        const navMenuCount = $(".nav-menu").children().length;
        var newChild = "", newPage = "", newPageTitle = "";

        // remove active menu
        for(var i = 0; i < navMenuCount; i++){
            $(".menu-item").eq(i).removeClass("nav-menu-active");
        }

        // get image for old active menu
        if(oldSelectedMenuIndex == 0){
            newChild = "<img src='media/dashboard_outline.jpg' alt='menu icon'>";
        } else if(oldSelectedMenuIndex == 1){
            newChild = "<i class='far fa-user-graduate size-25 gray'></i>";
        } else if(oldSelectedMenuIndex == 2){
            newChild = "<i class='far fa-books size-25 gray'></i>";
        } else if(oldSelectedMenuIndex == 3){
            newChild = "<i class='far fa-book-reader size-25 gray'></i>";
        } else if(oldSelectedMenuIndex == 4){
            newChild = "<i class='far fa-users size-25 gray'></i>";
        } else if(oldSelectedMenuIndex == 5){
            newChild = "<i class='far fa-cog size-25 gray'></i>";
        }

        // change old active menu image
        $(".menu-item").eq(oldSelectedMenuIndex).html(newChild);

        // get image to change for new active menu
        if($(this).index() == 0){
            newChild = "<img src='media/dashboard_filled.png' alt='menu icon'>";
            newPage = "<iframe id='current-page' src='src/dashboard.php' frameborder='0'></iframe>";
            newPageTitle = "Dashboard";
        } else if($(this).index() == 1){
            newChild = "<i class='fad fa-user-graduate size-25 white'></i>";
            newPage = "<iframe id='current-page' src='src/students.php' frameborder='0'></iframe>";
            newPageTitle = "Students";
        } else if($(this).index() == 2){
            newChild = "<i class='fad fa-books size-25 white'></i>";
            newPage = "<iframe id='current-page' src='src/books.php' frameborder='0'></iframe>";
            newPageTitle = "Books";
        } else if($(this).index() == 3){
            newChild = "<i class='fad fa-book-reader size-25 white'></i>";
            newPage = "<iframe id='current-page' src='src/borrows.php' frameborder='0'></iframe>";
            newPageTitle = "Borrows";
        } else if($(this).index() == 4){
            newChild = "<i class='fad fa-users size-25 white'></i>";
            newPage = "<iframe id='current-page' src='src/users.php' frameborder='0'></iframe>";
            newPageTitle = "Users";
        } else if($(this).index() == 5){
            newChild = "<i class='fad fa-cog size-25 white' style='--fa-primary-opacity: 0.4; --fa-secondary-opacity: 1;'></i>";
            newPage = "<iframe id='current-page' src='src/settings.php' frameborder='0'></iframe>";
            newPageTitle = "Settings";
        }

        // change new active menu image
        $(".menu-item").eq($(this).index()).html(newChild);

        // change new page
        $("#current-page-content").html(newPage);

        // change new page title
        $("#page-title").html(newPageTitle);

        // chagne new active menu
        $(".menu-item").eq($(this).index()).addClass("nav-menu-active");
    });

    // on click dashboard menu
    $(".lib-menu-item").click(function(){
        const oldSelectedMenuIndex = $(".nav-menu-active").index();
        const navMenuCount = $(".nav-menu").children().length;
        var newChild = "", newPage = "", newPageTitle = "";

        // remove active menu
        for(var i = 0; i < navMenuCount; i++){
            $(".lib-menu-item").eq(i).removeClass("nav-menu-active");
        }

        // get image for old active menu
        if(oldSelectedMenuIndex == 0){
            newChild = "<img src='media/dashboard_outline.jpg' alt='menu icon'>";
        } else if(oldSelectedMenuIndex == 1){
            newChild = "<i class='far fa-user-graduate size-25 gray'></i>";
        } else if(oldSelectedMenuIndex == 2){
            newChild = "<i class='far fa-books size-25 gray'></i>";
        } else if(oldSelectedMenuIndex == 3){
            newChild = "<i class='far fa-book-reader size-25 gray'></i>";
        } else if(oldSelectedMenuIndex == 4){
            newChild = "<i class='far fa-cog size-25 gray'></i>";
        }

        // change old active menu image
        $(".lib-menu-item").eq(oldSelectedMenuIndex).html(newChild);

        // get image to change for new active menu
        if($(this).index() == 0){
            newChild = "<img src='media/dashboard_filled.png' alt='menu icon'>";
            newPage = "<iframe id='current-page' src='src/dashboard.php' frameborder='0'></iframe>";
            newPageTitle = "Dashboard";
        } else if($(this).index() == 1){
            newChild = "<i class='fad fa-user-graduate size-25 white'></i>";
            newPage = "<iframe id='current-page' src='src/students.php' frameborder='0'></iframe>";
            newPageTitle = "Students";
        } else if($(this).index() == 2){
            newChild = "<i class='fad fa-books size-25 white'></i>";
            newPage = "<iframe id='current-page' src='src/books.php' frameborder='0'></iframe>";
            newPageTitle = "Books";
        } else if($(this).index() == 3){
            newChild = "<i class='fad fa-book-reader size-25 white'></i>";
            newPage = "<iframe id='current-page' src='src/borrows.php' frameborder='0'></iframe>";
            newPageTitle = "Borrows";
        } else if($(this).index() == 4){
            newChild = "<i class='fad fa-cog size-25 white' style='--fa-primary-opacity: 0.4; --fa-secondary-opacity: 1;'></i>";
            newPage = "<iframe id='current-page' src='src/settings.php' frameborder='0'></iframe>";
            newPageTitle = "Settings";
        }

        // change new active menu image
        $(".lib-menu-item").eq($(this).index()).html(newChild);

        // change new page
        $("#current-page-content").html(newPage);

        // change new page title
        $("#page-title").html(newPageTitle);

        // chagne new active menu
        $(".lib-menu-item").eq($(this).index()).addClass("nav-menu-active");
    });

    // on click tabbar
    $(".tabbar-item").click(function(){
        for(var i = 0; i < $(".tabbar").children.length; i++){
            $(".tabbar-item").eq(i).removeClass("tabbar-item-active");
        }
        $(".tabbar-item").eq($(this).index()).addClass("tabbar-item-active");
    });
});

// message: The message to show on the message box
// autoClose: if true, this message will auto hide after the interval
// interval: The duration of the message to show on the screen
// messageType: The type of message to show
//      0: for error message (default)
//      1: for success message
//      2: for warning message
function showBottomRightMessage(message, messageType = 0, autoClose = true, interval = 10000){
    // set message box style
    if(messageType == 1){
        $(".message-bottom-right").removeClass("error-message");
        $(".message-bottom-right").removeClass("warning-message");
        $(".message-bottom-right").addClass("success-message");
    } else if(messageType == 2){
        $(".message-bottom-right").removeClass("success-message");
        $(".message-bottom-right").removeClass("error-message");
        $(".message-bottom-right").addClass("warning-message");
    } else {
        $(".message-bottom-right").removeClass("success-message");
        $(".message-bottom-right").removeClass("warning-message");
        $(".message-bottom-right").addClass("error-message");
    }

    // add message to the message box
    $(".message-bottom-right").text(message);

    // show message box
    $(".message-bottom-right").animate({right: '30px', opacity: '1',}, 500);

    if(autoClose){
        // hide message box after 10s
        setInterval(() => {
            $(".message-bottom-right").animate({right: '-50%', opacity: '0',}, 500);
        }, interval);
    }

    // hide message on click
    $(".message-bottom-right").click(function(){
        $(".message-bottom-right").animate({right: '-50%', opacity: '0',}, 500);
    });
}