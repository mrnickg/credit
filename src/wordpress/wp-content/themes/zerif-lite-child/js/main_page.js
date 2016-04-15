jQuery( document ).ready(function() {
    jQuery('.btn').on('click', function(e) {
        if (jQuery(this).hasClass('btn-agent')) {
            jQuery('.show-agent').show('slow');
            jQuery('.show-lender').hide();
            jQuery('.show-tenant').hide();
        }
        else if (jQuery(this).hasClass('btn-lender')) {
            jQuery('.show-agent').hide();
            jQuery('.show-lender').show('slow');
            jQuery('.show-tenant').hide();
        }
        else if (jQuery(this).hasClass('btn-tenant')) {
            jQuery('.show-agent').hide();
            jQuery('.show-lender').hide();
            jQuery('.show-tenant').show('slow');
        }
    });
});
