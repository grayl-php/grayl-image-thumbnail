<?php

namespace Grayl\Image\Thumbnail;

use Grayl\Config\ConfigPorter;
use Grayl\Config\Controller\ConfigController;
use Grayl\File\FilePorter;
use Grayl\Image\Thumbnail\Controller\ThumbnailController;
use Grayl\Image\Thumbnail\Entity\ThumbnailData;
use Grayl\Image\Thumbnail\Service\ThumbnailService;
use Grayl\Mixin\Common\Traits\StaticTrait;

/**
 * Front-end for the Thumbnail package
 *
 * @package Grayl\Image\Thumbnail
 */
class ThumbnailPorter
{

    // Use the static instance trait
    use StaticTrait;

    /**
     * The name of the config file for the image package
     *
     * @var string
     */
    private string $config_file = 'image.thumbnail.php';

    /**
     * The config instance for the image package
     *
     * @var ConfigController
     */
    private ConfigController $config;


    /**
     * The class constructor
     *
     * @throws \Exception
     */
    public function __construct()
    {

        // Create the config instance from the config file
        $this->config = ConfigPorter::getInstance()
            ->newConfigControllerFromFile($this->config_file);
    }


    /**
     * Creates a new ThumbnailController instance
     *
     * @param string $source_image      The path to the original source image
     * @param string $destination_image The path to the thumbnail's destination image
     * @param int    $width             The desired width of the new image in pixels
     * @param int    $height            The desired height of the new image in pixels
     * @param string $axis              The alignment of the thumbnail over the main image ( left, right, top, bottom, center )
     *
     * @return ThumbnailController
     */
    public function newThumbnailController(
        string $source_image,
        string $destination_image,
        int $width,
        int $height,
        string $axis
    ): ThumbnailController {

        // Create the FileControllers for source and destination files
        $source_file      = FilePorter::getInstance()
            ->newFileController(
                $source_image
            );
        $destination_file = FilePorter::getInstance()
            ->newFileController(
                $destination_image
            );

        // Create a new ThumbnailData instance
        $thumbnail_data = new ThumbnailData(
            $width,
            $height,
            $axis,
            $this->config->getConfig('compression')
        );

        // Return a new ThumbnailController
        return new ThumbnailController(
            $source_file,
            $destination_file,
            $thumbnail_data,
            new ThumbnailService()
        );
    }

}