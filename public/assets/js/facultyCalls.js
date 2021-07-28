$("#cboFaculty").on("change", function() {
    let faculty = $(this).val();
    console.log({ faculty });
    $.ajax({
        type: "GET",
        url: "/getCourses",
        data: { faculty: faculty },
        dataType: "JSON",
        success: function(response) {
            console.log({ response });
            $("#cboCourses").empty();
            $("#cboCourses").append(
                '<option value="All">All Courses in the Faculty </option>'
            );
            for (i = 0; i < response.length; i++) {
                $("#cboCourses").append(
                    '<option value="' +
                        response[i].courses +
                        '">' +
                        response[i].courses +
                        "</option>"
                );
            }
        }
    });
});
$("#cboCourses").on("change", function() {
    let course = $(this).val();
    let faculty = $("#cboFaculty").val();
    $.ajax({
        type: "GET",
        url: "/getLevels",
        data: { faculty: faculty, course: course },
        dataType: "JSON",
        success: function(response) {
            $("#cboLevels").empty();
            $("#cboLevels").append(
                '<option value="All">All Levels for Course</option>'
            );
            for (i = 0; i < response.length; i++) {
                $("#cboLevels").append(
                    '<option value="' +
                        response[i].levels +
                        '">' +
                        response[i].levels +
                        "</option>"
                );
            }
        }
    });
});
