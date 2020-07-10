<?php
namespace App\Controllers;

class BaseController extends Controller {

	public function home($request, $response)
	{
		return $this->view->render($response, "home.twig");
	}


	public function login($request, $response)
	{
		return $this->view->render($response, "auth/login.twig");
	}

	public function postLogin($request, $response)
	{
		$pass = $this->auth->loginAttemp([
			"username" => $request->getParam("usuario"),
			"password" => $request->getParam("senha")
		]);

		if (!$pass) {
			$this->flash->addMessage("error", $this->auth->error);
			return $response->withRedirect($this->router->pathFor("auth.login"));
		}

		$this->flash->addMessage("success", "Login Realizado com sucesso");
		return $response->withRedirect($this->router->pathFor("home"));
	}

	public function logout($request, $response)
	{
		$this->flash->addMessage("info", "Sessao encerrada com sucesso");
		$this->auth->logout();
		return $response->withRedirect($this->router->pathFor("auth.login"));
	}

}