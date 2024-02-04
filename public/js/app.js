$(document).ready(function () {
    $(".dropend").hover(
        function () {
            $(this)
            $(this).addClass("show");
            $(this).attr("aria-expanded", "true");
            $(this).children(".dropdown-menu").addClass("show");
            $(this).children(".dropdown-menu").attr("data-bs-popper", "static");
        },
        function () {
            $(this).removeClass("show");
            $(this).attr("aria-expanded", "false");
            $(this).children(".dropdown-menu").removeClass("show");
            $(this).children(".dropdown-menu").removeAttr("data-bs-popper");
        }
    );
    $('#search_form').submit(function (event) {
        event.preventDefault();
        let search = $('#search_form input').val().trim();
        if (search != ''){
            const url = `/search?q=${encodeURIComponent(search)}`;
            window.location.href = url;
        }
    });
});

