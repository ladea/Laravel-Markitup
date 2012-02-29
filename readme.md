# Markitup Bundle

A simple bundle to integrate [markItUp!](http://markitup.jaysalvat.com/) universal markup jQuery editor

## Installation

```bsh
php artisan bundle:install markitup
php artisan bundle:publish markitup
```

## Registration

To register Markitup bundle edit your application/bundles.php file and add:

```php
return array(
	'markitup' => array(
		'location' => 'markitup',
		'auto' => 'true'
	)
);
```

## Configuration

In bundle config/config.php you have to set all markup sets that you will use throughout your application.
You can also choose which theme you will use for your textarea editors.

## Usage

Give your textarea declaration a class that corresponds to one of the markup sets from bundle config file

```php
echo Form::textarea('somename', 'someinput', array('class' => 'markdown'));
```

or

```html
<textarea class="html" name="somename" rows="10" cols="50">someinput</textarea>
```

You can use more than one markup set. Declare all sets that you want to use in bundle config file

You will also have to output all assets from "footer" asset container somewhere in your layout. A good place is just before closing body tag

```php
<?php echo Asset::container('footer')->scripts(); ?>
<?php echo Asset::container('footer')->styles(); ?>
```