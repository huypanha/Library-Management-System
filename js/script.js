$(document).ready(function(){
    // on click dashboard menu
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
            newChild = "<img src='media/dashboard_outline.png' alt='menu icon'>";
        } else if(oldSelectedMenuIndex == 1){
            newChild = "<i class='far fa-users size-25 gray'></i>";
        } else if(oldSelectedMenuIndex == 2){
            newChild = "<i class='far fa-books size-25 gray'></i>";
        } else if(oldSelectedMenuIndex == 3){
            newChild = "<i class='far fa-book-reader size-25 gray'></i>";
        } else if(oldSelectedMenuIndex == 4){
            newChild = "<i class='far fa-cog size-25 gray'></i>";
        } else if(oldSelectedMenuIndex == 5){
            newChild = "<i class='far fa-comment-alt-edit size-25 gray'></i>";
        }

        // change old active menu image
        $(".menu-item").eq(oldSelectedMenuIndex).html(newChild);

        // get image to change for new active menu
        if($(this).index() == 0){
            newChild = "<img src='media/dashboard_filled.png' alt='menu icon'>";
            newPage = "<iframe src='src/dashboard.php' frameborder='0'></iframe>";
            newPageTitle = "Dashboard";
        } else if($(this).index() == 1){
            newChild = "<i class='fad fa-users size-25 white'></i>";
            newPage = "<iframe src='src/students.php' frameborder='0'></iframe>";
            newPageTitle = "Students & Users";
        } else if($(this).index() == 2){
            newChild = "<i class='fad fa-books size-25 white'></i>";
            newPage = "<iframe src='src/books.php' frameborder='0'></iframe>";
            newPageTitle = "Books";
        } else if($(this).index() == 3){
            newChild = "<i class='fad fa-book-reader size-25 white'></i>";
        } else if($(this).index() == 4){
            newChild = "<i class='fad fa-cog size-25 white' style='--fa-primary-opacity: 0.4; --fa-secondary-opacity: 1;'></i>";
        } else if($(this).index() == 5){
            newChild = "<i class='fad fa-comment-alt-edit size-25 white' style='--fa-primary-opacity: 0.4; --fa-secondary-opacity: 1;'></i>";
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

    // on click tabbar
    $(".tabbar-item").click(function(){
        for(var i = 0; i < $(".tabbar").children.length; i++){
            $(".tabbar-item").eq(i).removeClass("tabbar-item-active");
        }
        $(".tabbar-item").eq($(this).index()).addClass("tabbar-item-active");
    });
});