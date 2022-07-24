$("#regno").blur(function() {
    let regno = $("#regno").val();
    if (!regno.length > 0) {
        return;p
    }
    $.ajax({
        type: "GET",
        url: "/getStudent",
        data: { regno },
        dataType: "JSON",
        success: function(response) {
            let Name =
                response.MiddleName != "" ?
                response.FirstName +
                " " +
                response.MiddleName +
                " " +
                response.LastName :
                response.FirstName + "  " + response.LastName;
            let text = Name + "-" + response.level + "-" + response.course;
            $("#details").val(text);
        }
    });
});