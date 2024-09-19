<?php

namespace App\Events;

use App\Models\Products;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SaveProductEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $product;
    public $data;
    public $images;
    public function __construct($data,$images,$create=true)
    {
        $this->data=$data;
        $this->images=$images;
        if($create){
            $this->data['supplier_id']=auth()->id();
        }
        $this->product=Products::query()->updateOrCreate([
            'id'=>$this->data['id']??null
        ],$this->data);

        // Attach or update product categories
        if (isset($this->data['categories'])) {
            // `sync()` will update the categories for the product, adding new and removing missing ones
            $this->product->categories()->sync($this->data['categories']);
        }
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
