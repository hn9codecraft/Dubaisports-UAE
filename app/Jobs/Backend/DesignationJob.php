<?php

namespace App\Jobs\Backend;

use App\Models\Designation;

class DesignationJob
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
        $data = Designation::firstOrNew(['id' => $this->data['id']]);
        
        if(!isset($this->data['status'])) {
            $this->data['status'] = '0';
        } else {
            $this->data['status'] = '1';
        }
        
        $data->fill($this->data);

        $data->save();
    }
}
