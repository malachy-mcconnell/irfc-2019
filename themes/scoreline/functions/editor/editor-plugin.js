(function($) {
    tinymce.create('tinymce.plugins.CPPlayers', {
        
        init : function(ed, url) {

            ed.addButton('cp_players', {
                title : 'Insert Players Gallery',
                onclick : function() {
					// triggers the thickbox
					var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
					W = W - 80;
					H = H - 84;
					tb_show( 'Players Gallery', 'admin-ajax.php?action=cp_players_shortcode&width=' + W + '&height=' + H );
				}
            });
        },    
    });
 
    // Register plugin
    tinymce.PluginManager.add( 'cp_players', tinymce.plugins.CPPlayers );

    // handles the click event of the submit button
			$('body').on('click', '#cp_players-form #option-submit', function() {
				form = $('#cp_players-form');
				// defines the options and their default values
				// again, this is not the most elegant way to do this
				// but well, this gets the job done nonetheless
				var options = { 
					'season': '-1',
					'team': '-1',
					'position': '-1',
					'orderby': 'number',
					'order': 'ASC',
					'title': ''
					};
				var shortcode = '[cp_players';
				
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