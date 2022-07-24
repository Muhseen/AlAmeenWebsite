$("#state").on("change", function(){
    let state = $(this).val();
    $.ajax({
        type: "GET",
        url: "/getLgas",
        data: {state:state},
        dataType: "JSON",
        success: function (response) {
            let lgas = response.lgas;
            $("#lgas").empty();
            for(i=0;i<lgas.length;i++)
            {
                $("#lgas").append("<option value='"+lgas[i]+"' >"+lgas[i]+"</option>");

            }
        }
    });
});
$("#stateResiding").on("change", function(){
    let state = $(this).val();
    $.ajax({
        type: "GET",
        url: "/getLgas",
        data: {state:state},
        dataType: "JSON",
        success: function (response) {
            let lgas = response.lgas;
            $("#lgasResiding").empty();
            for(i=0;i<lgas.length;i++)
            {
                $("#lgasResiding").append("<option value='"+lgas[i].lga+"' >"+lgas[i].lga+"</option>");

            }
        }
    });
});