$(document).ready(function() {
    $("#reply").val("mousa");
    $(".edit-reply").click(function(e) {
        e.preventDefault();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/discussion/" + $(this).attr("data-replyId") + "/edit",
            dataType: "json",
            success: function(response) {
                $("#recipient-name").val(response.content);
                console.log(response);
                $(".update-reply").attr("action", `discussion/{discussion}/{reply}/update`);
            }
        });
    });
    $("#edit-reply").val("mousa");
});