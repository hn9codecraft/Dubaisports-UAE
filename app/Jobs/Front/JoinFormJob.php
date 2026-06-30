<?php

namespace App\Jobs\Front;

use App\Models\UserDetail;

class JoinFormJob
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
        $data = UserDetail::firstOrNew(['id' => $this->data['id']]);
        
        $data->fill($this->data);
        
        $data->save();
    }
}
