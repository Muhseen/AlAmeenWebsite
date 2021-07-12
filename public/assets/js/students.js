$("#cboState).on('change', function() 
{
    let stateId = $("cboState).val();
    $.ajax({
        type: "GET",
        url: "/getLgas",
        data:{stateId:stateId},
        dataType: "JSON",
        success: function (response) {
            let lgas = response.lgas;
            let optionHtml = "";
            $("cboLgas").html("");
            for(i=0;i<lgas.length;i++)
            {
            optionHtml+='<option value="'+lgas.id+'">'+lgas.lga+'</option>';
            }
        $("cboLgas").html(optionHtml);
    }
    });
});