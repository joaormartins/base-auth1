<?php
// rota teste
$app->get("/", "BaseController:home")->setName("home");

$app->group("/auth", function ($container) use ($app) {

	$app->get("/login", "BaseController:login")->setName("auth.login");
	$app->post("/login", "BaseController:postLogin");

});