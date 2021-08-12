function validateReceipt()
{
    let myReceiptNo = $("#modalReceiptNo").val();
    console.log({myReceiptNo});
        $.ajax({
        type: "GET",
        url: "/validateReceipt",
        data: {receiptNo:myReceiptNo },
        dataType: "JSON",
        success: function (data) {
          console.log({data});
          
          let ourResponse = "This receipt is Valid! <br>";
          ourResponse+="Paid By : "+data.Payer+"<br>";
          ourResponse+="Paid on : "+data.Txndate+"<br>";
          ourResponse+="Amount : "+data.Amount+"<br>";
          ourResponse+="Purpose : "+data.Description+"<br>";
          ourResponse+="Reprint : <a href='/reprint/"+data.id+"' class='btn btn-success'>Reprint</a> <br>";
        let MyModalAlert = $("#myReceiptModalAlert");
            MyModalAlert.html("<strong style='color:white'>"+ourResponse+"</strong>")
        MyModalAlert.toggleClass("d-none");
        //alert(ourResponse);
        }, 
        onerror: function(response)
{
    alert("error");
}    });
}
function removeDetails()
{
    let MyModalAlert = $("#myReceiptModalAlert");
        if(!MyModalAlert.hasClass("d-none"))
        {
                MyModalAlert.addClass('d-none');
                $("#modalReceiptNo").val("");
    
        }
}