<?php

namespace App\Integra;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;

class Framework
{
    private UrlMatcher $matcher;
    private ControllerResolver $controllerResolver;
    private ArgumentResolver $argumentResolver;

    public function __construct($matcher, $controllerResolver, $argumentResolver)
    {
        $this->matcher = $matcher;
        $this->controllerResolver = $controllerResolver;
        $this->argumentResolver = $argumentResolver;
    }

    public function handle(Request $request)
    {
        $this->matcher->getContext()->fromRequest($request);

        $pathInfo = $request->getPathInfo();
        if (!str_ends_with($pathInfo, '/')) {
            $baseUrl = $request->getBaseUrl();
            $newPathInfo = $baseUrl.$pathInfo . '/';
            if($request->isMethod('GET')){
                return new RedirectResponse($newPathInfo, 301);
            }
        }

        try {
            $request->attributes->add($this->matcher->match($request->getPathInfo()));

            $controller = $this->controllerResolver->getController($request);
            $arguments = $this->argumentResolver->getArguments($request, $controller);

            return call_user_func_array($controller, $arguments);
        } catch (ResourceNotFoundException $exception) {
            return new Response('Not Found', 404);
        } catch (\Exception $exception) {
            return new Response('An error occurred', 500);
        }
    }
}
