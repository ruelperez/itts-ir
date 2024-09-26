const toggler = document.querySelector(".btn");
toggler.addEventListener("click",function(){
    document.querySelector("#sidebar").classList.toggle("collapsed");
});
$(document).ready(function () {
    $('#dropupLink').click(function (e) {
        e.preventDefault();
        $('.dropup').toggleClass('show');
    });

    // Close the dropup when clicking outside
    $(document).click(function (e) {
        if (!$(e.target).closest('.dropup').length) {
            $('.dropup').removeClass('show');
        }
    });
});
