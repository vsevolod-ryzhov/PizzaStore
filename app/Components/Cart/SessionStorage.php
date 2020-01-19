<?php


namespace App\Components\Cart;

use Illuminate\Session\Store;

class SessionStorage implements StorageInterface
{
    private $session;
    private $key;

    public function __construct(Store $session, $key)
    {
        $this->session = $session;
        $this->key = $key;
    }

    public function load()
    {
        return $this->session->get($this->key) ?? [];
    }

    public function save($items)
    {
        if (empty($items)) {
            $this->session->forget($this->key);
        } else {
            $this->session->put($this->key, $items);
        }
    }
}
