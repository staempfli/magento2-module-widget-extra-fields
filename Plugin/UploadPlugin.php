<?php
/**
 * UploadPlugin
 *
 * @copyright Copyright © 2019 Staempfli AG. All rights reserved.
 * @author    florian.auderset@staempfli.com
 */
namespace Staempfli\WidgetExtraFields\Plugin;

class UploadPlugin
{
    public function aroundCheckMimeType($subject, \Closure $proceed, $validTypes = [])
    {
        $allowedMimeTypesFme = [
            'image/jpg',
            'image/jpeg',
            'image/gif',
            'image/png',
            'application/pdf',
            'video/mp4'
        ];

        return $proceed($allowedMimeTypesFme);
    }
}