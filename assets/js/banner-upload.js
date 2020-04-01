$(function(){

$("#uploadTrigger").click(function(){
    $("#fileToUpload").click();
});


 $("#fileToUpload").change(function(){

        var $fileUpload = $("input[type='file']");

              $("#uploadTrigger").text("Uploading...");

              setTimeout(function(){
              var fd = new FormData(document.querySelector("#file_upload"));
          
              var upload_request =  $.ajax({
              url: "banner-upload.php",
              type: "POST",
              data:fd,
              //data: {"images":fd,"id":id},
              processData: false,  // tell jQuery not to process the data
              contentType: false,  // tell jQuery not to set contentType
              dataType: "json"
              });

              upload_request.done(function( data ) {

                console.log(data);
                if(data.status=='success'){
                  $("#uploadTrigger").hide();
                   img = $('<img src="banners/'+data.img+'" class="img-fluid">');
                   $(".banner_image").empty();
                   $(".banner_image").append(img);
                   $("#link_banner").val(data.img);
                }
                 
               });
              $("#fileToUpload").val('');
              return false;
              }, 1000);
            
        

    });



});