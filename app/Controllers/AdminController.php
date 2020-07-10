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


	public function addUser($request, $response)
	{
		$pass = $this->auth->saveUser($request->getParams());

		if ($pass) {
			$this->flash->addMessage("success", "Usuario inserido com sucesso :)");
		}else {

			$this->flash->addMessage("error", $this->auth->error);
		}
		return $response->withRedirect($this->router->pathFor("admin.users"));
	}

}