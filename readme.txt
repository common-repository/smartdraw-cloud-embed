=== SmartDraw Embed Shortcode ===
Contributors: SmartDraw
Tags: smartdraw, wordpress, embed
Requires at least: 4.0
Tested up to: 4.9.5
Stable tag: 4.4
License: MIT

This plugin allows the embedding of SmartDraw diagrams from SmartDraw Cloud using a simple [smartdraw] shortcode.

== Description ==

This plugin allows the embedding of [SmartDraw](https://www.smartdraw.com/ "The smartest way to draw anything") diagrams from [SmartDraw Cloud](https://cloud.smartdraw.com "SmartDraw Cloud") using a simple "[smartdraw]" shortcode.

The embed code for the diagram should be obtained from the Share->Embed dialog in SmartDraw Cloud.  In the dialog under "Embed Format" select "WordPress Shortcode".

The plugin also installs a TinyMCE 4.x plug-in that adds an "Insert SmartDraw Diagram" button to the editor toolbar.

== Installation ==

Install this plugin like any other.

Go to Admin > Plugins > Add New,  and search for SmartDraw in the plug-ins directory.


== Usage ==

Method 1: Embedding using TinyMCE 4.x Visual Editor SmartDraw Toolbar Button:

Get the WordPress embed code from the "Embed" dialog in SmartDraw Cloud, under the "Share" dropdown menu.

The embed code will look like:

FC31BA77EBD84A4E2B96F701A9ACB2BE424

Click the "Copy" button in the "Embed" dialog.

Open your WordPress page.

Click the "Insert SmartDraw Diagram" button in the editor commands toolbar.

Paste in the SmartDraw Share Code you copied, enter an optional caption, and select the toolbar style.

The plug-in will then generate the required WordPress short code and insert it into the page.

Method 2: Directly pasting a full WordPress Short Code into the TinyMCE 4.x Visual Editor

Get the full WordPress short code from the "Embed" dialog in SmartDraw Cloud, under the "Share" dropdown menu.

The full short code will look something like:

[smartdraw embed="doc=FC31BA77EBD84A4E2B96F701A9ACB2BE424&preview=
87213&unique=40330&mode=1&caption=Afghanistan Map"]

Click the "Copy" button in the "Embed" dialog.

Open your WordPress page.

Paste the full short code into the TinyMCE visual editor.

== Frequently Asked Questions ==


== Screenshots ==

1. Insert SmartDraw diagram button in visual editor toolbar.
2. Insert diagram modal, paste the embed code you copied from SmartDraw Cloud here.
3. Floorplan
4. Flowchart
5. Org Chart
6. Timeline

== Changelog ==
= 1.1 =
- Minor fixes
- Compatibility with latest Wordpress

= 1.01 =
- Fixed issue with close button not being visible
- Corrected spelling error in read-me

= 1.0 =
* Initial version

== Upgrade Notice ==

= 1.01 =
Minor fixes

= 1.1 =
Minor fixes and compatibility with latest Wordpress
