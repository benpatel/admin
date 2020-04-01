$(function(){

$("#uploadTrigger").click(function(){
    $("#fileToUpload").click();
});


 $("#fileToUpload").change(function(){

        var $fileUpload = $("input[type='file']");
        var current_image_count = parseInt($fileUpload.get(0).files.length);
        var id= $("#gallery_id").text();
        if(($(".uploaded_image").length+current_image_count) < 500){
            if(current_image_count > 15){
                      $("#imgUploadAlert .msg").remove();
                      $("#imgUploadAlert").append("<strong  class='msg'>You can only upload a maximum of 15 files at a time</strong>").fadeIn(1500);
                      setTimeout(function(){
                        $("#imgUploadAlert").fadeOut(2000)
                      },5000)
              }
            else{
              $("#uploadTrigger").text("Uploading...");
              setTimeout(function(){
              var fd = new FormData(document.querySelector("#file_upload"));
          
              var upload_request =  $.ajax({
              url: "upload.php",
              type: "POST",
              data:fd,
              //data: {"images":fd,"id":id},
              processData: false,  // tell jQuery not to process the data
              contentType: false,  // tell jQuery not to set contentType
              dataType: "json"
              });

              upload_request.done(function( data ) {

                console.log(data);
                 for(var a=0; a<data['images'].length; a++){
                  var image_div = $('<div  class="uploaded_image"  data-img="'+data['images'][a]+'" data-gallery="'+data['gallery_id']+'" ><p class="image_no"></p><img data-img="'+data['images'][a]+'" src="scripts/image.php?width=300&height:300&cropratio=1:1&image='+'/admin/gallery/'+data['images'][a]+'" class="prd_images" /><p class="delate_image"><span>Delete</span></p></div>');
                  $("#uploaded_image_box").prepend(image_div);
                  //$("#product_images").append($('<input type="hidden" name="images[]" value="'+data[a]+'">'))
                 }
                 $(".image_Error_Display").text('');
                 $("#uploadTrigger").text("Upload Photo");
                 
               });
              $("#fileToUpload").val('');
              return false;
              }, 1000);
            }
        }else{
          $("#imgUploadAlert .msg").remove();
          $("#imgUploadAlert").append("<strong class='msg'>Free Account allows only 15 Images, upgrade to primium for image space</strong>").fadeIn(1500);
           setTimeout(function(){
            $("#imgUploadAlert").fadeOut(2000)
           },5000)
        }

    });



});