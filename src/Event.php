<?php

namespace iansltx\JoindInClient;

class Event implements \JsonSerializable
{
    protected $startsAt;
    protected $endsAt;
    protected $title;
    protected $desc;

    public function __construct(\DateTimeImmutable $startsAt, \DateTimeImmutable $endsAt, string $title, string $desc)
    {
        $this->startsAt = $startsAt;
        $this->endsAt = $endsAt;
        $this->title = $title;
        $this->desc = $desc;
    }

    public function getStartsAt() : \DateTimeImmutable
    {
        return $this->startsAt;
    }

    public function getEndsAt() : \DateTimeImmutable
    {
        return $this->endsAt;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function getDescription() : string
    {
        return $this->desc;
    }

    function jsonSerialize()
    {
        return $this->title . ' on ' . $this->startsAt->format('l') . ' at ' . $this->startsAt->format('g:i A');
    }

    public function __toString()
    {
        return $this->jsonSerialize();
    }
}
