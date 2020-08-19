jQuery(document).ready(function($){
	// on upload button click
	$('body').on( 'click', '.btn-media-upload', function(e){
 
		e.preventDefault();
 
		var button = $(this),
		custom_uploader = wp.media({
			title: wc_variation_general_thumbnail_vars.insert_image,
			library : {
				// uploadedTo : wp.media.view.settings.post.id, // attach to the current post?
				type : 'image'
			},
			button: {
				text: wc_variation_general_thumbnail_vars.use_image // button label text
			},
			multiple: false
		}).on('select', function() { // it also has "open" and "close" events
			var attachment = custom_uploader.state().get('selection').first().toJSON();
			button.html('<img src="' + attachment.sizes.thumbnail.url + '">').next().val(attachment.id).next().show();
			button.parent().find('input').val(attachment.id)
			button.parent().find('.btn-media-remove').show();
		}).open();
 
	});
 
	// on remove button click
	$('body').on('click', '.btn-media-remove', function(e){
 
		e.preventDefault();
 
		var button = $(this);
		button.parent().find('input').val('')
		button.hide()
		button.parent().find('.btn-media-upload').html(wc_variation_general_thumbnail_vars.upload_image);
	});
	console.log(wc_variation_general_thumbnail_vars.upload_image)
});