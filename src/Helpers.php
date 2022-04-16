<?php

/**
 * @param string $string
 * @return string
 */
function dropzoneBasePath($path = ''): string
{
    return __DIR__ . '/../' . $path;
}