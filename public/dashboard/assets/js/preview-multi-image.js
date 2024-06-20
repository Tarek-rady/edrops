// create preview image when upload
if (window.File && window.FileList && window.FileReader) {
    $("#files").on("change", function (e) {
        $(".carousel-inner").find('.carousel-item').removeClass('active');
        var files = e.target.files, filesLength = files.length;
        for (var i = 0; i < filesLength; i++) {

            var f = files[i]
            var fileReader = new FileReader();

            fileReader.onload = (function (e) {

                var file = e.target;

                var image = "<div class=\"image_append\">" +
                    "<button type=\"button\" class=\"btn btn-danger remove\">" + "<i class=\"fa fa-trash\">" + "</i></button>" +
                    "<img class=\"img-fluid\" src=\"" + e.target.result + "\" title=\"" + file.name + "\" alt=\"First slide\" />" +
                    "</div>";

                $("#dis_prev_image").append(image);

                $(".remove").click(function () {

                    $(this).parent(".image_append").remove();

                }); // end of click remove

            }); // end of fileReader

            fileReader.readAsDataURL(f);

        } // end of for var i


    }); // end 0f files

}
else {

    alert("Your browser doesn't support to File API")

} // end of else if window file
