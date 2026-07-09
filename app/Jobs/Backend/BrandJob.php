<?php

namespace App\Jobs\Backend;

use App\Models\Brand;
use Throwable;

class BrandJob
{
    protected $data;

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

        $data = Brand::firstOrNew(['id' => $this->data['id']]);

        // Capture fields except image initially
        $fields = $this->data;
        if (isset($fields['image'])) {
            unset($fields['image']);
        }

        $data->fill($fields);

        // Handle Image Upload
        if (isset($this->data['image']) && is_object($this->data['image'])) {
            // Delete old image if updating
            $rawImage = $data->getAttributes()['image'] ?? '';
            if ($rawImage && file_exists(public_path($rawImage))) {
                try {
                    unlink(public_path($rawImage));
                } catch (Throwable $e) {
                    // Ignore deletion failure
                }
            }

            $image = $this->data['image'];
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/brands');
            
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $name);
            $data->image = 'uploads/brands/' . $name;
        }

        $data->save();
    }
}
