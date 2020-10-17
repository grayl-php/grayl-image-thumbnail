<?php

namespace Grayl\Image\Thumbnail\Controller;

use Grayl\File\Controller\FileController;
use Grayl\Image\Thumbnail\Entity\ThumbnailData;
use Grayl\Image\Thumbnail\Service\ThumbnailService;

/**
 * Class ThumbnailController
 * The controller for working with thumbnails
 *
 * @package Grayl\Image\Thumbnail
 */
class ThumbnailController
{

    /**
     * An ThumbnailFile entity for the thumbnail's source image
     *
     * @var FileController
     */
    private FileController $source_image;

    /**
     * An ThumbnailFile entity for the thumbnail's destination image
     *
     * @var FileController
     */
    private FileController $destination_image;

    /**
     * The ThumbnailData instance to interact with
     *
     * @var ThumbnailData
     */
    private ThumbnailData $thumbnail_data;

    /**
     * The ThumbnailService instance to interact with
     *
     * @var ThumbnailService
     */
    private ThumbnailService $thumbnail_service;


    /**
     * The class constructor
     *
     * @param FileController   $source_image      A FileController entity for the thumbnail's source image
     * @param FileController   $destination_image A FileController entity for the thumbnail's destination image
     * @param ThumbnailData    $thumbnail_data    The ThumbnailData instance to work with
     * @param ThumbnailService $thumbnail_service The ThumbnailService instance to use
     */
    public function __construct(
        FileController $source_image,
        FileController $destination_image,
        ThumbnailData $thumbnail_data,
        ThumbnailService $thumbnail_service
    ) {

        // Set the controller data
        $this->source_image      = $source_image;
        $this->destination_image = $destination_image;
        $this->thumbnail_data    = $thumbnail_data;

        // Set the service entity
        $this->thumbnail_service = $thumbnail_service;
    }


    /**
     * Gets the full source image path
     *
     * @return string
     */
    public function getFullSourcePath(): string
    {

        // Use the service to get the full path
        return $this->source_image->getFullPath();
    }


    /**
     * Gets the full destination image path
     *
     * @return string
     */
    public function getFullDestinationPath(): string
    {

        // Use the service to get the full path
        return $this->destination_image->getFullPath();
    }


    /**
     * Creates the actual thumbnail file
     *
     * @return bool
     */
    public function makeThumbnail(): bool
    {

        // Use the service to make the thumbnail
        return $this->thumbnail_service->makeThumbnail(
            $this->source_image,
            $this->destination_image,
            $this->thumbnail_data
        );
    }

}