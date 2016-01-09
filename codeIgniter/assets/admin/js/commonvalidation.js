$(document).ready(function() {	
$('#genreaddform').bootstrapValidator({
		message: 'This value is not valid',
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			vGenre: {
				validators: { notEmpty: { message: "Genre title is required and can't be empty" } }
			},
			tLogo:{
				validators: {
						notEmpty:{ message: "Genre Image is required and can't be empty" },
						file: {
							extension: 'jpeg,jpg,png,JPEG,JPG,PNG',
							type: 'image/jpeg,image/jpg,image/png,image/JPG,image/JPEG,image/PNG',
							message: 'The selected file is not valid'
						}
				}
			},
			tBigLogo:{
				validators: {
						notEmpty:{ message: "Genre Big Image is required and can't be empty" },
						file: {
							extension: 'jpeg,jpg,png,JPEG,JPG,PNG',
							type: 'image/jpeg,image/jpg,image/png,image/JPG,image/JPEG,image/PNG',
							message: 'The selected file is not valid'
						}
				}
			},	
			eStatus:{
				validators: { notEmpty: { message: "Status is required and can't be empty" } }
			}
		}
	});

	$('#genreupdateform').bootstrapValidator({
		message: 'This value is not valid',
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			vGenre: {
				validators: { notEmpty: { message: "Genre title is required and can't be empty" } }
			},
			tLogo:{
				validators: {
						notEmpty:{ message: "Genre Image is required and can't be empty" },
						file: {
							extension: 'jpeg,jpg,png,JPEG,JPG,PNG',
							type: 'image/jpeg,image/jpg,image/png,image/JPG,image/JPEG,image/PNG',
							message: 'The selected file is not valid'
						}
				}
			},	
			tBigLogo:{
				validators: {
						notEmpty:{ message: "Genre Big Image is required and can't be empty" },
						file: {
							extension: 'jpeg,jpg,png,JPEG,JPG,PNG',
							type: 'image/jpeg,image/jpg,image/png,image/JPG,image/JPEG,image/PNG',
							message: 'The selected file is not valid'
						}
				}
			},
			eStatus:{
				validators: { notEmpty: { message: "Status is required and can't be empty" } }
			}
		}
	});

	$('#musicmgmtaddform').bootstrapValidator({
		message: 'This value is not valid',
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			iGenreId: {
				validators: { notEmpty: { message: "Genre title is required and can't be empty" } }
			},
			iPlayListId: {
				validators: { notEmpty: { message: "Playlist title is required and can't be empty" } }
			},
			tTitle: {
				validators: { notEmpty: { message: "Song title is required and can't be empty" } }
			},
			vArtistName: {
				validators: { notEmpty: { message: "Artist name is required and can't be empty" } }
			},
			vAlbumTitle: {
				validators: { notEmpty: { message: "Album name is required and can't be empty" } }
			},
			vCompanyName: {
				validators: { notEmpty: { message: "Label is required and can't be empty" } }
			},
			eStatus:{
				validators: { notEmpty: { message: "Status is required and can't be empty" } }
			},
			tMetaTag: {
				validators: { notEmpty: { message: "Meta Tag is required and can't be empty" } }	
			},
			tDescription: {
				validators: { notEmpty: { message: "Description is required and can't be empty" } }		
			}
		}
	});

	$('#Playlistaddform').bootstrapValidator({
		message: 'This value is not valid',
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			iGenreId: {
				validators: { notEmpty: { message: "Genre title is required and can't be empty" } }
			},
			vPlaylist: {
				validators: { notEmpty: { message: "Playlist title is required and can't be empty" } }
			},
			tTitle: {
				validators: { notEmpty: { message: "Song Title is required and can't be empty" } }
			},
			tMetaTag: {
				validators: { notEmpty: { message: "Meta tag is required and can't be empty" } }	
			},
			tDescription: {
				validators: { notEmpty: { message: "Description is required and can't be empty" } }	
			},
			eStatus:{
				validators: { notEmpty: { message: "Status is required and can't be empty" } }
			}
		}
	});
	
});
