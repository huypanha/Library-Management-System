$(document).ready(function(){
    $(".menu-item").click(function(){
        const oldSelectedMenuIndex = $(".nav-menu-active").index();
        const navMenuCount = $(".nav-menu").children().length;
        var newImg = "";

        // remove active menu
        for(var i = 0; i < navMenuCount; i++){
            $(".menu-item").eq(i).removeClass("nav-menu-active");
        }

        // get image to change for new active menu
        if($(this).index() == 0){
            newImg = "<img src='media/dashboard_filled.png' alt='menu icon'>";
        } else if($(this).index() == 1){
            newImg = "<img src='media/user_filled.png' alt='menu icon'>";
        } else if($(this).index() == 2){
            newImg = "<img src='media/user_filled.png' alt='menu icon'>";
        } else if($(this).index() == 3){
            newImg = "<img src='media/user_filled.png' alt='menu icon'>";
        } else if($(this).index() == 4){
            newImg = "<img src='media/user_filled.png' alt='menu icon'>";
        } else if($(this).index() == 5){
            newImg = "<img src='media/user_filled.png' alt='menu icon'>";
        }

        // change new active menu image
        $(".menu-item").eq($(this).index()).html(newImg);

        // chagne new active menu
        $(".menu-item").eq($(this).index()).addClass("nav-menu-active");

        // get image for old active menu
        if(oldSelectedMenuIndex == 0){
            newImg = "<img src='media/dashboard_outline.png' alt='menu icon'>";
        } else if(oldSelectedMenuIndex == 1){
            newImg = "<img src='media/user_outline.png' alt='menu icon'>";
        } else if(oldSelectedMenuIndex == 2){
            newImg = "<img src='media/user_outline.png' alt='menu icon'>";
        } else if(oldSelectedMenuIndex == 3){
            newImg = "<img src='media/user_outline.png' alt='menu icon'>";
        } else if(oldSelectedMenuIndex == 4){
            newImg = "<img src='media/user_outline.png' alt='menu icon'>";
        } else if(oldSelectedMenuIndex == 5){
            newImg = "<img src='media/user_outline.png' alt='menu icon'>";
        }

        // change old active menu image
        $(".menu-item").eq(oldSelectedMenuIndex).html(newImg);
    });
});