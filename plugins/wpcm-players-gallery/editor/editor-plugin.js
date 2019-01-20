(function($) {
    tinymce.create('tinymce.plugins.PlayersGallery', {
        
        init : function(ed, url) {

            ed.addButton('players_gallery', {
                title : 'Insert Players Gallery',
                onclick : function() {
					// triggers the thickbox
					var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
					W = W - 80;
					H = H - 84;
					tb_show( 'Players Gallery', 'admin-ajax.php?action=players_gallery_shortcode&width=' + W + '&height=' + H );
				}
            });
        },    
    });
 
    // Register plugin
    tinymce.PluginManager.add( 'players_gallery', tinymce.plugins.PlayersGallery );

    // handles the click event of the submit button
			$('body').on('click', '#players_gallery-form #option-submit', function() {
				form = $('#players_gallery-form');
				// defines the options and their default values
				// again, this is not the most elegant way to do this
				// but well, this gets the job done nonetheless
				var options = {
					'type': 'wpcm_player',
					'season': '-1',
					'team': '-1',
					'position': '-1',
					'jobs': '-1',
					'orderby': 'name',
					'order': 'ASC',
					'title': '',
					'columns': '3'
					};
				var shortcode = '[players_gallery';
				
				for( var index in options) {
					
					var value = form.find('#option-' + index).val();
					
					
					// attaches the attribute to the shortcode only if it's different from the default value
					if ( value !== options[index] )
						shortcode += ' ' + index + '="' + value + '"';
				}
				
				shortcode += ']';
				
				// inserts the shortcode into the active editor
				tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
				
				// closes Thickbox
				tb_remove();
			});


})(jQuery);