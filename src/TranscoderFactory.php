<?php

namespace Leuverink\HashidBinding;

use Hashids\HashidsInterface;

class TranscoderFactory
{
    /**
     * The transcoder classname.
     *
     * @var string
     */
    protected $transcoder;

    /**
     * An unique string the trnascoder's salt is appended with.
     *
     * @var string
     */
    protected $saltModifier;

    /**
     * The length of the encoded string.
     *
     * @var int
     */
    protected $padding;

    public function __construct(string $transcoderClass, string $saltModifier, int $padding)
    {
        $this->transcoder = $transcoderClass;
        $this->$saltModifier = $saltModifier;
        $this->padding = $padding;
    }

    /**
     * Creates a new transcoder instance.
     *
     * @param string $salt
     * @param padding $padding
     * @return HashidsInterface
     */
    public function create($salt): HashidsInterface
    {
        return new $this->transcoder($salt.$this->saltModifier, $this->padding);
    }
}
