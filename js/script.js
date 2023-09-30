$(document).ready(function(){
    $(".menu-item").click(function(){
        const oldSelectedMenuIndex = $(".nav-menu-active").index();
        const navMenuCount = $(".nav-menu").children().length;
        var newChild = "";

        // remove active menu
        for(var i = 0; i < navMenuCount; i++){
            $(".menu-item").eq(i).removeClass("nav-menu-active");
        }

        // get image to change for new active menu
        if($(this).index() == 0){
            newChild = "<img src='media/dashboard_filled.png' alt='menu icon'>";
        } else if($(this).index() == 1){
            newChild = "<i class='fad fa-users size-25 white'></i>";
        } else if($(this).index() == 2){
            newChild = "<i class='fad fa-books size-25 white'></i>";
        } else if($(this).index() == 3){
            newChild = "<i class='fad fa-book-reader size-25 white'></i>";
        } else if($(this).index() == 4){
            newChild = "<i class='fad fa-cog size-25 white' style='--fa-primary-opacity: 0.4; --fa-secondary-opacity: 1;'></i>";
        } else if($(this).index() == 5){
            newChild = "<i class='fad fa-comment-alt-edit size-25 white' style='--fa-primary-opacity: 0.4; --fa-secondary-opacity: 1;'></i>";
        }

        // change new active menu image
        $(".menu-item").eq($(this).index()).html(newChild);

        // chagne new active menu
        $(".menu-item").eq($(this).index()).addClass("nav-menu-active");

        // get image for old active menu
        if(oldSelectedMenuIndex == 0){
            newChild = "<img src='media/dashboard_outline.png' alt='menu icon'>";
        } else if(oldSelectedMenuIndex == 1){
            newChild = "<i class='far fa-users size-25'></i>";
        } else if(oldSelectedMenuIndex == 2){
            newChild = "<i class='far fa-books size-25'></i>";
        } else if(oldSelectedMenuIndex == 3){
            newChild = "<i class='far fa-book-reader size-25'></i>";
        } else if(oldSelectedMenuIndex == 4){
            newChild = "<i class='far fa-cog size-25'></i>";
        } else if(oldSelectedMenuIndex == 5){
            newChild = "<i class='far fa-comment-alt-edit size-25'></i>";
        }

        // change old active menu image
        $(".menu-item").eq(oldSelectedMenuIndex).html(newChild);
    });
});