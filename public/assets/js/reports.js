$("#cboFaculty").on("change", function() {
    let cboCourses = $("#cboCourses");
    cboCourses.empty();
    let cboLevels = $("#cboLevels");
    let faculty = $("#cboFaculty").val();
    $.ajax({
        type: "GET",
        url: "/getCourses",
        data: { faculty: faculty },
        dataType: "JSON",
        success: function(response) {
            console.log({ response });
            let courses = response.courses;
            let levels = response.level;
            for (i = 0; i < courses.length; i++) {
                cboCourses.append(
                    "<option value ='" +
                        courses[i].course +
                        "'>" +
                        courses[i].course +
                        "</option>"
                );
            }
            alert(options);
        }
    });
});
$("#cboCourses").on("change", function() {
    alert("here again");
    let faculty = $("#cboFaculty");
    let course = $("#cboCourses");
    let cboLevels = $("#cboLevels");
    $.ajax({
        type: "GET",
        url: "/getLevels",
        data: { faculty: faculty, course: course },
        dataType: "JSON",
        success: function(levels) {
            for (i = 0; i < levels.length; i++) {
                cboLevels.append(
                    '<option value ="' +
                        levels[i].course +
                        '">' +
                        levels[i].course +
                        "</option>"
                );
            }
        }
    });
});
