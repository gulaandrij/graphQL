<?php
/**
 * Created by PhpStorm.
 * User: lavulator
 * Date: 28.05.18
 * Time: 16:56
 */

namespace App\Security;


use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class CorsListener
{
    public function onKernelResponse(FilterResponseEvent $event)
    {
        $responseHeaders = $event->getResponse()->headers;

        $responseHeaders->set('Access-Control-Allow-Headers', 'origin, content-type, accept, credentials');
        $responseHeaders->set('Access-Control-Allow-Origin', 'http://localhost:3000');
        $responseHeaders->set('Access-Control-Allow-Credentials', 'true');
        $responseHeaders->set('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, PATCH, OPTIONS');
    }
}