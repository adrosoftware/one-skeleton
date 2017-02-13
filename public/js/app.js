var app = {
    init: function () {
        $(document).on('click', '.hello', this.hello);
    },
    hello: function (event) {
        event.preventDefault();
        $.get( "/ajax/hello", function( data ) {
            $( ".result" ).html( data );
        });
    },
};

$(function(){
    app.init();
});