<?php

namespace App\Jobs\Backend;

use App\Models\MasterOption;
use App\Models\MasterOptionAttribute;

class MasterOptionJob
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
        
        $data = MasterOption::firstOrNew(['id' => $this->data['id']]);
        
        if(!isset($this->data['status'])) {
            $this->data['status'] = '0';
        } else {
            $this->data['status'] = '1';
        }
        $data->fill($this->data);
        
        $data->save();
        $keepAtributes = [];
        if(!empty($this->data['attributes'])) {
            foreach ($this->data['attributes']['attributes'] as $key => $value) {
                $updated = MasterOptionAttribute::updateOrCreate([
                    'id' => $value['master_option_attribute_id']
                ], [
                    'value' => $value['value'],
                    'master_option_id' => $data['id'],
                ]);
                $keepAtributes[] = $updated['id'];
            }
        }
        if(isset($this->data['id'])) {
            MasterOptionAttribute::where('master_option_id', $data['id'])->get()->each(function($row) use($keepAtributes) {
                if(!in_array($row->id, $keepAtributes)) {
                    $row->delete();
                }
            });
        }
    }
}
