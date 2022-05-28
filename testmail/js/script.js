//script.js
$("#post-message").on( "submit", function( event ) {
    event.preventDefault();
    var form = this;
    $.ajax({
        url: $(form).attr("action"),
        data: $(form).serialize(),
        method: "POST",
        success: function () {
            $("#messages").append(
                "<tr><td>"
                + $(form).find("input[name=author]").val()
                + "</td><td>"
                + $(form).find("input[name=message]").val()
                + "</td></tr>"
            );
            $(form).find("input[name=author]").val("");
            $(form).find("input[name=message]").val("");
        }
    });
});