<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Cors implements FilterInterface
{
    private array $headers = [
        'Access-Control-Allow-Origin'  => '*',
        'Access-Control-Allow-Methods' => 'GET, POST, OPTIONS, PUT, DELETE, PATCH',
        'Access-Control-Allow-Headers' => 'Origin, X-Requested-With, Content-Type, Accept, Authorization, X-API-Key',
        'Access-Control-Max-Age'       => '86400',
    ];

    public function before(RequestInterface $request, $arguments = null)
    {
        // Request "preflight" dari browser: langsung dijawab OK
        if (strtoupper($request->getMethod()) === 'OPTIONS') {
            $response = service('response')->setStatusCode(200);
            foreach ($this->headers as $name => $value) {
                $response->setHeader($name, $value);
            }
            return $response;
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        foreach ($this->headers as $name => $value) {
            $response->setHeader($name, $value);
        }
        return $response;
    }
}