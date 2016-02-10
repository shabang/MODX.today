<?php


/**
 * We use getimagesizefromstring for grabbing image sizes before cropping, but that method is 5.4+ so we use this polyfill
 */
if (!function_exists('getimagesizefromstring')) {
    function getimagesizefromstring($string_data)
    {
        $uri = 'data://application/octet-stream;base64,'  . base64_encode($string_data);
        return getimagesize($uri);
    }
}

/**
 * Class mgImageCrop
 */
class mgImageCrop extends xPDOSimpleObject
{
    /**
     * Returns the URL (or path when $path is true) to the thumbnail for this crop.
     *
     * @param modMediaSource $source
     * @param string $relativeUrl
     * @param bool $returnPath
     * @return bool|string
     */
    public function getThumb(modMediaSource $source, $relativeUrl = '', $returnPath = false)
    {
        $thumbnail = $this->get('thumbnail');
        $lastHash = $this->get('thumbnail_hash');
        $currentHash = $this->getThumbHash();

        $changed = ($lastHash != $currentHash);
        if (empty($thumbnail) || $changed) {
            $source->createContainer($relativeUrl . '_thumbs/' , '/');
            $source->errors = array();

            /** @var mgImage $image */
            $image = $this->getOne('Image');
            if (!$image)
            {
                return false;
            }

            if (!empty($thumbnail))
            {
                $source->removeObject($relativeUrl . $thumbnail);
            }

            $extension = pathinfo($image->get('file'), PATHINFO_EXTENSION);
            $cropInfo = $this->xpdo->moregallery->getCropInfo($this->get('crop'), $image->get('resource'));
            $file = $source->getObjectContents($relativeUrl . $image->get('file'));
            $newImage = $this->createThumbnail($file['content'], $cropInfo, $extension);
            $thumbFilename = strtolower($this->get('crop')) . '_' . pathinfo($image->get('file'), PATHINFO_FILENAME) . '.' . $extension;

            $source->createObject($relativeUrl . '_thumbs/', $thumbFilename, $newImage);
            $this->set('thumbnail', '_thumbs/' . $thumbFilename);
            $this->set('thumbnail_hash', $this->getThumbHash());
            $this->save();

            if ($source->hasErrors())
            {
                $this->xpdo->log(xPDO::LOG_LEVEL_ERROR, 'Error(s) while creating image crops: ' . $this->xpdo->toJSON($source->getErrors()), '', __METHOD__, __FILE__, __LINE__);
            }
        }

        if ($returnPath)
        {
            return $this->getPath($source, $relativeUrl, $this->get('thumbnail'));
        }
        return $this->getUrl($source, $relativeUrl, $this->get('thumbnail'));
    }

    /**
     * Creates a simple hash for the thumbnail so we can update it when it's no longer valid
     *
     * @return string
     */
    public function getThumbHash()
    {
        $x = $this->get('x');
        $y = $this->get('y');
        $x2 = $this->get('x2');
        $y2 = $this->get('y2');
        $width = $this->get('width');
        $height = $this->get('height');

        $data = $x . 'x' . $y . '-' . $x2 . 'x' . $y2 . '-' . $width . 'x' . $height;
        $hash = md5(md5($data)); // We're not really trying to be cryptographically secure or anything
        return $hash;
    }

