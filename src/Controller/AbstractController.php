<?php

namespace ProdaCom\FrameworkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as BaseAbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AbstractController
 * @package ProdaCom\FrameworkBundle\Controller
 */
class AbstractController extends BaseAbstractController {

    /**
     * @param Request $request
     * @param string $default
     * @return RedirectResponse
     */
    public function redirectBack(Request $request, string $default): RedirectResponse {
        $referer = $request->headers->get('referer');

        if ($referer) {
            return $this->redirect($referer);
        }

        return $this->redirectToRoute($default);
    }

    /**
     * @param $object
     * @return void
     */
    public function persist($object): void {
        $this->getDoctrine()->getManager()->persist($object);
    }

    /**
     * @return void
     */
    public function flush(): void {
        $this->getDoctrine()->getManager()->flush();
    }

    /**
     * @param $object
     * @return void
     */
    public function persistAndFlush($object): void {
        $this->persist($object);
        $this->flush();
    }

}