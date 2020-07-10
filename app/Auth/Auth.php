<?php
namespace App\Auth;

use App\Models\User;

class Auth {

	// validacoes em usuario
	use UserValidations;
	

	const NONE = 0;
	const LOGGED = 1;
	const ADMIN = 2;

	protected $container, $config;

	protected $state, $user;

	public $error, $obj;

	public function __construct($container)
	{
		$this->container = $container;
		$this->config = $container->settings["auth"];

		// check
		$this->check();
	}

	protected function check(): void
	{
		$session = $_SESSION[$this->config["session"]] ?? null;

		if ($session && $user = User::find($session)) {
			$this->user = $user;
			$this->state = $user->admin ? self::ADMIN : self::LOGGED;
			return;
		}
		$this->user = null;
		$this->state = self::NONE;
	}

	public function loginAttemp(array $params): bool
	{
		$username = $params["username"];
		$password = $params["password"];

		if (empty($username) || empty($password)) {
			$this->error = "Preencha todos os campos!";
			return false;
		}

		if (!$user = User::where("usuario", $username)->first()) {
			$this->error = "Usuario nao encontrado";
			return false;
		}

		if (!password_verify($password, $user->senha)) {
			$this->error = "A senha inserida esta incorreta!";
			return false;
		}

		// logar usuario
		$this->login($user);

		return true;
	}

	public function login(User $user)
	{
		$_SESSION[$this->config["session"]] = $user->id;
		$this->state = $user->admin ? self::ADMIN : self::LOGGED;
		$this->user = $user;
	}

	public function logout()
	{
		unset($_SESSION[$this->config["session"]]);
		$this->state = self::NONE;
		$this->user = null;
	}
	
	public function loginState(): int
	{
		return $this->state ?? self::NONE;
	}

	public function user(): ?User
	{
		return $this->user;
	}

}