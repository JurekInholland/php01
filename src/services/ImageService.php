<?php

class ImageService {

    // Max size: 2 MB
    protected static $maxSize = 2 * 10e6;

    // Allow jpg, png and gif
    protected static $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];

    // Delete images that are neither referenced as post image nor user avatar.
    public static function deleteStaleImages() {
        $sql = "DELETE cms_images FROM cms_images
                LEFT JOIN cms_posts ON cms_posts.post_image = cms_images.image_id
                LEFT JOIN cms_users ON cms_users.profile_image = cms_images.image_id
                WHERE id IS NULL AND post_id IS NULL";
        App::get("db")->query($sql);
    }

    // Get ids of images that are neither referenced as post image nor user avatar.
    public static function getStaleImageIds() {
        $sql = "SELECT cms_images.* FROM cms_images
                LEFT JOIN cms_posts ON cms_posts.post_image = cms_images.image_id
                LEFT JOIN cms_users ON cms_users.profile_image = cms_images.image_id
                WHERE id IS NULL AND post_id IS NULL";
        return App::get("db")->query($sql);
    }

    public static function upload(array $image) {

        // $image = $_FILES['image'];
        
        // die(var_dump($image));

        try {
            self::validateUpload($image);

            $img = self::moveImage($image);

            return ["id" => $img->getId(), "filename" => $img->getFilename()];


        // Catch and return exception occuring during validation
        } catch (Exception $e) {
            return ["error" => $e];
        }

    }

    private static function storeImageRef(Image $img) {
        $sql = "INSERT INTO cms_images (image_id, filename, extension) VALUES
        (:image_id, :filename, :extension)";

        $params = [":image_id" => $img->getId(), ":filename" => $img->getFilename(), ":extension" => $img->getExtension()];
        App::get("db")->query($sql, $params);

    }

    private function moveImage(array $image) {
        $img = new Image(["filename" => $image["name"]]);
        move_uploaded_file($image["tmp_name"], $img->getLink());
        self::storeImageRef($img);
        return $img;

        
    }

    private static function validateUpload(array $image) {
        self::fileExists($image);
        self::hasErrors($image);
        self::fileSize($image);
        self::isImage($image);
        self::mimeType($image);
    }

    private static function fileExists(array $image) {
        if (empty($image)) {
            throw new Exception("No file was submitted.");
        }
    }

    private static function hasErrors(array $image) {
        if ($image['error'] !== 0) {
            throw new Exception("Error during file upload: {$image["error"]}");
        }
    }

    private static function fileSize(array $image) {
        if ($image["size"] > self::$maxSize) {
            throw new Exception("File size exceeds maximum.");
        }
    }

    private static function isImage(array $image) {
        if (! getimagesize($image['tmp_name'])) {
            throw new Exception("Invalid file type");
        }
    }

    private static function mimeType(array $image) {
        $mimeType = getimagesize($image["tmp_name"])["mime"];

        if (!in_array($mimeType, self::$allowedMimeTypes)) {
            throw new Exception("Only jpg, png and gif are allowed file types.");
        }
    }
}