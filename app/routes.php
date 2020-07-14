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


$app->group("/adm", function ($container) use ($app) {

	// gerenciamento dos usuarios
	$app->get("/users", "AdminController:users")->setName("admin.users");
	$app->post("/users/add", "AdminController:addUser")->setName("admin.users.add");

	$app->get("/users/del/{user_id}", "AdminController:deleteUser")->setName("admin.users.del");
});