Laravel PHP ImageWorkshop
=========================

PHP Image Workshop is an open source class using GD library that helps you to manage images with PHP.  This class is thought like photo editing software (Photoshop, GIMP...): you can superimpose many layers or even layer groups, each layer having a background image.
It makes the class the most flexible ever !

For what ?
==========
It is thought to do simple tasks like creating thumbnails or pasting watermarks and also to do more complex tasks (multiple superimpositions, images positioning...).

What you can do with: 
=================
-    pasting an image (or multiple) on another one, 
-    cropping, 
-    moving, 
-    resizing, 
-    rotating, 
-    superposing, 
-    writing...

How it works ?
==============
An ImageWorkshopLayer object could be 2 different things depending on how you want to use it:
###### a  layer: 
this is a rectangle which has a transparent background image by default and where you can paste images (from your hard drive or an upload form...) on its background.
######a group layer: 
a layer that includes multiple sublayers at different level in its stack, all leveled on the top of its background. If you perform an action on the group, all its sublayers (and subgroups) will be affected !

Understand that an ImageWorkshop object is a layer AND a group at the same time, unlike Photoshop (a group doesn't have a background): it has got a background image (transparent by default) and a stack of sublayers (empty by default) on the top of its background.

When you have finished manipulating your layers, you just have to execute a method to get the merged image of all layer backgrounds !

Installation
============

```php
php artisan bundle:install imageworkshop
```
Open bundles.php and add this

```php
'imageworkshop' => array('auto' => true),
```

Documentation
=============
http://phpimageworkshop.com/documentation.html

Usage example
=============

```php
	public function post_upload()
	{
		$input = Input::all();
		$user = Auth::user();
		$image = Input::file('headshot');
		$layer = PHPImageWorkshop\ImageWorkshop::initFromPath($image['tmp_name']);

		$dirPath = path('storage').'/uploads/thumbnails/avatars/';
		$filename = Auth::user()->id. uniqid($image['size']) .'.jpg';
		$createFolders = true;
		$backgroundColor = null; // transparent, only for PNG (otherwise it will be white if set null)
		$imageQuality = 100; // useless for GIF, usefull for PNG and JPEG (0 to 100%)
		$layer->resizeInPixel(377, 310, true, 0, 0, 'MM');
		$layer->save($dirPath, $filename, $createFolders, $backgroundColor, $imageQuality);

		$user->headshot = $filename;
		$user->headshot_file = $image['name'];
		$user->save();

		return Redirect::to('/');

	}
```
Ofcourse it could be much nicer. But Im still learing. Nevertheless, this whole PHP ImageWorkshop 
works like a charm! 

Fork if you understand autoloading, because I still do not. I needed this library
because Thumbnailable and other thumbnail bundles where not making me happy.

I did not create the library, I just made it into a bundle. 
Created by http://phpimageworkshop.com/