<?php
namespace App\Auth;

use App\Models\User;

trait UserValidations {


	// public function validation(array $params): bool
	// {


	// 	return true;
	// }

	public function saveUser(array $params, $id = 0): bool
	{
		if (in_array("", $params)) {
			$this->error = "Preencha todos os campos para continuar";
			return false;
		}

		$name = $params["name"];
		$username = $params["user"];
		$password = $params["password"];

		if (strlen($username) < 5) {
			$this->error = "O nome de usuário deve conter entre 5 e 20 caracteres";
			return false;
		}
		if (strlen($username) < 6) {
			$this->error = "Insira uma senha com pelo menos 6 caracteres";
			return false;
		}
		// checa se ja esta em uso o nome de usuario (tbm em edicao)
		$checkUsername = User::where("usuario", $username);
		if ($id) {
			$checkUsername->where("id", "!=", $id);
		}
		if ($checkUsername->count() != 0) {
			$this->error = "O nome de usuario inserido ja está em uso";
			return false;
		}
		

		// salvamos neh
		User::create([
			"nome" => $name,
			"usuario" => $username,
			"senha" => password_hash($password, PASSWORD_DEFAULT)
		]);

		return true;
	}

}