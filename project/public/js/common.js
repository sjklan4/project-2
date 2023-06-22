(function($) { 
    $(function() { 
      //  open and close nav 
    $('#navbar-toggle').click(function() {
        $('nav ul').slideToggle();
    });


    // Hamburger toggle
    $('#navbar-toggle').on('click', function() {
        this.classList.toggle('active');
    });


    // If a link has a dropdown, add sub menu toggle.
    $('nav ul li a:not(:only-child)').click(function(e) {
        $(this).siblings('.navbar-dropdown').slideToggle("slow");

        // Close dropdown when select another dropdown
        $('.navbar-dropdown').not($(this).siblings()).hide("slow");
        e.stopPropagation();
    });

      // Click outside the dropdown will remove the dropdown class
        $('html').click(function() {
            $('.navbar-dropdown').hide();
        });
    }); 
})(jQuery);

// $(document).ready(function(){
//     var headerHeight = $('#header').height();

//     function floatSearch(){
//         if($(window).scrollTop() > headerHeight){
//             $('.navigation').addClass('fixed');
//         }else{
//             $('.navigation').removeClass('fixed');
//         }
//     }

//     $(window).scroll(function(){
//         floatSearch();
//     });

//     floatSearch();
// });