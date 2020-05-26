<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Variation
 * 
 * @property int $id
 * @property string $cor
 * @property int $product_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Product $product
 *
 * @package App\Models
 */
class Variation extends Model
{
	protected $table = 'variations';

	protected $casts = [
		'product_id' => 'int'
	];

	protected $fillable = [
		'cor',
		'product_id'
	];

	public function product()
	{
		return $this->belongsTo(Product::class);
	}
}
