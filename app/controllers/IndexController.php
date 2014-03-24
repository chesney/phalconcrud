<?php

class IndexController extends Phalcon\Mvc\Controller 
{
	public function indexAction()
	{           
            
            $this->view->setVar('users', Users::find());
            // get tweets            
            $twitter_client = new GuzzleHttp\Client('https://api.twitter.com/{version}', array(
                'version' => '1.1'
            ));                        
            
            $twitter = array(
                'consumer_key'      => '16nfXyS1ASlxD6BYmpddlw',
                'consumer_secret'   => 'atSUMc4uQ94WS2gCV5CVXKtMz0wSVv2y2aHmCGIdI',
                'token'             => 'xgRbZxI9iLDvrvEqUanjJUGiqLaUqRCzpbGxhl0Y',
                'token_secret'      => 'xfHNnFBZlHgeYEaS0MwMcbmWaxLFq3nerGnxi0nbBw3yu'
            );
                       
            $twitter_client->addSubscriber(new Guzzle\Plugin\Oauth\OauthPlugin(array(
                'consumer_key' => $twitter['consumer_key'],
                'consumer_secret' => $twitter['consumer_secret'],
                'token' => $twitter['access_token'],
                'token_secret' => $twitter['access_token_secret']
            )));

            $request = $twitter_client->get('search/tweets.json');
            $search = "PSG online";
            $request->getQuery()->set('q', $search);
            $response = json_decode($request->send(), true);
            $this->view->setVar('tweets', $response->getBody());
    }                             

}
