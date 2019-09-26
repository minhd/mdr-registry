<?php

namespace App\Events;

use App\Registry\Models\Record;
use App\Registry\Models\Version;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class RecordCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Record
     */
    public $record;

    /**
     * @var Version
     */
    private $version;

    /**
     * Create a new event instance.
     *
     * @param Record $record
     * @param Version $version
     */
    public function __construct(Record $record, Version $version)
    {
        $this->record = $record;
        $this->version = $version;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
