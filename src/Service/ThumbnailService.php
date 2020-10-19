<?php

   namespace Grayl\Image\Thumbnail\Service;

   use Grayl\File\Controller\FileController;
   use Grayl\Image\Thumbnail\Entity\ThumbnailData;

   /**
    * Class ThumbnailService
    * The service for working with ThumbnailData entities
    * TODO: This library needs better error handling and status checking for sub functions that create/modify images
    *
    * @package Grayl\Image\Thumbnail
    */
   class ThumbnailService extends PHPThumbService
   {

      /**
       * Determines if a file is a PNG based on its extension
       *
       * @param string $filename The complete path to the file
       *
       * @return bool
       */
      public function isFilePNG ( string $filename ): bool
      {

         // If it is a PNG
         if ( $this->getFileExtension( $filename ) == 'png' ) {
            // Match
            return true;
         }

         // Not a PNG
         return false;
      }


      /**
       * Determines if a file is a JPEG based on its extension
       *
       * @param string $filename The complete path to the file
       *
       * @return bool
       */
      public function isFileJPEG ( string $filename ): bool
      {

         // Get the extension
         $extension = $this->getFileExtension( $filename );

         // If it is a JPEG
         if ( $extension == 'jpg' || $extension == 'jpeg' ) {
            // Match
            return true;
         }

         // Not a JPEG
         return false;
      }


      /**
       * Returns the extension of a file
       *
       * @param string $filename The path or filename to get the file extension of
       *
       * @return string
       */
      public function getFileExtension ( string $filename ): string
      {

         // Return the file extension
         return strtolower( pathinfo( $filename,
                                      PATHINFO_EXTENSION ) );
      }


      /**
       * Compresses a PNG image
       *
       * @param string $filename The complete path to the PNG file
       * @param int    $amount   The level of compression from 0 (lowest) to 10 (highest)
       *
       * @return bool
       */
      public function compressPNGImage ( string $filename,
                                         int $amount ): bool
      {

         // If it's not a PNG...
         if ( ! $this->isFilePNG( $filename ) ) {
            // Not a PNG
            return false;
         }

         // Load the image
         $image = imagecreatefrompng( $filename );

         // Compress it and return the result as bool
         return imagepng( $image,
                          $filename,
                          $amount );
      }


      /**
       * Makes a thumbnail from a ThumbnailData entity
       *
       * @param FileController $source_image      An FileController entity for the thumbnail's source image
       * @param FileController $destination_image An FileController entity for the thumbnail's destination image
       * @param ThumbnailData  $thumbnail_data    The ThumbnailData entity to use
       *
       * @return bool
       */
      public function makeThumbnail ( FileController $source_image,
                                      FileController $destination_image,
                                      ThumbnailData $thumbnail_data ): bool
      {

         // Use the extended classes to generate a thumbnail image
         $this->resizeImage( $source_image->getFullPath(),
                             $destination_image->getFullPath(),
                             $this->getFileExtension( $destination_image->getFilename() ),
                             $thumbnail_data->getWidth(),
                             $thumbnail_data->getHeight(),
                             $thumbnail_data->getAxis() );

         // For a PNG, compress the thumbnail
         if ( $this->isFilePNG( $destination_image->getFilename() ) ) {
            // Compress the PNG
            $this->compressPNGImage( $destination_image->getFullPath(),
                                     $thumbnail_data->getCompression() );
         }

         // Success
         return true;
      }

   }