$(document).ready(function() {
    $('.app-icon-card').hover(
        function() {
            $(this).find('.app-icon').addClass('animate__pulse');
        },
        function() {
            $(this).find('.app-icon').removeClass('animate__pulse');
        }
    );
});