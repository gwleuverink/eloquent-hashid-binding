<?php

namespace Leuverink\HashidBinding;

trait HashidBinding
{
    public function initializeHashidBinding()
    {
        $this->append('encoded_route_key');
    }

    /**
     * Get the encoded value of the model's route key.
     *
     * @return mixed
     */
    public function getRouteKey()
    {
        return $this->encodedRouteKey;
    }

    /**
     * Retrieve the model for a bound encoded value.
     *
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($hashid)
    {
        $hashidService = resolve(\Leuverink\HashidBinding\HashidService::class);

        // Prevent empty string to be inserted in query
        if (! $decodedKey = $hashidService->decode($hashid)) {
            // TODO: Create a dedicated exception class or use RuntimeException?
            throw new \Exception('Unable to decode route key');
        }

        return $this->where($this->getRouteKeyName(), $decodedKey)->first();
    }

    /**
     * Generate an encoded route key value
     *
     * @return void
     */
    public function getEncodedRouteKeyAttribute()
    {
        $hashidService = resolve(\Leuverink\HashidBinding\HashidService::class);

        return $hashidService->encode(parent::getRouteKey());
    }
}