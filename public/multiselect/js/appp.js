 $(function()
 {
    $users_listt = $('#users_listt');
    $users_listt.multiselect({
        listWidth: 400
    });

    $("#submit_data").click(function( e ) {
        var fields = $( ":input" ).serializeArray();
        $( "#results" ).empty().append( JSON.stringify( fields , null, "\t") );
    });

 });