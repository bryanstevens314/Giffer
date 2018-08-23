function addURL(url){
	var id = array['ID'];
	var check = "uncheck";
    $.ajax({
        url: 'shippingChecked.php',
        dataType: 'json',
    type: 'POST',
    contentType: 'application/json',
    data: JSON.stringify( { "id": id, "status": check } ),
         success:function(data) {
        console.log("success:"+data); 
         },
        error:function(data) {
        console.log("Error:"+data); 
         }
    });
}