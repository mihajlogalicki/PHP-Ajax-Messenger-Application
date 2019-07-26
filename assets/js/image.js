$(document).ready(function(){
    $(document).on("change", ".file", function(){
        var image_name = $(".file").val();
        // ** split on \\ and get last index. I MEAN (pathname.jpg) we want to display 
        var file = image_name.split("\\").pop();
        $("#file-label").html(file);
    });
});