<?php
declare(strict_types=1);

namespace Elephox\Psr7;

use Elephox\Http\Contract\UploadedFile as ElephoxUploadedFile;
use Elephox\Stream\ResourceStream;
use Psr\Http\Message\UploadedFileInterface as Psr7UploadedFile;

class UploadedFile implements Psr7UploadedFile
{
    public function __construct(
        private ElephoxUploadedFile $uploadedFile
    ) {
    }

    public function getStream()
    {
        return new Stream($this->uploadedFile->getStream());
    }

    public function moveTo($targetPath)
    {
        $stream = ResourceStream::fromFile($targetPath, false, true, true);
        $stream->write($this->uploadedFile->getStream()->getContents());
    }

    public function getSize()
    {
        return $this->uploadedFile->getSize();
    }

    public function getError()
    {
        return $this->uploadedFile->getError()->value;
    }

    public function getClientFilename()
    {
        return $this->uploadedFile->getClientFilename();
    }

    public function getClientMediaType()
    {
        return $this->uploadedFile->getClientMimeType()?->getValue();
    }
}
