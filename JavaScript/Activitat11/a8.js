$( document).ready(function(){
    $( function() {
      $("#list, #chart").sortable({
        connectWith: ".transferable"
      }).disableSelection();
    } );
});