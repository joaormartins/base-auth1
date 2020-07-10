<?php
// rota teste
$app->get("/", "BaseController:home")->setName("home");

$app->group("/auth", function ($container) use ($app) {

	$app->get("/login", "BaseController:login")->setName("auth.login");
	$app->post("/login", "BaseController:postLogin");

});

$app->group("/user", function ($container) use ($app) {


	$app->get("/logout", "BaseController:logout")->setName("auth.logout");
});


$app->group("/admin", function ($container) use ($app) {


	$app->get("/users", "AdminController:users")->setName("admin.users");
});