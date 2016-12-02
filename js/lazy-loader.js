(function($) {

    $(document).ready(function() {
         
        // id of post container element.
        var elementID = pagination.elementID;
        var fetchCount = pagination.fetchCount;
        var maxPages = pagination.max;
        var spinnerColor = pagination.spinnerColor;
        var spinnerHeight = pagination.spinnerHeight;
        var spinnerSpeed = pagination.spinnerSpeed;

        //console.log(pagination);

        // append spinner to user defined container
        function buildSpinner(color, height, speed) {
            var newBorder = 'border:' + spinnerHeight + 'px solid ' + spinnerColor;
            var newAnim = 'animation: rotate ' + spinnerSpeed + 'ms infinite linear';
            var newStyle = newBorder + ';' + newAnim + ';';

            var spinner = '<div class="lazy-spinner-container hide-lazy-spinner">' +
                          '<div class="lazy-spinner" style="' + newStyle + 'border-top-color: transparent;"></div>' +
                          '</div>';
            return spinner;
        }

        $( elementID ).append( buildSpinner(spinnerColor, spinnerHeight, spinnerSpeed) );


        // AJAX for infinite scroll pagination
        function loadMorePosts(pageNumber, postsPerPage) {
            var queryString = 'action=infinite_scroll&page_no=' + pageNumber + 
                '&loop_file=loop';
            jQuery.ajax({
                url: '/wp-admin/admin-ajax.php',
                type: 'post',
                data: queryString,
                success: function(response){
                    $( elementID ).append(response);
                    $('.lazy-spinner-container').addClass('hide-lazy-spinner');
                }
            });
        }

        // default options for the loadMorePosts function
        var loadMoreOptions = {
            loadCount: 2, // start at two, initial page load is first page of pagination
            fetchCount: fetchCount
        };

        $(window).on('scroll', function(){ 
            var scrollHeight = jQuery(window).scrollTop();
            var docHeight = jQuery(document).height();
            var winHeight = jQuery(window).height();
            var threshold = docHeight - winHeight;

            if (loadMoreOptions.loadCount <= maxPages && scrollHeight === threshold ) {
                 $('.lazy-spinner-container').removeClass('hide-lazy-spinner');
                 loadMorePosts(loadMoreOptions.loadCount, loadMoreOptions.fetchCount);
                 loadMoreOptions.loadCount+=1;
                }
        });

    });
})(jQuery);

