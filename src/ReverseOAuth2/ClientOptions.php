<?php

namespace ReverseOAuth2;

use Zend\Stdlib\AbstractOptions;

class ClientOptions extends AbstractOptions
{

    protected $scope;

    protected $authUri;

    protected $authMethod;

    protected $tokenUri;

    protected $infoUri;

    protected $infoMethod;

    protected $clientId;

    protected $clientSecret;

    protected $redirectUri;

    
    public function getScope()
    {
        return $this->scope;
    }

    public function setScope($scope)
    {
        $this->scope = $scope;
    }

    public function getAuthUri()
    {
        if (isset($this->authMethod))
        {
            return $this->authUri.'/'.$this->authMethod;
        }
        return $this->authUri;
    }

    public function setAuthUri($authUri)
    {
        $this->authUri = $authUri;
    }

    public function setAuthMethod($authMethod)
    {
        $this->authMethod = $authMethod;
    }

    public function getTokenUri()
    {
        return $this->tokenUri;
    }

    public function setTokenUri($tokenUri)
    {
        $this->tokenUri = $tokenUri;
    }

    public function getInfoUri()
    {
        if (isset($this->infoMethod))
        {
            return $this->infoUri.'/'.$this->infoMethod;
        }
        return $this->infoUri;
    }

    public function setInfoUri($infoUri)
    {
        $this->infoUri = $infoUri;
    }

    public function setInfoMethod($infoMethod)
    {
        $this->infoMethod = $infoMethod;
    }

    public function getClientId()
    {
        return $this->clientId;
    }

    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;
    }

    public function getRedirectUri()
    {
        return $this->redirectUri;
    }

    public function setRedirectUri($redirectUri)
    {
        $this->redirectUri = $redirectUri;
    }

}
