<?php
declare(strict_types=1);

namespace Elephox\Psr7;

use Elephox\Http\Contract\Stream as ElephoxStream;
use Elephox\Http\ResourceStream;
use Psr\Http\Message\StreamInterface as Psr7Stream;

class Stream implements Psr7Stream
{
    public static function toElephoxStream(Psr7Stream $psr7Stream): ElephoxStream
    {
        return new ResourceStream($psr7Stream->detach());
    }

    public function __construct(
        private ElephoxStream $stream
    )
    {
    }

    public function __toString()
    {
        return $this->stream->__toString();
    }

    public function close()
    {
        $this->stream->close();
    }

    public function detach()
    {
        return $this->stream->detach();
    }

    public function getSize()
    {
        return $this->stream->getSize();
    }

    public function tell()
    {
        return $this->stream->tell();
    }

    public function eof()
    {
        return $this->stream->eof();
    }

    public function isSeekable()
    {
        return $this->stream->isSeekable();
    }

    public function seek($offset, $whence = SEEK_SET)
    {
        $this->stream->seek($offset, $whence);
    }

    public function rewind()
    {
        $this->stream->rewind();
    }

    public function isWritable()
    {
        return $this->stream->isWritable();
    }

    public function write($string)
    {
        return $this->stream->write($string);
    }

    public function isReadable()
    {
        return $this->stream->isReadable();
    }

    public function read($length)
    {
        return $this->stream->read($length);
    }

    public function getContents()
    {
        return $this->stream->getContents();
    }

    public function getMetadata($key = null)
    {
        return $this->stream->getMetadata($key);
    }
}
