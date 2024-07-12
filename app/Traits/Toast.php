<?php

namespace App\Traits;

trait Toast
{
    public ?string $icon = null;

    public ?string $msg = null;

    protected function toast(string $msg, string $icon): void
    {
        $this->msg  = $msg;
        $this->icon = $icon;
        $this->dispatch('show-toast');
    }

    public function toastSuccess(string $msg): void
    {
        $this->toast($msg, 'icons.success');
    }

    public function toastFail(string $msg): void
    {
        $this->toast($msg, 'icons.fail');
    }
}
