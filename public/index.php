<?php

try {
    
    //Register an autoloader
    $loader = new \Phalcon\Loader();       
        
    //Register some namespaces
    $loader->registerNamespaces(
		array(
			"Twm\Db\Adapter\Pdo" => "../app/library/db/adapter/",
			"Twm\Db\Dialect" => "../app/library/db/dialect/"
			)
		)->register();
     
    $loader->registerDirs(
        array(
            '../app/controllers/',
            '../app/models/'    
        )
    )->register();
    
        
  

    //Create a Dependecy Injection Factory
    $di = new Phalcon\DI\FactoryDefault();
    
      /*$local = array(		
                'host'          => 'YOUR_MSSQL_SERVERNAME\YOUR_MSSQL_SERVER_INSTANCE_NAME',
                'port'          => 1433,
                'instance'      => 'YOUR_MSSQL_SERVER_INSTANCE_NAME',
		'username'	=> 'test',
		'password'	=> 'test',
		'dbname'	=> 'test',                
                'pdoType'       => 'sqlsrv', //sqlsrv
		'dialectClass'	=> '\Twm\Db\Dialect\Mssql'
	);
    
    $db = new \Twm\Db\Adapter\Pdo\Mssql($local); 
    */
        
    $di->set('db', function(){
        return new \Twm\Db\Adapter\Pdo\Mssql(array(
                'host'          => 'YOUR_MSSQL_SERVERNAME\YOUR_MSSQL_SERVER_INSTANCE_NAME',
                'port'          => 1433,
                'instance'      => 'YOUR_MSSQL_SERVER_INSTANCE_NAME',
		'username'	=> 'test',
		'password'	=> 'test',
		'dbname'	=> 'test',                
                'pdoType'       => 'sqlsrv', //sqlsrv
		'dialectClass'	=> '\Twm\Db\Dialect\Mssql'
        ), true);//set flag to ,true to enable shared db variable. This increases performance
    });
    
//    To access the $db variable globally do the following :
//        $di = $this->di
//        or
//        $di =  Phalcon\DI::getDefault();
//        $db = $di->get("db");  //you should register "db" first
//    
        
    //Setting up the view component
    $di->set('view', function(){
        $view = new \Phalcon\Mvc\View();
        $view->setViewsDir('../app/views/');
        return $view;
    });
    
    // Setup a base URI so that all generated URI's include the "tutorial" folder
    /*$di->set('url', function(){
        $url = new \Phalcon\Mvc\Url();
        $url->setBaseUri('/');
        return $url;
    });*/

    //Handle the request
    $application = new \Phalcon\Mvc\Application();
    $application->setDI($di);
    echo $application->handle()->getContent();

} catch(\Phalcon\Exception $e) {
     echo "PhalconException: ", $e->getMessage();
}
