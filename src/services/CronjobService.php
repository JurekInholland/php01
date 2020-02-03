<?php

class CronjobService {

    public static function doTasks() {
        try {
            self::cleanupImages();
            $status = 0;
        } catch(Exception $e) {
            $status = 1;
        }
        self::logExecution($status);
    }

    private static function logExecution(int $status) {
        $sql = "INSERT INTO cms_jobs (status) VALUES (:status)";

        $params = [":status" => $status];

        App::get("db")->query($sql, $params);
    }

    private static function cleanupImages() {

        $images = ImageService::getStaleImageIds();

        // Delete images from hdd
        foreach ($images as $image) {
            $img = new Image($image);
            $img->delete();
        }

        // Delete database references of images
        ImageService::deleteStaleImages();
    }

    public function getCronjobKey() {
        $sql = "SELECT cronjob_key FROM cms_settings LIMIT 1";
        $res = App::get("db")->query($sql);
        return $res[0]["cronjob_key"];
    }

    public function getJobLogs() {
        $sql = "SELECT * FROM cms_jobs";
        return App::get("db")->query($sql);
    }
}