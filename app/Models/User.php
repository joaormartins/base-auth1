<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {

	protected $table = "usuarios";

	protected $fillable = [
		"nome",
		"usuario",
		"senha"
	];


	public function changePassword($new)
	{
		if (!password_get_info($new)["algo"]) {
			$new = password_hash($new, PASSWORD_DEFAULT);
		}

		$this->password = $new;
		return $this->save();
	}
}