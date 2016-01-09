$(function(){
	//data table kategori
	$('#tabel-kategori').dataTable();
	//submit new kategori form
	$('.form-new-kategori').on('submit', function(){
		$.ajax({
			type: 'POST',
			url: $(this).attr('action'),
			data: $(this).serialize(),
			dataType: 'json',
			success: function(data){
				if (data.error === 0) {
					$('.form-group-nama').addClass('has-error');
					$('#error-message').html(data.message);
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
	$('.form-delete-kategori').on('submit', function(){
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
	$('.form-update-kategori').on('submit', function(){
		$.ajax({
			type: 'POST',
			url: $(this).attr('action'),
			data: $(this).serialize(),
			dataType: 'json',
			success: function(data){
				if (data.error === 0) {
					$('.form-group-nama-edit').addClass('has-error');
					$('#error-message-edit').html(data.message);
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
	$('.form-group-nama').removeClass('has-error'); // remove class error
	$('#nama-kategori').val(''); // clear the input after cancel button
	$('#error-message').html(''); // clear the error message after cancel button has typed 
	$('.new-modal-kategori').modal(); // show the modal
}

function deleteFunc (id) {
	$('#kategori_id').val(id);
	$('.delete-modal-kategori').modal();
}

function EditKategori (id) {
	$('.form-group-nama-edit').removeClass('has-error');
	$('#error-message-edit').html('');
	$('#id_edit').val(id);
	get_kategori(id);
	$('.update-modal-kategori').modal();
}

function get_kategori (id) {
	$.ajax({
		type: 'POST',
		url: base_url+'kategori/edit',
		data: {id: id},
		dataType: 'json',
		success: function(data){
			if (data.error === 0) {
				window.location.href = data.url;
			}
			if (data.error === 1) {
				$('#id_edit').val(data.data.id);
				$('#nama-kategori-edit').val(data.data.nama_kategori);
			}
		}
	});
	return false;
}