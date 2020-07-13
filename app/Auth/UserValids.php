<?php
namespace App\Auth;

use App\Models\User;

trait UserValids {

	// tentativa de salvar o Usuario (edicao e cadastro)
	public function saveUser(array $params): bool
	{

		$username = $params["user"];
		if (strlen($username) < 5) {
			$this->error = "O Campo Usuário deve conter pelo menos 5 caracteres";
			return false;
		}
		$passwd = $params["password"];

		if (strlen($passwd) < 6) {
			$this->error = "Insira uma senha com pelo menos 6 caracteres";
			return false;
		}

		if (User::where("user", $username)->count() != 0) {
			$this->error = "O nome de Usuário inserido ja está em uso";
			return false;
		}

		// salvar o usuario
		User::create([
			"name" => $params["name"],
			"user" => $username,
			"password" => password_hash($passwd, PASSWORD_DEFAULT)
		]);

		return true;
	}
}