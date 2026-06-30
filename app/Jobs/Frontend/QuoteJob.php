<?php

namespace App\Jobs\Frontend;

use App\Models\Quote;

class QuoteJob
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (!isset($this->data['id'])) {
            $this->data['id'] = null;
        }
        $data = Quote::firstOrNew(['id' => $this->data['id']]);
        
        $data->fill($this->data);

        $data->save();
    }
}
