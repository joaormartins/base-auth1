<?php
namespace App\Controllers;

class BaseController extends Controller {

	public function home($request, $response)
	{
		return $this->view->render($response, "home.twig");
	}


}