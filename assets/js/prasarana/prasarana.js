$(function(){
	//data table kategori
	$('#tabel-kategori').dataTable();
	//submit new kategori form
	$('.form-new-prasarana').on('submit', function(){
        clearInput();
		$.ajax({
			type: 'POST',
			url: $(this).attr('action'),
			data: $(this).serialize(),
			dataType: 'json',
			success: function(data){
				if (data.error === 0) {
                    if((data.message.nama).length > 0){
					    $('.form-group-nama').addClass('has-error');
                        $('.error-message-nama').html(data.message.nama);
                    }
                    if((data.message.lokasi).length > 0){
					    $('.form-group-lokasi').addClass('has-error');
                        $('.error-message-lokasi').html(data.message.lokasi);
                    }
                    if((data.message.longitude).length > 0){
					    $('.form-group-longitude').addClass('has-error');
                        $('.error-message-longitude').html(data.message.longitude);
                    }
                    if((data.message.latitude).length > 0){
					    $('.form-group-latitude').addClass('has-error');
                        $('.error-message-latitude').html(data.message.latitude);
                    }
				}
				if (data.error === 1) {
					// $('#message-success-js').html(data.message);
					// $('.alert-js-success').show();
					window.location.href = data.url;
				}
			}
		});
		return false;
	});
	//submit form delete
	$('.form-delete-prasarana').on('submit', function(){
		$.ajax({
			type: 'POST',
			url: $(this).attr('action'),
			data: $(this).serialize(),
			dataType: 'json',
			success: function(data){
				if (data.error === 0) {
					window.location.href = data.url;
				}
				if (data.error === 1) {
					window.location.href = data.url;
				}
			}
		});
		return false;
	});

	//submit form update
	$('.form-update-prasarana').on('submit', function(){
        clearInputUpdate();
		$.ajax({
			type: 'POST',
			url: $(this).attr('action'),
			data: $(this).serialize(),
			dataType: 'json',
			success: function(data){
				if (data.error === 0) {
                    if((data.message.nama_edit).length > 0){
					    $('.form-group-nama-edit').addClass('has-error');
                        $('.error-message-nama-edit').html(data.message.nama_edit);
                    }

                    if((data.message.lokasi_edit).length > 0){
					    $('.form-group-lokasi-edit').addClass('has-error');
                        $('.error-message-lokasi-edit').html(data.message.lokasi_edit);
                    }

                    if((data.message.longitude_edit).length > 0){
					    $('.form-group-longitude-edit').addClass('has-error');
                        $('.error-message-longitude-edit').html(data.message.longitude_edit);
                    }

                    if((data.message.latitude_edit).length > 0){
					    $('.form-group-latitude-edit').addClass('has-error');
                        $('.error-message-latitude-edit').html(data.message.latitude_edit);
                    }

				}
				if (data.error === 1) {
					window.location.href = data.url;
				}
			}
		});
		return false;
	});

});

function newFunc () {
	$('.form-group').removeClass('has-error'); // remove class error
	$('#nama-kategori').val(''); // clear the input after cancel button
	$('.error-message-nama').html(''); // clear the error message after cancel button has typed 
	$('.error-message-lokasi').html(''); // clear the error message after cancel button has typed 
	$('.error-message-longitude').html(''); // clear the error message after cancel button has typed 
	$('.error-message-latitude').html(''); // clear the error message after cancel button has typed 
	$('.new-modal-prasarana').modal(); // show the modal
}

function deleteFunc (id) {
	$('#prasarana_id').val(id);
	$('.delete-modal-prasarana').modal();
}

function EditPrasarana (id) {
	$('.form-group').removeClass('has-error');
    $('.error-message-nama-edit').html(''); // clear the error message after cancel button has typed 
	$('.error-message-lokasi-edit').html(''); // clear the error message after cancel button has typed 
	$('.error-message-longitude-edit').html(''); // clear the error message after cancel button has typed 
	$('.error-message-latitude-edit').html(''); // clear the error message after cancel button has typed 
	$('#id_edit').val(id);
	get_prasarana(id);
	$('.update-modal-prasarana').modal();
}

function get_prasarana (id) {
	$.ajax({
		type: 'POST',
		url: base_url+'prasarana/edit',
		data: {id: id},
		dataType: 'json',
		success: function(data){
			if (data.error === 0) {
				window.location.href = data.url;
			}
			if (data.error === 1) {
				$('#id_edit').empty().val(data.data.id);
				$('#nama-edit').empty().val(data.data.nama);
				$('#lokasi-edit').val(data.data.lokasi);
				$('#longitude-edit').empty().val(data.data.longitude);
				$('#latitude-edit').empty().val(data.data.latitude);
				$('#kategori-edit').val(data.data.kategori_id_kategori);
			}
		}
	});
	return false;
}

function clearInput() {
    $('.form-group-nama').removeClass('has-error');
    $('.error-message-nama').html('');
    $('.form-group-lokasi').removeClass('has-error');
    $('.error-message-lokasi').html('');
    $('.form-group-longitude').removeClass('has-error');
    $('.error-message-longitude').html('');
    $('.form-group-latitude').removeClass('has-error');
    $('.error-message-latitude').html('');

}

function clearInputUpdate() {
    $('.form-group-nama-edit').removeClass('has-error');
    $('.error-message-nama-edit').html('');
    $('.form-group-lokasi-edit').removeClass('has-error');
    $('.error-message-lokasi-edit').html('');
    $('.form-group-longitude-edit').removeClass('has-error');
    $('.error-message-longitude-edit').html('');
    $('.form-group-latitude-edit').removeClass('has-error');
    $('.error-message-latitude-edit').html('');
}
