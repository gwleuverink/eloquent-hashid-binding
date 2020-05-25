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
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     * @param  string|null  $field
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($hashid, $field = null)
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
