/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

<<<<<<< HEAD
 CKEDITOR.editorConfig = function( config ) {
	// KCFINDER
	// config.filebrowserBrowseUrl = 'http://localhost/assets/plugins/kcfinder/browse.php?type=files';
	// config.filebrowserImageBrowseUrl = 'http://localhost/assets/plugins/kcfinder/browse.php?type=images';
	// config.filebrowserFlashBrowseUrl = 'http://localhost/assets/plugins/kcfinder/browse.php?type=flash';
	// config.filebrowserUploadUrl = 'http://localhost/assets/plugins/kcfinder/upload.php?type=files';
	// config.filebrowserImageUploadUrl = 'http://localhost/assets/plugins/kcfinder/upload.php?type=images';
	// config.filebrowserFlashUploadUrl = 'http://localhost/assets/plugins/kcfinder/upload.php?type=flash';
	// config.filebrowserUploadMethod = 'form';

	// config.filebrowserBrowseUrl = 'kcfinder/browse.php?type=files';
	// config.filebrowserImageBrowseUrl = 'kcfinder/browse.php?type=images';
	// config.filebrowserFlashBrowseUrl = 'kcfinder/browse.php?type=flash';
	// config.filebrowserUploadUrl = 'kcfinder/upload.php?type=files';
	// config.filebrowserImageUploadUrl = 'kcfinder/upload.php?type=images';
	// config.filebrowserFlashUploadUrl = 'kcfinder/upload.php?type=flash';

	// END
=======
CKEDITOR.editorConfig = function( config ) {
>>>>>>> 2ca85e756bdeb988111c4bf0021d5b624ff9aedf
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
<<<<<<< HEAD
	{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
	// { name: 'editing',     groups: [ 'find', 'selection' ] },
	{ name: 'links' },
	{ name: 'insert', groups: [ 'insert', 'Youtube','MathType' ] },
	{ name: 'forms' },
	{ name: 'tools' },
	// { name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
	{ name: 'others' },
	'/',
	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
	{ name: 'paragraph',   groups: [ 'list', 'indent', 'align', 'bidi' ] }
	// { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] }
	// { name: 'styles' },
	// { name: 'colors' },
	// { name: 'about' }
=======
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'insert', groups: [ 'insert', 'Youtube','MathType' ] },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'about' }
>>>>>>> 2ca85e756bdeb988111c4bf0021d5b624ff9aedf
	];

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.extraPlugins = 'youtube , ckeditor_wiris';
	config.removeButtons = 'Underline,Subscript,Superscript';

	// Set the most common block elements.
	// config.format_tags = 'p;h1;h2;h3;pre';

	// Simplify the dialog windows.
	// config.removeDialogTabs = 'image:advanced;link:advanced';
};
