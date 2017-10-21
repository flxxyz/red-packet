<?php
namespace App\Common;

class File
{
    private $filename;

    function __construct($filename)
    {
        $this->filename = $filename;
    }

    public function get()
    {
        return file_get_contents($this->filename);
    }

    public function put(array $context)
    {
        return file_put_contents($this->filename, json_encode($context));
    }
}