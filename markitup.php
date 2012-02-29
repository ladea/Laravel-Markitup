<?php

/**
* @package Markitup Bundle
* @license http://www.opensource.org/licenses/mit MIT License
* @copyright Webvision, Inc. 2012
* @author Guardian <guardian@mail.bg>
*/

//Get config options
$sets = Config::get('markitup::config.sets');
$skin = Config::get('markitup::config.skin');

//Add scripts to the footer container. You need to render this assets somewhere in your view
//<code>
//		echo Asset::container('footer')->scripts();
//		echo Asset::container('footer')->styles();
//</code>
$assets = Asset::container('footer');
$assets->bundle('markitup');
$assets->add('jquery', 'jquery.js'); //Checks to see if jQuery is loaded and loads it if it's not
$assets->add('markitup', 'markitup/jquery.markitup.js', 'jquery');

//Making sure config option points to existing skin
if (File::exists(Bundle::path('public') . 'bundles' . DS . 'markitup' . DS . 'markitup' . DS . 'skins' . DS . $skin . DS . 'style.css'))
{
	$assets->add('skin', 'markitup/skins/' . $skin . '/style.css');
}

//Making sure config options points to existing sets
foreach ($sets as $set)
{
	$js_path = Bundle::path('public') . 'bundles' . DS . 'markitup' . DS . 'markitup' . DS . 'sets' . DS . $set . DS . 'set.js';
	$css_path = Bundle::path('public') . 'bundles' . DS . 'markitup' . DS . 'markitup' . DS . 'sets' . DS . $set . DS . 'style.css';

	if (File::exists($js_path) && File::exists($css_path))
	{
		$assets->add($set . 'js', 'markitup/sets/' . $set . '/set.js', array('jquery', 'markitup'));
		$assets->add($set . 'css', 'markitup/sets/' . $set . '/style.css');
	}
}

$assets->add('settings', 'settings.js', array('jquery', 'markitup'));