<?php

namespace Leuverink\HashidBinding;

use Hashids\HashidsInterface;

class HashidService
{
    private $hashids;

    public function __construct(HashidsInterface $hashids)
    {
        $this->hashids = $hashids;
    }

    /**
     * Encodes the given parameter
     *
     * @param mixed $key
     * @return string
     */
    public function encode($key)
    {
        return $this->hashids->encode($key);
    }

    /**
     * Decodes the given hashid
     *
     * @param string $hashid
     * @return mixed
     */
    public function decode($hashid)
    {
        return $this->hashids->decode($hashid)[0];
    }
}
