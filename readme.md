# markItUp

A simple bundle to integrate [markItUp!](http://markitup.jaysalvat.com/) universal markup jQuery editor

## Installation

```bsh
php artisan bundle:install markitup
```

## Publish assets
```bsh
php artisan bundle:publish markitup
```

Then edit your application/bundles.php file and add:

```php
return array(
	'markitup' => array(
		'location' => 'markitup',
		'auto' => 'true'
	)
);
```

