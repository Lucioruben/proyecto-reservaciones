<?php 

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Model;
use BinaryCabin\LaravelUUID\Traits\HasUUID;

class Reservacion extends Model
{
	use HasUUID;

	protected $table = 'reservaciones';
	protected $primaryKey = 'id';
	public $incrementing = false;
	protected $keyType = 'string';
	protected $uuidFieldName = 'id';
}

?>