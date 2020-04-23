<?php


namespace App\Interfaces;


interface RecordsEvents
{
    public function releaseEvents(): array;

    public function clearRecordedEvent(): void;
}
