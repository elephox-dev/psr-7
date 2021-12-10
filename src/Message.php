<?php
declare(strict_types=1);

namespace Elephox\Psr7;

use Elephox\Http\Contract\HttpMessage as ElephoxMessage;
use Elephox\Http\HeaderMap;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\StreamInterface;

class Message implements MessageInterface
{
    public function __construct(
        protected ElephoxMessage $message
    ) {
    }

    public function getProtocolVersion()
    {
        return $this->message->getProtocolVersion();
    }

    public function withProtocolVersion($version)
    {
        return $this->message->withProtocolVersion($version);
    }

    public function getHeaders()
    {
        return $this->message->getHeaderMap()->asArray();
    }

    public function hasHeader($name)
    {
        $headerName = HeaderMap::parseHeaderName($name);

        return $this->message->hasHeaderName($headerName);
    }

    public function getHeader($name)
    {
        $headerName = HeaderMap::parseHeaderName($name);

        return $this->message->getHeaderName($headerName)->asArray();
    }

    public function getHeaderLine($name)
    {
        $headerName = HeaderMap::parseHeaderName($name);

        return $this->message->getHeaderName($headerName)->join(", ");
    }

    public function withHeader($name, $value)
    {
        $headerName = HeaderMap::parseHeaderName($name);

        return $this->message->withHeaderName($headerName, $value);
    }

    public function withAddedHeader($name, $value)
    {
        $headerName = HeaderMap::parseHeaderName($name);

        return $this->message->withAddedHeaderName($headerName, $value);
    }

    public function withoutHeader($name)
    {
        $headerName = HeaderMap::parseHeaderName($name);

        return $this->message->withoutHeaderName($headerName);
    }

    public function getBody()
    {
        return $this->message->getBody();
    }

    public function withBody(StreamInterface $body)
    {
        return $this->message->withBody(Stream::toElephoxStream($body));
    }
}
