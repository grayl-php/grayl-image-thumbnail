<?php

namespace Grayl\Test\Image\Thumbnail;

use Grayl\Image\Thumbnail\Controller\ThumbnailController;
use Grayl\Image\Thumbnail\ThumbnailPorter;
use PHPUnit\Framework\TestCase;

/**
 * Test class for the Thumbnail package
 *
 * @package Grayl\Image\Thumbnail
 */
class ThumbnailControllerTest extends
    TestCase
{

    /**
     * Tests the creation of a valid ThumbnailController and sub classes
     *
     * @return ThumbnailController
     */
    public function testCreateThumbnailController(): ThumbnailController
    {

        // Request a new ThumbnailController
        $thumbnail = ThumbnailPorter::getInstance()
            ->newThumbnailController(
                __DIR__ . '/data/test.png',
                __DIR__ . '/data/test-thumb.png',
                '150',
                '150',
                'center'
            );

        // Check the type of object returned
        $this->assertInstanceOf(
            ThumbnailController::class,
            $thumbnail
        );

        // Return the entity
        return $thumbnail;
    }


    /**
     * Tests the generation of the thumbnail image
     *
     * @param ThumbnailController $thumbnail The ThumbnailController to generate
     *
     * @depends testCreateThumbnailController
     */
    public function testMakeThumbnail(ThumbnailController $thumbnail): void
    {

        // First, delete the thumbnail file if it exists from a previous test
        if (file_exists($thumbnail->getFullDestinationPath())) {
            // Delete it
            unlink($thumbnail->getFullDestinationPath());
        }

        // Make the thumbnail
        $thumbnail->makeThumbnail();

        // Make sure the thumbnail file exists
        $this->assertTrue(file_exists($thumbnail->getFullDestinationPath()));
    }

}
