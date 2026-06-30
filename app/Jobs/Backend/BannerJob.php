<?php

namespace App\Jobs\Backend;

use App\Models\Banner;

class BannerJob
{

    /**
     * Create a new job instance.
     *
     * @return void
     */
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
        $data = Banner::firstOrNew(['id' => $this->data['id']]);
        
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
            $destinationPath = public_path('/uploads/banners');
            $image->move($destinationPath, $name);
            $fileName = 'uploads/banners/' . $name;
            $data->image = $fileName;
        }

        $data->save();
    }
}
