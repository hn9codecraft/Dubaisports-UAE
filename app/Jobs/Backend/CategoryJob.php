<?php

namespace App\Jobs\Backend;

use App\Models\Category;

class CategoryJob
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
        $data = Category::firstOrNew(['id' => $this->data['id']]);
        
        if(!isset($this->data['status'])) {
            $this->data['status'] = '0';
        } else {
            $this->data['status'] = '1';
        }
        
        $data->fill($this->data);

        if(isset($this->data['image'])) {
            if($this->data['image'] && !empty($this->data['_method'] ) && $this->data['_method'] == 'PATCH' && file_exists(public_path($data['image']))) {
                
                try {
                    if($data['image'] != '') {
                        unlink(public_path($data['image']));
                    }
                } catch (Throwable $e) {
                    // return false;
                }
                
            }
            $image = $this->data['image'];
            $name = time(). '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/categories');
            $image->move($destinationPath, $name);
            $fileName = 'uploads/categories/' . $name;
            $data->image = $fileName;
        }

        $data->save();
    }
}
