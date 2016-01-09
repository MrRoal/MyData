$(document).ready(function() {
	$('#add_user').bootstrapValidator({
		message: 'This value is not valid',
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			vFirstName: {
				validators: {
					notEmpty: { message: 'Se requiere que el primer nombre y no puede estar vacío' },
					regexp: { regexp: /^[a-zA-Z]+$/, message: 'El primer nombre sólo puede consistir alfabético' }
				}
			},
			vLastName: {
				validators: {
					notEmpty: { message: 'Se requiere que el apellido y no puede estar vacío' },
					regexp: { regexp: /^[a-zA-Z]+$/, message: 'El apellido sólo puede consistir alfabético' }
				}
			},
			vEmail: {
				validators: {
					notEmpty: { message: 'Se requiere que la dirección de correo electrónico y no puede estar vacío' },
					emailAddress: { message: 'La entrada no es una dirección válida de correo electrónico' }
				}
			},
			tStreetAddress: {
				validators: { notEmpty: { message: 'Se requiere que la direccion y no puede estar vacío' } }
			},
			vPhone: {
				validators: { notEmpty: { message: 'Se requiere que el telefono y no puede estar vacío' }
				}
			},
			eUserType: {
				validators: { notEmpty: { message: 'Se requiere que el tipo de usuario y no puede estar vacío' } }
			},
			vRUT:{
				validators: { 
					notEmpty: { message: 'Se requiere que la rutina y no puede estar vacío' },
					digits: {
						message: 'El valor puede contener sólo dígitos'
					}
				}
			},
			vPassword: {
				validators: { notEmpty: { message: 'La contraseña es necesaria y no puede estar vacío' } ,
					stringLength: {
						min: 3,
						max: 10,
						message: 'La contraseña debe tener más de 3 y menos de 10 caracteres de longitud'
					}
				}
			},
			eStatus: {
				validators: { notEmpty: { message: 'Se requiere que el estado y no puede estar vacío' } }
			},
			tAddress: {
				validators: { notEmpty: { message: 'Se requiere que la direccion y no puede estar vacío' } }
			},
			vCustomerName: {
				validators: {
					notEmpty: { message: 'Se requiere que el nombre del cliente y no puede estar vacío' },
					regexp: { regexp: /^[a-zA-Z\s]+$/, message: 'El nombre del cliente sólo puede consistir en alfabeto' }
				}
			},
			vMunicipality: {
				validators: { notEmpty: { message: 'Se requiere que el municipio y no puede estar vacío' } }
			},
			vArea: {
				validators: { notEmpty: { message: 'Se requiere que el área y no puede estar vacío' } }
			}, 
			vName: {
				validators: { notEmpty: { message: 'Se requiere que el nombre del producto y no puede estar vacío' } }
			},   
			vCode: {
				validators: { notEmpty: { message: 'Se requiere que el código del producto y no puede estar vacío' } }
			},  
			vPrice: {
				validators: { notEmpty: { message: 'El precio del producto que se requiere y no puede estar vacío' } }
			},  
			tPromotion: {
				validators: { notEmpty: { message: 'Se requiere que la promoción del producto y no puede estar vacío' } }
			}, 
			vCategory: {
				validators: { notEmpty: { message: 'Se requiere que la categoría del producto y no puede estar vacío' } }
			},
			vFamily: {
				validators: { notEmpty: { message: 'La familia de productos se requiere y no puede estar vacío' } }
			},
			vStoreId: {
				validators: { notEmpty: { message: 'Se requiere que el nombre de la tienda y no puede estar vacío' } }
			},
			iComunaId: {
				validators: { notEmpty: { message: 'Se requiere que la comuna no puede estar vacío' } }
			},
			iRegionId: {
				validators: { notEmpty: { message: 'Se requiere que la región no puede estar vacío' } }
			},
			vTitle: {
				validators: { notEmpty: { message: 'Se requiere que el título no puede estar vacío' } }
			},
			vDistributorId: {
				validators: { notEmpty: { message: 'Se requiere que el título no puede estar vacío' } }
			},
			iCategoryId: {
				validators: { notEmpty: { message: 'Se requiere que la categoría del producto y no puede estar vacío' } }
			},
			iFamilyId: {
				validators: { notEmpty: { message: 'La familia de productos se requiere y no puede estar vacío' } }
			},
			
			iLocalId: {
				validators: { notEmpty: { message: 'Se requiere que la comuna no puede estar vacÃ­o' } }
			},
			eStoreStatus: {
				validators: { notEmpty: { message: 'Se requiere que la comuna no puede estar vacÃ­o' } }
			},
			eCorrespondePrice: {
				validators: { notEmpty: { message: 'Se requiere que la comuna no puede estar vacÃ­o' } }
			},
			ePriceLevel: {
				validators: { notEmpty: { message: 'Se requiere que la comuna no puede estar vacÃ­o' } }
			},
			fPrice: {
				validators: { notEmpty: { message: 'Se requiere que la comuna no puede estar vacÃ­o' } }
			},
			eProperDisplay: {
				validators: { notEmpty: { message: 'Se requiere que la comuna no puede estar vacÃ­o' } }
			},
			eProductGood: {
				validators: { notEmpty: { message: 'Se requiere que la comuna no puede estar vacÃ­o' } }
			},
			vProductGoodName: {
				validators: { notEmpty: { message: 'Se requiere que la comuna no puede estar vacÃ­o' } }
			},
			eCurrentPromotion:{
				validators: { notEmpty: { message: 'Se requiere que la comuna no puede estar vacÃ­o' } }
			},
			tPromotionDescription:{
				validators: { notEmpty: { message: 'Se requiere que la comuna no puede estar vacÃ­o' } }
			},
			tComments:{
				validators: { notEmpty: { message: 'Se requiere que la comuna no puede estar vacÃ­o' } }
			},
			eType:{
				validators: { notEmpty: { message: 'Se requiere que la comuna no puede estar vacÃ­o' } }
			},
			
		}
	});
});