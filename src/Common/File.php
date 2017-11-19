<?php
namespace Radpack\Common;

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

    public function put($array = [])
    {
        return file_put_contents($this->filename, json_encode($array));
    }
}