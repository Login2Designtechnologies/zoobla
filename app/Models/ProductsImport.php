<?php



namespace App\Models;



use App\Models\Product;

use App\Models\ProductStock;

use App\Models\User;

use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Maatwebsite\Excel\Concerns\WithValidation;

use Illuminate\Support\Collection;

use Maatwebsite\Excel\Concerns\ToCollection;

use Illuminate\Support\Str;

use Auth;

use Carbon\Carbon;

use Storage;



//class ProductsImport implements ToModel, WithHeadingRow, WithValidation

class ProductsImport implements ToCollection, WithHeadingRow, WithValidation, ToModel

{

    private $rows = 0;



    public function collection(Collection $rows)

    {

        $canImport = true;

        $user = Auth::user();

        if ($user->user_type == 'seller' && addon_is_activated('seller_subscription')) {

            if ((count($rows) + $user->products()->count()) > $user->shop->product_upload_limit

                || $user->shop->package_invalid_at == null

                || Carbon::now()->diffInDays(Carbon::parse($user->shop->package_invalid_at), false) < 0

            ) {

                $canImport = false;

                flash(translate('Please upgrade your package.'))->warning();

            }

        }



        if ($canImport) {

            foreach ($rows as $row) {

                $approved = 1;

                if ($user->user_type == 'seller' && get_setting('product_approve_by_admin') == 1) {

                    $approved = 0;

                }



                $productId = Product::create([

                    'name' => $row['product_name'],

                    'category' => $row['category'],

                    'added_by' => $user->user_type == 'seller' ? 'seller' : 'admin',

                    'user_id' => $user->user_type == 'seller' ? $user->id : User::where('user_type', 'admin')->first()->id,

                    'approved' => $approved,

                    'brand' => $row['brand'],

                    'unit' => $row['unit'],

                    'weight_in_kg' => $row['weight_in_kg'],

                    'minimum_purchase_qty' => $row['minimum_purchase_qty'],

                    'video_compression_format' => $row['video_compression_format'],

                    'application' => $row['application'],

                    'resolution' => $row['resolution'],

                    'lens' => $row['lens'],

                    'warranty' => $row['warranty'],

                    'function' => $row['function'],

                    'sensor' => $row['sensor'],

                    'data_storage_options' => $row['data_storage_options'],

                    'keyword' => $row['keyword'],

                    'feature' => $row['feature'],

                    'image_sensor' => $row['image_sensor'],

                    'color' => $row['color'],

                    'battery' => $row['battery'],

                    'local_storage' => $row['local_storage'],

                    'field_of_view' => $row['field_of_view'],

                    'homebase_compatibility' => $row['homebase_compatibility'],

                    'resolution2' => $row['resolution2'],

                    'waterproof' => $row['waterproof'],

                    'battery_capacity' => $row['battery_capacity'],

                    'storage' => $row['storage'],

                    'other_product_des' => $row['other_product_des'],
                    
                    'video_provider' => $row['video_provider'],

                    'video_link' => $row['video_link'],
                    
                    'crystal_clear_detail_hedding' => $row['crystal_clear_detail_hedding'],

                    'crystal_clear_detail_details' => $row['crystal_clear_detail_details'],
                    
                    'zoobla_secure_plan_hedding' => $row['zoobla_secure_plan_hedding'],

                    'zoobla_secure_plan_hedding_details' => $row['zoobla_secure_plan_hedding_details'],
                    
                    'security_solution_top_hedding' => $row['security_solution_top_hedding'],

                    'security_solution_hedding' => $row['security_solution_hedding'],
                    
                    'security_solution_description' => $row['security_solution_description'],

                    'professional_security_top_hedding' => $row['professional_security_top_hedding'],
                    
                    'professional_security_hedding' => $row['professional_security_hedding'],

                    'professional_security_description' => $row['professional_security_description'],
                    
                    'professional_security_details' => $row['professional_security_details'],

                    'home_security_top_hedding' => $row['home_security_top_hedding'],
                    
                    'home_security_hedding' => $row['home_security_hedding'],

                    'product_description_top_hedding' => $row['product_description_top_hedding'],
                    
                    'product_description_hedding' => $row['product_description_hedding'],

                    'product_description_short_title' => $row['product_description_short_title'],
                    
                    'product_description_long_title' => $row['product_description_long_title'],

                    'easy_to_recharge_heading' => $row['easy_to_recharge_heading'],
                    
                    'easy_to_recharge_description' => $row['easy_to_recharge_description'],

                    'smart_home_heading' => $row['smart_home_heading'],
                    
                    'smart_home_description' => $row['smart_home_description'],

                    'smart_home_button_first' => $row['smart_home_button_first'],
                    
                    'smart_home_url_first' => $row['smart_home_url_first'],

                    'smart_home_button_secound' => $row['smart_home_button_secound'],
                    
                    'smart_home_url_secound' => $row['smart_home_url_secound'],

                    'smart_home_button_third' => $row['smart_home_button_third'],
                    
                    'smart_home_url_third' => $row['smart_home_url_third'],

                    'smart_home_button_fourth' => $row['smart_home_button_fourth'],
                    
                    'smart_home_url_fourth' => $row['smart_home_url_fourth'],

                    'unit_price' => $row['unit_price'],
                    
                    'product_description' => $row['product_description'],

                    'short_description' => $row['short_description'],

                    'slug' => preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($row['slug']))) . '-' . Str::random(5),

                ]);     



                // $productId = Product::create([

                //     'name' => $row['name'],

                //     'description' => $row['description'],

                //     'added_by' => $user->user_type == 'seller' ? 'seller' : 'admin',

                //     'user_id' => $user->user_type == 'seller' ? $user->id : User::where('user_type', 'admin')->first()->id,

                //     'approved' => $approved,

                //     'category_id' => $row['category_id'],

                //     'brand_id' => $row['brand_id'],

                //     'video_provider' => $row['video_provider'],

                //     'video_link' => $row['video_link'],

                //     'tags' => $row['tags'],

                //     'unit_price' => $row['unit_price'],

                //     'unit' => $row['unit'],

                //     'meta_title' => $row['meta_title'],

                //     'meta_description' => $row['meta_description'],

                //     'est_shipping_days' => $row['est_shipping_days'],

                //     'colors' => json_encode(array()),

                //     'choice_options' => json_encode(array()),

                //     'variations' => json_encode(array()),

                //     'slug' => preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($row['slug']))) . '-' . Str::random(5),

                //     'thumbnail_img' => $this->downloadThumbnail($row['thumbnail_img']),

                //     'photos' => $this->downloadGalleryImages($row['photos']),

                // ]); 

                ProductStock::create([

                    'product_id' => $productId->id,

                    // 'qty' => $row['current_stock'],

                    'price' => $row['unit_price'],

                    // 'sku' => $row['sku'],

                    'variant' => '',

                ]);

            }



            flash(translate('Products imported successfully'))->success();

        }

    }



    public function model(array $row)

    {

        ++$this->rows;

    }



    public function getRowCount(): int

    {

        return $this->rows;

    }



    public function rules(): array

    {

        return [

            // Can also use callback validation rules

            'unit_price' => function ($attribute, $value, $onFailure) {

                if (!is_numeric($value)) {

                    $onFailure('Unit price is not numeric');

                }

            }

        ];

    }



    public function downloadThumbnail($url)

    {

        try {

            $upload = new Upload;

            $upload->external_link = $url;

            $upload->type = 'image';

            $upload->save();



            return $upload->id;

        } catch (\Exception $e) {

        }

        return null;

    }



    public function downloadGalleryImages($urls)

    {

        $data = array();

        foreach (explode(',', str_replace(' ', '', $urls)) as $url) {

            $data[] = $this->downloadThumbnail($url);

        }

        return implode(',', $data);

    }

}

