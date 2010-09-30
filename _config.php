<?php

/**
* Set to disable the module without removing it
* @param bool $disable_update  
*/
$disable_meta_manager = 0;

if(!$disable_meta_manager){
	/**
   * Register the extension
   */ 
	Object::add_extension('SiteTree', 'MetaManagerDataDecorator');

	/**
	 * Set wether to disable the annoying update url popup
	 * You probably don't want to change your everytime a title change. Google don't like that.
	 * Edit : SS does change the urls and throws a 301 permanently moved header
	 * Changed to hide the popup, but do alter the url.
	 * @param bool $disable_update_popup  
	 */
	MetaManagerDataDecorator::set_disable_update_popup(1);
	
	/**
	* Set wether to update the urlsegment
	* @param bool $update_url  
	*/
	MetaManagerDataDecorator::set_update_url(1);
	
	/**
	 * Set wether to update the MetaTitle with Pagetitle
	 * @param bool $update_meta_title 
	 */
	MetaManagerDataDecorator::set_update_meta_title(1); 
	
	/**
	 * Set wether to update the MetaDescription
	 * @param bool $update_meta_desc 
	 */
	MetaManagerDataDecorator::set_update_meta_desc(1);
	
	/**
	 * Set MetaDescription length
	 * Use 0 to limit the length by SS default 255 chars
	 * @param int $meta_desc_length (max 255 by SS default) 
	 */
	MetaManagerDataDecorator::set_meta_desc_length(252); 
	
	/**
	 * Set wether to update the MetaKeywords
	 * @param bool $update_meta_keys
	 */
	MetaManagerDataDecorator::set_update_meta_keys(1); 
	
	/**
	 * Set the amount of keywords to insert in the MetaKeywords field
	 * @param int $keyword_amount 
	 */
	MetaManagerDataDecorator::set_keyword_amount(15);
	
	/**
	 * Set the minimum wordlenght for MetaKeywords
	 * @param int $min_word_char 
	 */
	MetaManagerDataDecorator::set_min_word_char(4);
	
	/**
	 * Set the words to exlude seperate with comma e.g: the, at, when, etc
	 * @param string $exclude_words 
	 */
	
	// english and swedish
	MetaManagerDataDecorator::set_exclude_words('about, again, also, been, before, cause, come, could, does, each, even, from, give, have, here, just, like, made, many, most, much, must, only, other, said, same, should, since, some, such, tell, than, that, their, them, then, there, these, they, thing, this, through, very, want, well, were, what, when, where, which, while, will, with, within, would, your, att, även, ber, bli, blir, den, denna, denne, dessutom, det, detta, dig, din, ditt, dock, där, eller, ett, ett, får, för, från, går, ger, har, hos, inte, kan, kommer, med, men, och, också, oss, samt, sitt, ska, skall, skulle, som, stå, säger, tar, tas, till, vår, våra, vårt, vara, vid, vill');
	 
	/**
	 * Set wether to hide the ExtraMeta field
	 * @param bool $hide_extra_meta 
	 */
	MetaManagerDataDecorator::set_hide_extra_meta(1);

	/**
	 * Show the update checkbox
	 * @param bool $show_checkbox
	 */
	MetaManagerDataDecorator::set_show_checkbox(1);
	
	/**
	 * Position checkbox at tab e.g. : "Root.Content.Main" or "Root.Content.Metadata" (default)
	 * @param string $checkbox_tab
	 */
	MetaManagerDataDecorator::set_checkbox_tab("Root.Content.Metadata");
	
	/**
	 * Position checkbox above e.g. : "Content", "Title" or "MenuTitle"
	 * Leave empty to show the checkbox below the Contentfield
	 * @param string $checkbox_pos
	 */
	MetaManagerDataDecorator::set_checkbox_pos("");
	
	/**
	 * Show wich Meta fields wil be updated. set_show_checkbox must bu enabled
	 * @param bool $show_meta_messages 
	 */
	MetaManagerDataDecorator::set_show_meta_messages(0);

	/**
	 * Set the default state of generate checkbox in content tab
	 * @param bool $checkbox_state 1 or 0
	 */
	MetaManagerDataDecorator::set_checkbox_state(1);

	/**
	 * Set to hide the metatab
	 * @param bool $hide_meta_tab 
	 * TODO add js files for updating the urlsegment field
	 * does not work!!!!!!!
	 */
	//MetaManagerDataDecorator::set_hide_meta_tab(0);
}