# imghardchache

imghardchache creates thumbs of images on disk.


To create a thumb, call the URL of the original image (e.g. `/test.jpg`) with an `__` and the size in pixel
(`/test__255.jpg`).

imghardchache is using the [ErrorDocument 404](http://httpd.apache.org/docs/2.2/mod/core.html#ErrorDocument) of an non existing thumb and creates it with `hardcache.php`.

There is no cache clearing, to overwrite your thumbs remove all thumbs.

## Settings

You can change:

* a directory with original images (`$originalname = "original/" ;`)
* a directory for thumb images (`$requestedname = "mini/" ;" `)
