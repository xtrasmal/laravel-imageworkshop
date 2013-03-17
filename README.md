Laravel PHP ImageWorkshop
=====================
PHP class using GD library to work easily with images as layers (like Photoshop or GIMP)

This is an awesome library for handling images. 

here is an example of how I use it to store an image from a FORM upload
and how I resized it AND stored it. 

===INSTALLATION===

Open bundles.php and add this

```php
'imageworkshop' => array('auto' => true),
```
===DOCUMENTATION===

http://phpimageworkshop.com/documentation.html

===USAGE===

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