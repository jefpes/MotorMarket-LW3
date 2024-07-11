<?php

namespace App\Traits;

trait Toast
{
    public ?string $icon;

    public ?string $msg;

    public function toastSuccess(string $msg): void
    {
        $this->msg  = $msg;
        $this->icon = 'icons.success';
        $this->dispatch('show-toast');
    }

    public function toastFail(string $msg): void
    {
        $this->msg  = $msg;
        $this->icon = 'icons.fail';
        $this->dispatch('show-toast');
    }
}
