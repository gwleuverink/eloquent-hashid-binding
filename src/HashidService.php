<?php

namespace Leuverink\HashidBinding;

use Hashids\HashidsInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        if (! $hashArray = $this->hashids->decode($hashid)) {
            // The hash could not be decoded.
            throw new NotFoundHttpException(); // TODO: It might be better to change this into a ModelNotFoundException?
        }
        
        return $hashArray[0];
    }
}
