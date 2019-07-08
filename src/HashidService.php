<?php

namespace Leuverink\HashidBinding;

use Hashids\HashidsInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HashidService
{
    private $saltModifier;
    private $padding;

    public function __construct(string $saltModifier, int $padding)
    {
        $this->saltModifier = $saltModifier;
        $this->padding = $padding;
    }

    /**
     * Encodes the given parameter
     *
     * @param mixed $key
     * @return string
     */
    public function encode($key, $salt)
    {
        $hashids = $this->createHashidsInstance($salt);

        return $hashids->encode($key);
    }

    /**
     * Decodes the given hashid
     *
     * @param string $hashid
     * @return mixed
     */
    public function decode($hashid, $salt)
    {
        $hashids = $this->createHashidsInstance($salt);
        
        if (! $hashArray = $hashids->decode($hashid)) {
            // The hash could not be decoded.
            throw new NotFoundHttpException(); // TODO: It might be better to change this into a ModelNotFoundException?
        }
        
        return $hashArray[0];
    }

    // Extract this to a factory class
    private function createHashidsInstance($salt)
    {
        return new \Hashids\Hashids($salt . $this->saltModifier, $this->padding);
    }
}
