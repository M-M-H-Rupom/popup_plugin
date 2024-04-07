;(function($){
    $(document).ready(function(){
        $('#modal').plainModal({ closeByOverlay: false });
        // $(".open_modal").click(function(){
            $('#modal').plainModal('open');
        // })
        $('#close-button').click(function(){
            $('#modal').plainModal('close');
        });
    });
})(jQuery);
