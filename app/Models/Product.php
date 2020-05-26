<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * 
 * @property int $id
 * @property string $codigo
 * @property string $descricao
 * @property string $unidade
 * @property float $valor
 * @property string $sku
 * @property string $codFiscal
 * @property string $NCM
 * @property int $pesoLiquido
 * @property string $tamanho
 * @property string $material
 * @property string $categoria
 * @property string $caracteristica
 * @property string $fabricante
 * @property string $urlImagem
 * @property int $estoqueMinimo
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class Product extends Model
{
	protected $table = 'products';

	protected $casts = [
		'valor' => 'float',
		'pesoLiquido' => 'int',
		'estoqueMinimo' => 'int'
	];

	protected $fillable = [
		'codigo',
		'descricao',
		'unidade',
		'valor',
		'sku',
		'codFiscal',
		'NCM',
		'pesoLiquido',
		'tamanho',
		'material',
		'categoria',
		'caracteristica',
		'fabricante',
		'urlImagem',
		'estoqueMinimo'
	];

	public static $rules = [
        "descricao" => "required",
        "valor" => "numeric|required",
        "pesoLiquido" => "numeric",
        "estoqueMinimo" => "numeric",
	];
	
}
