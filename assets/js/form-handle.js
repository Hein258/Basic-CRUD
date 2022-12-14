
var loader = '<span id="loader"></span>';

$(document)
.ajaxStart(function () {
    $('body').append(loader);
})
.ajaxStop(function () {
    setTimeout(function(){
        $('#loader').remove();
    }, 200)
});

$(function() {

    $('.ajax-sub').on('submit', function(e){
        
        e.preventDefault();

        var sub = $(this).attr("id").split('-')[0];
		var formData = new FormData($(this)[0]);
		formData.append(sub, true);

		$.ajax({
			method: 'POST',
			url: 'includes/ajax/form-submit.php',
			dataType: 'json',
			data: formData,
			processData: false,
			contentType: false,
			success: function(response){
				alertDialog(response.type, response.title, response.msg, response.url);
			},
			error: function(request, error){
                alertDialog('error', 'An Error Has Occured', request.responseText, true);
			}

		});

    });

	$('.data_tb').DataTable({
		responsive: true,
		pageLength : 25,
	});

})