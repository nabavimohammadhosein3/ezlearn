$(document).ready(function () {
    $(".fade_in_right, .fade_in_left, .fade_in_up, .fade_in_down").each(function (index) {
        var delayInSeconds = index * 0.2;
        $(this).css('transition-delay', delayInSeconds + 's');
    });
    $(".fade_in_right, .fade_in_left, .fade_in_up, .fade_in_down").addClass("normal_anim");
});
