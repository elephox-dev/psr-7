<?php
declare(strict_types=1);

namespace Elephox\Psr7;

use Elephox\Http\Contract\Url as ElephoxUrl;
use Elephox\Http\CustomUrlScheme;
use Elephox\Http\UrlScheme;
use Psr\Http\Message\UriInterface as Psr7Uri;

class Uri implements Psr7Uri
{
    public function __construct(
        protected ElephoxUrl $url
    ) {
    }

    public function getScheme()
    {
        return $this->url->getUrlScheme()->value;
    }

    public function getAuthority()
    {
        return $this->url->getAuthority();
    }

    public function getUserInfo()
    {
        return $this->url->getUserInfo();
    }

    public function getHost()
    {
        return $this->url->getHost();
    }

    public function getPort()
    {
        return $this->url->getPort();
    }

    public function getPath()
    {
        return $this->url->getPath();
    }

    public function getQuery()
    {
        return $this->url->getQuery();
    }

    public function getFragment()
    {
        return $this->url->getFragment();
    }

    public function withScheme($scheme)
    {
        $urlScheme = UrlScheme::tryFrom($scheme);
        $urlScheme ??= new CustomUrlScheme($scheme);

        return $this->url->withScheme($urlScheme);
    }

    public function withUserInfo($user, $password = null)
    {
        // TODO: Implement withUserInfo() method.
    }

    public function withHost($host)
    {
        // TODO: Implement withHost() method.
    }

    public function withPort($port)
    {
        // TODO: Implement withPort() method.
    }

    public function withPath($path)
    {
        // TODO: Implement withPath() method.
    }

    public function withQuery($query)
    {
        // TODO: Implement withQuery() method.
    }

    public function withFragment($fragment)
    {
        // TODO: Implement withFragment() method.
    }

    public function __toString()
    {
        return (string)$this->url;
    }
}
