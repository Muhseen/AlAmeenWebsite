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

function exportTable() {
    var html = document.querySelector("table").outerHTML;
    htmlToCSV(html, "students.csv");
}

function downloadCSVFile(csv, filename) {
    var csv_file, download_link;

    csv_file = new Blob([csv], { type: "text/csv" });

    download_link = document.createElement("a");

    download_link.download = filename;

    download_link.href = window.URL.createObjectURL(csv_file);

    download_link.style.display = "none";

    document.body.appendChild(download_link);

    download_link.click();
}

function htmlToCSV(html, filename) {
    var data = [];
    var rows = document.querySelectorAll("table tr");

    for (var i = 0; i < rows.length; i++) {
        var row = [],
            cols = rows[i].querySelectorAll("td, th");

        for (var j = 0; j < cols.length; j++) {
            row.push(cols[j].innerText.replace(/,/g, ""));
        }

        data.push(row.join(","));
    }

    downloadCSVFile(data.join("\n"), filename);
}

function export2() {
    $(".table").table2excel({
        filename: "file.xls"
    });
    TableExport(document.getElementsByTagName("table"), {
        filename: 'excelfile',
        sheetname: "sheet1"
    });
}