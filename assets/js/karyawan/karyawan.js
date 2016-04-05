$(function(){
	//data table kategori
	$('#tabel-kategori').dataTable();
	//submit new kategori form
	$('.form-new-karyawan').on('submit', function(){
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
                    if((data.message.notlp).length > 0){
					    $('.form-group-notlp').addClass('has-error');
                        $('.error-message-notlp').html(data.message.notlp);
                    }
                    if((data.message.email).length > 0){
					    $('.form-group-email').addClass('has-error');
                        $('.error-message-email').html(data.message.email);
                    }
                    if((data.message.alamat).length > 0){
					    $('.form-group-alamat').addClass('has-error');
                        $('.error-message-alamat').html(data.message.alamat);
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
	$('.form-delete-karyawan').on('submit', function(){
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
	$('.form-update-karyawan').on('submit', function(){
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

                    if((data.message.notlp_edit).length > 0){
					    $('.form-group-notlp-edit').addClass('has-error');
                        $('.error-message-notlp-edit').html(data.message.notlp_edit);
                    }

                    if((data.message.email_edit).length > 0){
					    $('.form-group-email-edit').addClass('has-error');
                        $('.error-message-email-edit').html(data.message.email_edit);
                    }

                    if((data.message.alamat_edit).length > 0){
					    $('.form-group-alamat-edit').addClass('has-error');
                        $('.error-message-alamat-edit').html(data.message.alamat_edit);
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
	$('.error-message-notlp').html(''); // clear the error message after cancel button has typed 
	$('.error-message-email').html(''); // clear the error message after cancel button has typed 
	$('.error-message-alamat').html(''); // clear the error message after cancel button has typed 
	$('.new-modal-karyawan').modal(); // show the modal
}

function deleteFunc (id) {
	$('#karyawan_id').val(id);
	$('.delete-modal-karyawan').modal();
}

function EditKaryawan (id) {
	$('.form-group').removeClass('has-error');
    $('.error-message-nama-edit').html(''); // clear the error message after cancel button has typed 
	$('.error-message-notlp-edit').html(''); // clear the error message after cancel button has typed 
	$('.error-message-email-edit').html(''); // clear the error message after cancel button has typed 
	$('.error-message-alamat-edit').html(''); // clear the error message after cancel button has typed 
	$('#id_edit').val(id);
	get_karyawan(id);
	$('.update-modal-karyawan').modal();
}

function get_karyawan (id) {
	$.ajax({
		type: 'POST',
		url: base_url+'karyawan/edit',
		data: {id: id},
		dataType: 'json',
		success: function(data){
			if (data.error === 0) {
				window.location.href = data.url;
			}
			if (data.error === 1) {
				$('#id_edit').empty().val(data.data.id);
				$('#nama-edit').empty().val(data.data.nama);
				$('#jenis_kelamin-edit').val(data.data.jenis_kelamin);
				$('#notlp-edit').empty().val(data.data.notlpn);
				$('#email-edit').empty().val(data.data.email);
				$('#jabatan-edit').val(data.data.jabatan);
				$('#alamat-edit').empty().val(data.data.alamat);
			}
		}
	});
	return false;
}
