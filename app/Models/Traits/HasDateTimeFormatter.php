<?php

namespace App\Models\Traits;
trait HasDateTimeFormatter
{
    protected function serializeDate(\DateTimeInterface $date): string
    {
        return $date->format($this->getDateFormat());
    }
}
