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
        $decodedKey = resolve(HashidService::class)->decode($hashid, __CLASS__);

        return $this->where($this->getRouteKeyName(), $decodedKey)->first();
    }

    /**
     * Generate an encoded route key value.
     *
     * @return void
     */
    public function getEncodedRouteKeyAttribute()
    {
        $routeKey = parent::getRouteKey();

        return resolve(HashidService::class)->encode($routeKey, __CLASS__);
    }
}
