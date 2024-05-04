<?php

class LoggedDevice
{
    public function getDevice(): string
    {
//        $device = $this->agent->device();

//        return $device ?: 'not_identified';

        return 'not_identified';
    }

    public function isMobile(): bool
    {
        return false;
    }
}