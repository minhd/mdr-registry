<?php


namespace App\Registry\ContentProvider;


abstract class ContentProvider
{
    abstract public function extract($payload);
}
