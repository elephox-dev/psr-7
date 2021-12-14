<?php
declare(strict_types=1);

namespace Elephox\Psr7;

use Elephox\Http\Contract\Cookie;
use Elephox\Http\Contract\ServerRequest as ElephoxServerRequest;
use Elephox\Http\Contract\UploadedFile as ElephoxUploadedFile;
use JetBrains\PhpStorm\Pure;
use Psr\Http\Message\ServerRequestInterface as Psr7ServerRequest;

class ServerRequest extends Request implements Psr7ServerRequest
{
    #[Pure] public function __construct(
        private ElephoxServerRequest $serverRequest
    ) {
        parent::__construct($this->serverRequest);
    }

    public function getServerParams()
    {
        return $this->serverRequest->getServerParamsMap()->asArray();
    }

    public function getCookieParams()
    {
        return $this->serverRequest->getCookies()->map(fn (Cookie $cookie) => (string)$cookie)->asArray();
    }

    public function withCookieParams(array $cookies)
    {
        // TODO: Implement withCookieParams() method.
    }

    public function getQueryParams()
    {
        return $this->serverRequest->getUrl()->getQueryMap()->asArray();
    }

    public function withQueryParams(array $query)
    {
        // TODO: Implement withQueryParams() method.
    }

    public function getUploadedFiles()
    {
        return $this->serverRequest->getUploadedFiles()->map(fn(ElephoxUploadedFile $uploadedFile) => new UploadedFile($uploadedFile))->asArray();
    }

    public function withUploadedFiles(array $uploadedFiles)
    {
        // TODO: Implement withUploadedFiles() method.
    }

    public function getParsedBody()
    {
        return $this->serverRequest->getParsedBody();
    }

    public function withParsedBody($data)
    {
        // TODO: Implement withParsedBody() method.
    }

    public function getAttributes()
    {
        // TODO: Implement getAttributes() method.
    }

    public function getAttribute($name, $default = null)
    {
        // TODO: Implement getAttribute() method.
    }

    public function withAttribute($name, $value)
    {
        // TODO: Implement withAttribute() method.
    }

    public function withoutAttribute($name)
    {
        // TODO: Implement withoutAttribute() method.
    }
}
