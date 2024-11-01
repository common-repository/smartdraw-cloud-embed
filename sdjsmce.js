/*
Plugin Name: SmartDraw Shortcode for Wordpress
Plugin URI: http://smartdraw.com
Description: This plugin allows the embedding of SmartDraw diagrams from SmartDraw Cloud using a simple [smartdraw] shortcode.
Version: 1.0
Author: SmartDraw Software LLC
Author URI: http://smartdraw.com
License: MIT
*/

/*
Copyright (c) 2016 SmartDraw Software LLC

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
"Software"), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be included
in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

(function() {

	tinymce.PluginManager.add('sdjs_my_mce_button', function( editor, url ) {
		
		editor.on('init', function() {

			var cssURL = url + '/sdjsmce.css';

			if(document.createStyleSheet){

				document.createStyleSheet(cssURL);

			} else {

				var cssLink = editor.dom.create('link', {
				            rel: 'stylesheet',
				            href: cssURL
				          });

				document.getElementsByTagName('head')[0].
				          appendChild(cssLink);

			}
		});

		editor.addButton('sdjs_my_mce_button', {
			text: '',
			tooltip: 'Insert SmartDraw Diagram',
			icon: 'smartdrawplugin',
			type: 'button',
			onclick: function() {
        		// Generate a random value to disambiguate multiple copies of the same diagram in the same page 
        		var theRand = Math.floor(Math.random() * 100000) + 1;

				editor.windowManager.open( {
					title: 'Embed SmartDraw Diagram',
					width: 530,
   					height: 160,
					body: [
						{
							type: 'textbox',
							name: 'textbox',
							label: 'SmartDraw Share Code',
							value: ''
						},
						{
							type: 'textbox',
							name: 'caption',
							label: 'Caption',
							value: ''
						},
						{
							type: 'listbox',
							name: 'listbox',
							label: 'Toolbar Style',
							'values': [
								{text: 'Always Show', value: '0'},
								{text: 'Auto-Hide', value: '1'},
							]
						}
					],
					onsubmit: function( e ) {
						// Get the embed code from the URI parameters
						var theEmbedCode = e.data.textbox;

						// If this is a share code, parse out the share token
						//http://devcloud.smartdraw.com/share.aspx/?pubDocShare=B3C99EBAD1108CBEF3ED829D29DA9539AFF
						if (theEmbedCode.indexOf("http://cloud.smartdraw.com/share.aspx/?pubDocShare=") === 0){
							theEmbedCode = theEmbedCode.substring(theEmbedCode.length - 35);
						}

						editor.insertContent( '[smartdraw embed="doc='+theEmbedCode+'&unique='+theRand+'&mode='+e.data.listbox+'&caption='+e.data.caption+'"]');
					}
				});
			}
		});
	});
})();
