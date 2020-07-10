<?php
namespace App\Auth;


class Auth {

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

	
	public function loginState(): int
	{
		return $this->state ?? self::NONE;
	}

	public function user(): ?User
	{
		return $this->user;
	}

}