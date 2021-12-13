<?php
declare(strict_types=1);

namespace Elephox\Psr7;

use Elephox\Http\Contract\Url as ElephoxUrl;
use Elephox\Http\CustomUrlScheme;
use Elephox\Http\Url;
use Elephox\Http\UrlScheme;
use JetBrains\PhpStorm\Pure;
use Psr\Http\Message\UriInterface as Psr7Uri;

class Uri implements Psr7Uri
{
    #[Pure] public static function toElephox(Psr7Uri $uri): ElephoxUrl
    {
        $scheme = $uri->getScheme();
        [$username, $password] = explode(':', $uri->getUserInfo(), 2) + [1 => ''];
        $host = $uri->getHost();
        $port = $uri->getPort();
        $path = $uri->getPath();
        $query = $uri->getQuery();
        $fragment = $uri->getFragment();

        return new Url(
            empty($scheme) ? null : $scheme,
            empty($username) ? null : $username,
            empty($password) ? null : $password,
            empty($host) ? null : $host,
            $port,
            $path,
            empty($query) ? null : $query,
            empty($fragment) ? null : $fragment
        );
    }

    #[Pure] public function __construct(
        protected ElephoxUrl $url
    ) {
    }

    #[Pure] public function getScheme()
    {
        return $this->url->getUrlScheme()->value;
    }

    #[Pure] public function getAuthority()
    {
        return $this->url->getAuthority();
    }

    #[Pure] public function getUserInfo()
    {
        return $this->url->getUserInfo();
    }

    #[Pure] public function getHost()
    {
        return $this->url->getHost();
    }

    #[Pure] public function getPort()
    {
        return $this->url->getPort();
    }

    #[Pure] public function getPath()
    {
        return $this->url->getPath();
    }

    #[Pure] public function getQuery()
    {
        return $this->url->getQuery();
    }

    #[Pure] public function getFragment()
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
        return $this->url->withUserInfo($user, $password);
    }

    public function withHost($host)
    {
        return $this->url->withHost($host);
    }

    public function withPort($port)
    {
        return $this->url->withPort($port);
    }

    public function withPath($path)
    {
        return $this->url->withPath($path);
    }

    public function withQuery($query)
    {
        return $this->url->withQuery($query);
    }

    public function withFragment($fragment)
    {
        return $this->url->withFragment($fragment);
    }

    public function __toString()
    {
        return (string)$this->url;
    }
}
