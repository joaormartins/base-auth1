<?php
namespace App\Controllers;

use App\Models\User;

class AdminController extends Controller {

	public function users($request, $response)
	{
		$users = User::all();

		return $this->view->render($response, "admin/users.twig", [
			"users" => $users
		]);
	}


	// requisicao AJAX POST
	public function addUser($request, $response)
	{
		$pass = $this->auth->saveUser([
			"name" => $request->getParam("name"),
			"user" => $request->getParam("user"),
			"password" => $request->getParam("password")
		]);
		if (!$pass) {
			return $this->ajaxResponse("message", [
				"type" => "error",
				"message" => $this->auth->error
			]);
		}

		// mensagem de sucesso que salvou
		$this->flash->addMessage("success", "Usuário salvo com sucesso");
		
		return $this->ajaxResponse("redirect", [
			"url" => $this->router->pathFor("admin.users")
		]);
	}

}