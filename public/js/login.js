window.onload = function () {
    $('#laptop').on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',
    function(){
        $(this).css('animation', 'none');
    });
    $('#first-quote').on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',
    function(){
        $(this).css('animation', 'none');
    });
};
