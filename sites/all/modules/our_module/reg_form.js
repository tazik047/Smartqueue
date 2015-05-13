jQuery(document).ready(function(){
	jQuery('#edit-field-the-form-of-participating-und').change(function(){
		switcher();
	});
	
	start();
});

function start(){
	jQuery('#edit-field-need-accommodation').hide();
	jQuery('#edit-field-tags')				.hide();
	jQuery('div.form-item-title')			.hide();
	jQuery('#edit-field-abstract')			.hide();
	jQuery('#edit-field-addition-information').hide();	
	jQuery('#edit-field-section-listen')	.hide();
	jQuery('#edit-field-master-classes')	.hide();
	jQuery('#edit-title').val('Default');
	jQuery('label[for="edit-field-tags-und"]').append('<span class="form-required" title="This field is required.">*</span>');
	jQuery('label[for="edit-field-abstract-und-0"]').append('<span class="form-required" title="This field is required.">*</span>');
	if(jQuery('label[for="edit-title"]>span').length==0)
		jQuery('label[for="edit-title"]').append('<span class="form-required" title="This field is required.">*</span>');
	switcher();
}

function switcher(){
	switch(jQuery('#edit-field-the-form-of-participating-und>option:selected').val()){
			case 'P':
				showPublishing();
				showAc();
				break;
			case 'WP':
				showPublishing();
				showAc();
				hideAbstract();
				break;
			case 'PR':
				showPublishing();
				break;
			case 'WPR':				
				showPublishing();
				hideAbstract();
				break;			
			case 'L':
				showList();
				showAc();
				break;
			case 'LW':
				showList();
			break;
		}
}

function showAc(){
	jQuery('#edit-field-need-accommodation').show();
}

function hideAbstract(){
	jQuery('#edit-field-abstract').hide();
}

function showPublishing(){
	jQuery('#edit-field-need-accommodation').hide();
	jQuery('#edit-field-tags').show();	
	jQuery('div.form-item-title').show();
	jQuery('#edit-field-abstract').show();	
	jQuery('#edit-field-addition-information').show();
	
	jQuery('#edit-field-section-listen').hide();
	jQuery('#edit-field-master-classes').hide();
	jQuery('#edit-title').val('');
}

function showList(){
	jQuery('#edit-field-need-accommodation').hide();
	jQuery('#edit-field-tags').hide();
	jQuery('div.form-item-title').hide();
	jQuery('#edit-field-abstract').hide();
	jQuery('#edit-field-addition-information').hide();
	jQuery('#edit-field-section-listen').show();
	jQuery('#edit-field-master-classes').show();
	jQuery('#edit-title').val('Listener');
}