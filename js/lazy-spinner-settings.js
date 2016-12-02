(function($){
    'use strict';

    $(document).ready(function() {
        console.log('i"m loaded!');

        $('#lazy-click').click(function(){
            $('.create-spinner-container').toggleClass('show-spinner-container');
        });

        function changePreview(){  
          keyupTimer = null; 
          var color = $('#ell-spinner-color').val() ? $('#ell-spinner-color').val() : '#007cba';
          var height = $('#ell-spinner-height').val() ? $('#ell-spinner-height').val() : '2';
          var speed = $('#ell-spinner-speed').val() ? $('#ell-spinner-speed').val() : '1000';
          var newBorder = 'border:' + height + 'px solid ' + color;
          var newAnim = 'animation: rotate ' + speed + 'ms infinite linear';

          console.log(color, height);

          $('.lazy-spinner').attr('style', newBorder + '; border-top-color: transparent;' + newAnim);      
        }
        var keyupTimer = null;

        function timerCheck() {
            if(keyupTimer !== null) {
              clearTimeout(keyupTimer); 
          } 
          keyupTimer = setTimeout(changePreview, 750); 
        }

        $('#ell-spinner-color, #ell-spinner-height, #ell-spinner-speed').keyup( timerCheck )
                                                                        .change( timerCheck );  

        changePreview();
    });
    

})(jQuery);