    /**
     * @param $image
     * @param array $cropInfo
     * @param string $extension
     * @return string
     */
    public function createThumbnail($image, array $cropInfo = array(), $extension = 'png')
    {
        // Try to extend the time we have to execute in case of long running processing
        $timeSpent = (microtime(true) - $this->xpdo->startTime);
        if ($timeSpent > 25)
        {
            set_time_limit(15);
        }
        // Increase the memory limit too
        $this->xpdo->moregallery->setMemoryLimit();

        $width = $this->get('width');
        $height = $this->get('height');

        $originalSize = getimagesizefromstring($image);
        $originalWidth = $originalSize[0];
        $originalHeight = $originalSize[1];

        /**
         * If there is no width or height, we need to calculate that ourselves.
         *
         * The strategy here is that we probably have an aspect defined on the crop, and we can use that to crop
         * the image to that particular aspect ratio.
         *
         * Later, we also apply resizing to the resulting image if necessary and defined on the crop.
         */
        if ($width < 1 || $height < 1)
        {
            $aspect = false;
            if (isset($cropInfo['default_aspect']))
            {
                $aspect = $cropInfo['default_aspect'];
            }
            elseif (isset($cropInfo['aspect']))
            {
                $aspect = $cropInfo['aspect'];
            }

            // If we have an aspect ratio, we use that to calculate the proper size
            if ($aspect !== false)
            {

                // Calculate the height based on the width, and the width based on the height, using the crop defined aspect ratio
                $heightBasedWidth = floor($originalHeight * $aspect);
                $widthBasedHeight = floor($originalWidth / $aspect);

                // If the height, derived from the width * aspect, is within the image height we assume the width
                // stays the same, and we only crop from the height.
                if ($widthBasedHeight <= $originalHeight)
                {
                    $width = $originalWidth;
                    $height = $widthBasedHeight;
                    // As the height changes, we take the difference in height, divide it by 2, and set y to that
                    $y = floor(($originalHeight - $widthBasedHeight) / 2);
                    $this->set('y', $y);
                    $this->set('y2', $originalHeight - $y);
                    $this->set('x2', $originalWidth);
                }
                // Otherwise, we assume the height stays the same and we crop from the width instead.
                else
                {
                    $height = $originalHeight;
                    $width = $heightBasedWidth;
                    // As we're changing the width, we take the difference divided by 2 to set x
                    $x = floor(($originalWidth - $heightBasedWidth) / 2);
                    $this->set('x', $x);
                    $this->set('x2', $originalWidth - $x);
                    $this->set('y2', $originalHeight);
                }
                $this->set('width', $width);
                $this->set('height', $height);
            }
            // If we don't have an aspect ratio, we just set the x2, y2, width and height values to the full image
            // in the next step of processing, that will be resized to a defined width or height if necessary.
            else
            {
                $this->set('x2', $originalWidth);
                $this->set('y2', $originalHeight);
                $this->set('width', $originalWidth);
                $this->set('height', $originalHeight);
            }

        }


        /**
         * Using the included phpthumb lib we crop the image.
         */
        try {
            require_once dirname(dirname(dirname(__FILE__))).'/model/phpthumb/ThumbLib.inc.php';
            $thumb = PhpThumbFactory::create($image, array(), true);

            // If we're dealing with a PNG, setting the format like this ensures the image keeps transparency/alpha
            if ($extension === 'png') {
                $thumb->setFormat('PNG');
            }

            // Crop the image from the $x and $y defined, for a size of $width and $height.
            $x = $this->get('x');
            $x2 = $this->get('x2');
            $y = $this->get('y');
            $y2 = $this->get('y2');
            if ($x === 0 && $x2 === $originalWidth && $y === 0 && $y2 === $originalHeight)
            {
                // We don't need to crop to the full image - it's already full!
            }
            else {
                $thumb->crop($x, $y, $x2 - $x, $y2 - $y);
            }

            /**
             * Grab the crop properties on the crop and see if it includes a width or a height.
             * If it does, we'll want to resize the image to that particular width or height (or both)
             */
            $resizeHeight = 0;
            $resizeWidth = 0;
            foreach ($cropInfo as $key => $val) {
                if ($key == 'width') {
                    $resizeWidth = (int)$val;
                }
                if ($key == 'height') {
                    $resizeHeight = (int)$val;
                }
            }

            // Do the resizing. This is done after the cropping so we're working with the cropped version and not the original.
            if ($resizeWidth > 0 || $resizeHeight > 0)
            {
                $thumb->resize($resizeWidth, $resizeHeight);
                $dimensions = $thumb->getCurrentDimensions();
                $this->set('width', $dimensions['width']);
                $this->set('height', $dimensions['height']);
            }

            // Return the image as string.
            return $thumb->getImageAsString();
        } catch (Exception $e) {
            $this->xpdo->log(xPDO::LOG_LEVEL_ERROR, '[moreGallery] Exception while creating thumbnail: ' . $e->getMessage());
            return $e->getMessage();
        }
    }

    /**
     * Grabs the URL for the file
     *
     * @param modMediaSource $source
     * @param $relativeUrl
     * @param $file
     * @return string
     */
    public function getUrl(modMediaSource $source, $relativeUrl, $file)
    {
        return $source->getObjectUrl($relativeUrl . $file);
    }

    /**
     * Grabs the Path for the file
     *
     * @param modMediaSource $source
     * @param $relativeUrl
     * @param $file
     * @return string
     */
    public function getPath(modMediaSource $source, $relativeUrl, $file)
    {
        return $source->getBasePath() . $relativeUrl . $file;
    }
}
