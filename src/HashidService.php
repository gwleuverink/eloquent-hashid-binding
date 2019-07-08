<?php

namespace Leuverink\HashidBinding;

use Hashids\HashidsInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HashidService
{
    private $transcoder;

    public function __construct(TranscoderFactory $transcoderFactory)
    {
        $this->transcoder = $transcoderFactory;
    }

    /**
     * Encodes the given parameter
     *
     * @param int|string $key
     * @param int|string $salt
     * @return string
     */
    public function encode($key, $salt)
    {
        $transcoder = $this->transcoder->create($salt);
        return $transcoder->encode($key);
    }

    /**
     * Decodes the given hashid
     *
     * @param string $hashid
     * @param int|string $salt
     * @return mixed
     */
    public function decode($hashid, $salt)
    {
        $transcoder = $this->transcoder->create($salt);
        
        if (! $hashArray = $transcoder->decode($hashid)) {
            // The hash could not be decoded.
            throw new NotFoundHttpException(); // TODO: It might be better to change this into a ModelNotFoundException?
        }
        
        return $hashArray[0];
    }
}
