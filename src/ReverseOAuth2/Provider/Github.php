<?php

namespace ReverseOAuth2\Provider;

use \ReverseOAuth2\AbstractOAuth2Provider;
use \Zend\Http\PhpEnvironment\Request;

class Github extends AbstractOAuth2Provider
{

    
    public function getUrl()
    {
        
        $url = $this->options['auth_uri'].'?'
            . 'redirect_uri='  . urlencode($this->options['redirect_uri'])
            . '&client_id='    . $this->options['client_id']
            . '&state='        . $this->generateState()
            . $this->getScope();

        return $url;
        
    }
    
    
    public function getToken(Request $request) 
    {
        
        if(isset($this->session->token)) {
        
            return $this->session->token;
            
        } elseif($this->session->state == $request->getQuery('state') AND strlen($request->getQuery('code')) > 5) {
            
            $client = new \Zend\Http\Client($this->options['token_uri'], array('timeout' => 30, 'adapter' => 'Zend\Http\Client\Adapter\Curl'));
            $client->setMethod(Request::METHOD_POST);
            $client->setParameterPost(array(
                'code'          => $request->getQuery('code'),
                'client_id'     => $this->options['client_id'],
                'client_secret' => $this->options['client_secret'],
                'redirect_uri'  => $this->options['redirect_uri'],
                'state'         => $this->getState()
            ));
            
            $client->setEncType('application/x-www-form-urlencoded');
            
            parse_str($client->send()->getContent(), $token);
            
            if(!isset($token['error'])) {
                $this->session->token = $token;
            };
            
            return $token;
            
        } else {

            return false;
            
        }
        
    }
    
    
    public function getInfo()
    {
        
        if(is_object($this->session->info)) {
        
            return $this->session->info;
        
        } elseif(isset($this->session->token['access_token'])) {
        
            $urlProfile = $this->options['info_uri'] . '?access_token='.$this->session->token['access_token'];
            $this->session->info = \Zend\Json\Decoder::decode(file_get_contents($urlProfile));
            return $this->session->info;
        
        } else {
            
            return false;
            
        }
        
    }
    
    
    public function getScope()
    {
        if(count($this->options['scope']) > 0) {
            $str = urlencode(implode(',', $this->options['scope']));
            return '&scope=' . $str;
        } else {
            return '';
        }
    }
    
}