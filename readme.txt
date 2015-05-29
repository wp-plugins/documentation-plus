=== Documentation Plus ===
	Contributors: paratheme
	Donate link: http://paratheme.com
	Tags: Documentation Plus, Documentation, Document , Doc,
	Requires at least: 3.8
	Tested up to: 4.2.2
	Stable tag: 1.0
	License: GPLv2 or later
	License URI: http://www.gnu.org/licenses/gpl-2.0.html

	Quick & easy Documentation creator

== Description ==

Documentation Plus is easy to create documentation for your software, bootstrap and font awesome support to create awesome documentation. By this plugin you can create unlimited documentation and display via short-code support pagination, thumbnails, awesome icon for title & list items.




###  Documentation Plus by http://paratheme.com

* [Live Demo!&raquo;](http://paratheme.com/documentation/)



<strong>Plugin Features</strong><br />

* Fully responsive and mobile ready.
* Unlimited Documentation anywhere.
* Use via short-code.
* Easy input field for Documentation content.
* Archive for Documentation via short-code.
* Bootstrap & font awesome icon.
* Sorting for documentation section.
* WP Editor for section.





== Installation ==

1. Install as regular WordPress plugin.<br />
2. Go your plugin setting via WordPress Dashboard and find "<strong>Documentation Plus</strong>" activate it.<br />

After activate plugin you will see "Documentation" menu at left side on WordPress dashboard click "New Documentation " and use the options field "Documentation Options"<br />

<br />
<strong>How to use on page or post</strong><br />
When Documentation options setup done please publish Documentation<br />

and then copy shortcode from top of <strong>Documentation Options</strong> `[documentation_plus  id="1234" ]`<br />

then paste this shortcode anywhere in your page to display Documentation<br />


<strong>Display on single page(single.php)</strong><br />

Simply copy you single.php and rename single-documentation.php 

remove the fucntion `the_content();` or `get_the_content();` and replace with `<?php echo do_shortcode("[documentation_plus id='".get_the_ID()."' ]"); ?>`



<strong>Display documentation archive </strong><br />
you can display all documentation via archive with pagination support. use following short-code to display arcive

`[documentation_plus_archive]`

this short-code also has some parameter

# title_icon , use for font awesome icon or html, ex: `&lt;i class="fa fa-file-text-o"&gt;&lt;/i&gt; `
# list_icon , use for font awesome icon or html, ex: `&lt;i class="fa fa-file-text-o"&gt;&lt;/i&gt; `
# section_display , yes or no
# posts_per_page , integer value, default 5.



== Screenshots ==

1. screenshot-1
2. screenshot-2
3. screenshot-3
4. screenshot-4



== Changelog ==


	= 1.0 =
    * 28/05/2015 Initial release.
