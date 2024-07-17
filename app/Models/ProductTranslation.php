<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;



class ProductTranslation extends Model

{

    protected $fillable = ['product_id', 'name', 'unit', 'description', 'lang' , 'add_on' , 'specification'];



    public function product(){

      return $this->belongsTo(Product::class);

    }

}

