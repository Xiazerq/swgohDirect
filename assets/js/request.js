$(document).ready(function(){
    var request;

    $("#getUser").submit(function(event){
        $("#output").html("");

        event.preventDefault();

        if (request) {
            request.abort();
        }

        var $form = $(this);
        var $inputs = $form.find("input, select, button, textarea");
        var serializedData = $form.serialize();
        $inputs.prop("disabled", true);

        request = $.ajax({
            url: "rosters.php",
            type: "post",
            data: serializedData
        });

        request.done(function (response, textStatus, jqXHR){
            $("#output").html(response);
            $(".clipBoard").show(true);
        });

        request.fail(function (jqXHR, textStatus, errorThrown){
            console.error(
                "The following error occurred: "+
                textStatus, errorThrown
            );

            $("#output").html("Error Getting Data");
        });

        request.always(function () {
            $inputs.prop("disabled", false);
        });

    });

    new Clipboard('.clipBoard');
});