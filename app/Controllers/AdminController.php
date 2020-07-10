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
		var_dump("salvando usuario");
	}

}