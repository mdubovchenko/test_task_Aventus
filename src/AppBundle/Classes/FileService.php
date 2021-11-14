<?php

namespace AppBundle\Classes;

use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class FileService
 * @package AppBundle\Classes
 */
class FileService
{
    /** @var Filesystem  */
    private $fsObject;
    /** @var string  */
    private $filePath;
    /** @var string  */
    const PATH = '/joke/joke.txt';

    public function __construct()
    {
        $this->fsObject = new Filesystem();
        $this->filePath = getcwd() . self::PATH;
    }

    /**
     * @param string $joke
     */
    public function createFile(string $joke)
    {
        try {
            $this->fsObject->dumpFile($this->filePath, $joke);

        } catch (IOExceptionInterface $exception) {
            echo "Error creating file at " . $exception->getPath();
        }
    }

}