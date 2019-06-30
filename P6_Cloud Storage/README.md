# Dropbox Cloud Storage

The goal of this project is to develop a photo-album application that uses cloud storage. More specifically, you will use the Dropbox API to create a photo album, in which you can upload, delete, and browse photographs.


You will develop a trivial photo-album application on Dropbox. Your task is to modify your album.php script in your project6 directory to support the following operations:

* Provide a form to upload a new image (a *.jpg). Look at the class slides for a PHP example that handles uploads.
* A display window that lists the names of the images in your dropbox directory. For each image name you have a link that, when you click it, it downloads and displays the image in the image section. Each image name also has a button to delete this image from the dropbox storage.
* An image section that displays the current image. You can change the image by changing the src attribute value of the <img ...> element (you don't need Ajax; you just need to generate javascript from your album.php).

Note that the images that you display/delete are those stored in your cse5335_xyz1234 dropbox directory. You should not display any local images.