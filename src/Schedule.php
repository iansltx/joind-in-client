<?php

namespace iansltx\JoindInClient;

class Schedule implements \Countable
{
    protected $events;

    public function fromParsedJson(array $json) : self
    {
        return new static(array_map(function($data) : Event {
            return new Event(
                \DateTimeImmutable::createFromFormat(DATE_ATOM, $data['start_date']),
                \DateTimeImmutable::createFromFormat(DATE_ATOM, $data['start_date'])
                    ->add(new \DateInterval('PT' . ($data['duration'] / 60 ) . 'M')),
                $data['talk_title'],
                $data['talk_description']
            );
        }, $json['talks']));
    }

    /**
     * @param Event[] $events
     */
    public function __construct(array $events)
    {
        $this->events = $events;
    }

    public function count()
    {
        return count($this->events);
    }

    public function filter(callable $filter) : Schedule
    {
        return new static(array_filter($this->events, $filter));
    }

    /**
     * Returns a new schedule containing only events that start at or after $now
     *
     * @param \DateTimeInterface $now
     * @return Schedule
     */
    public function filterOutBefore(\DateTimeInterface $now) : Schedule
    {
        return $this->filter(function(Event $event) use ($now) {
            return $event->getStartsAt() >= $now;
        });
    }

    /**
     * @return Event[]
     */
    public function getEvents() : array
    {
        return $this->events;
    }

    public function first() : Event
    {
        if (!isset($this->events[0])) {
            throw new NoMoreEventsException;
        }
        return $this->events[0];
    }

    public function second() : Event
    {
        if (!isset($this->events[1])) {
            throw new NoMoreEventsException;
        }
        return $this->events[1];
    }
}
