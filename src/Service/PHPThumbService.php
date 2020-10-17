<?php

namespace Grayl\Image\Thumbnail\Service;

use PHPThumb\GD;

/**
 * Abstract class PHPThumbService
 * The service for working with the PHPThumb library
 * This is extended by ThumbnailService
 *
 * @package Grayl\Image\Thumbnail
 */
abstract class PHPThumbService
{

    /**
     * Creates a new GD instance for an image
     *
     * @param string $source The complete file path to the source image
     *
     * @return GD
     */
    public function newGD(string $source): GD
    {

        // Return a new PHPThumbGD entity
        return new GD(
            $source,
            []
        );
    }


    /**
     * Formats a given quadrant into a PHPThumb quadrant properly
     *
     * @param string $quadrant The quadrant to format
     *
     * @return string
     */
    private function formatQuadrant(string $quadrant): string
    {

        // Convert the axis to lowercase
        $axis = strtolower($quadrant);

        // Find the match
        switch ($axis) {
            // Left
            case 'l':
            case 'left':
                return 'L';
            // Right
            case 'r':
            case 'right':
                return 'R';
            // Top
            case 't':
            case 'top':
                return 'T';
            // Bottom
            case 'b':
            case 'bottom':
                return 'B';
            // Center
            case 'c':
            case 'center':
            default:
                return 'C';
        }
    }


    /**
     * Creates a resized image and saves it
     *
     * @param string $source_file      The complete file path to the source image
     * @param string $destination_file The complete file path to the generated thumbnail
     * @param string $format           The file type of the generated thumbnail ( png, jpg )
     * @param int    $width            The desired width of the new image in pixels
     * @param int    $height           The desired height of the new image in pixels
     * @param string $quadrant         The alignment of the thumbnail over the main image ( L, R, T, B, C )
     *
     * @return bool
     */
    public function resizeImage(
        string $source_file,
        string $destination_file,
        string $format,
        int $width,
        int $height,
        string $quadrant
    ): bool {

        // Create a new PHPThumb object for this image
        $image = $this->newGD($source_file);

        // Perform an adaptive resize
        $image->adaptiveResizeQuadrant(
            $width,
            $height,
            $this->formatQuadrant($quadrant)
        );

        // Save the new image
        $image->save(
            $destination_file,
            $format
        );

        // Success
        return true;
    }

}