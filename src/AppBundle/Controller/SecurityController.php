<?php

namespace AppBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;

class SecurityController extends AbstractController {

	/**
	 * @Route("/login", name="login_app")
	 *
	 */
	public function login(Request $request) 
	{
		$session = $request->getSession();

		if ($this->isGranted('ROLE_ADMIN')) {
			return $this->redirect('/');
		}

		if ($request->attributes->has(Security::AUTHENTICATION_ERROR)) {
			$error = $request->attributes->get(Security::AUTHENTICATION_ERROR);
		} elseif (null !== $session && $session->has(Security::AUTHENTICATION_ERROR)) {
			$error = $session->get(Security::AUTHENTICATION_ERROR);
			$session->remove(Security::AUTHENTICATION_ERROR);
		} else {
			$error = null;
		}

		if (!$error instanceof AuthenticationException) {
			$error = null;
		}

		if ($this->has('security.csrf.token_manager')) {
			$csrfToken = $this->get('security.csrf.token_manager')->getToken('authenticate')->getValue();
		} else {
			$csrfToken = $this->has('security.csrf.token_manager') ? $this->get('security.csrf.token_manager')->getToken('authenticate') : null;
		}

		return $this->render('@App/security/login.html.twig', [
			'last_username' => $session->get(Security::LAST_USERNAME),
			'error' => $error,
			'csrf_token' => $csrfToken
		]);
	}

	/**
	 * @Route("/login_check", name="login_check")
	 * @throws \Exception
	 */
	public function authCheckAction()
	{
		throw new \Exception("This should never be reached!");
	}

	/**
	 * @Route("/logout", name="logout")
	 * @throws \Exception
	 */
	public function logoutAction()
	{
		throw new \Exception("This should never be reached!");
	}

}