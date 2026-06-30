<?php

namespace App\Jobs\Backend;

use App\Models\CategoryGroup;

class CategoryGroupJob
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
        $data = CategoryGroup::firstOrNew(['id' => $this->data['id']]);
        if(!isset($this->data['status'])) {
            $this->data['status'] = '0';
        } else {
            $this->data['status'] = '1';
        }
        $data->fill($this->data);

        if(isset($this->data['icon'])) {
            if($this->data['icon'] && !empty($this->data['_method'] ) && $this->data['_method'] == 'PATCH' && file_exists(public_path($data['icon']))) {
                
                try {
                    if($data['icon'] != '') {
                        unlink(public_path($data['icon']));
                    }
                } catch (Throwable $e) {
                    // return false;
                }
                
            }
            $icon = $this->data['icon'];
            $name = time(). '.' . $icon->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/category_groups');
            $icon->move($destinationPath, $name);
            $fileName = 'uploads/category_groups/' . $name;
            $data->icon = $fileName;
        }

        $data->save();
    }
}
