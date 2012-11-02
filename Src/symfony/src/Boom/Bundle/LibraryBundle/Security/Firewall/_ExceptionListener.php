<?php
namespace Boom\Bundle\LibraryBundle\Security\Firewall;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Firewall\ExceptionListener as BaseExceptionListener;

class ExceptionListener extends BaseExceptionListener
{
    protected function setTargetPath(Request $request)
    {
        // Do not save target path for XHR and non-GET requests
        // You can add any more logic here you want
        if ($request->isXmlHttpRequest() === true) {
            return;
        }

        if ($request->hasSession() && $request->isMethodSafe()) {
            $request->getSession()->set('_security.' . $this->providerKey . '.target_path', $request->getUri());
        }
    }
}