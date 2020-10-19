<?php

   namespace Grayl\Image\Thumbnail\Entity;

   /**
    * Class ThumbnailData
    * The entity for thumbnails
    *
    * @package Grayl\Image\Thumbnail
    */
   class ThumbnailData
   {

      /**
       * The desired width of the thumbnail in pixels
       *
       * @var int
       */
      private int $width;

      /**
       * The desired height of the thumbnail in pixels
       *
       * @var int
       */
      private int $height;

      /**
       * The alignment of the thumbnail over the main image ( left, right, top, bottom, center )
       *
       * @var string
       */
      private string $axis;

      /**
       * The compression of the thumbnail in percent (i.e. "80" for 80%)
       *
       * @var int
       */
      private int $compression;


      /**
       * The class constructor
       *
       * @param int    $width       The desired width of the new image in pixels
       * @param int    $height      The desired height of the new image in pixels
       * @param string $axis        The alignment of the thumbnail over the main image ( left, right, top, bottom, center )
       * @param int    $compression The compression of the thumbnail in percent (i.e. "80" for 80%)
       */
      public function __construct ( int $width,
                                    int $height,
                                    string $axis,
                                    int $compression )
      {

         // Set the class data
         $this->setWidth( $width );
         $this->setHeight( $height );
         $this->setAxis( $axis );
         $this->setCompression( $compression );
      }


      /**
       * Gets the width
       *
       * @return int
       */
      public function getWidth (): int
      {

         // Return it
         return $this->width;
      }


      /**
       * Sets the width
       *
       * @param int $width The desired width of the thumbnail in pixels
       */
      public function setWidth ( int $width ): void
      {

         // Set the width
         $this->width = $width;
      }


      /**
       * Gets the height
       *
       * @return int
       */
      public function getHeight (): int
      {

         // Return it
         return $this->height;
      }


      /**
       * Sets the height
       *
       * @param int $height The desired height of the thumbnail in pixels
       */
      public function setHeight ( int $height ): void
      {

         // Set the height
         $this->height = $height;
      }


      /**
       * Gets the axis
       *
       * @return string
       */
      public function getAxis (): string
      {

         // Return it
         return $this->axis;
      }


      /**
       * Sets the axis
       *
       * @param string $axis The alignment of the thumbnail over the main image ( left, right, top, bottom, center )
       */
      public function setAxis ( string $axis ): void
      {

         // Set the axis
         $this->axis = $axis;
      }


      /**
       * Gets the compression amount
       *
       * @return int
       */
      public function getCompression (): int
      {

         // Return it
         return $this->compression;
      }


      /**
       * Sets the compression
       *
       * @param int $compression The compression of the thumbnail in percent (i.e. "80" for 80%)
       */
      public function setCompression ( int $compression ): void
      {

         // Set the compression
         $this->compression = $compression;
      }

   }