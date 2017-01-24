<?php
// Routes

$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

$app->get('/listado/[{email}]', function ($request, $response, $args) {
    $file = file_get_contents('C:\xampp\htdocs\slim\src\employees.json'); 
    $email = htmlspecialchars($args["email"]);    
    if(!empty($email)):
        $pre = json_decode($file);
        $count = count($pre);
        for($i=0; $i<$count; $i++):
            if($pre[$i]->email == $email):
                $jstr = $pre[$i];
                //echo var_dump($jstr);    exit();
            endif;
        endfor;
    else:   
        $jstr  = json_decode($file);
    endif;
    
    return $this->renderer->render($response, 'listado.phtml', compact("jstr"));
});

$app->get('/ver/[{id}]', function ($request, $response, $args) {
    $file = file_get_contents('C:\xampp\htdocs\slim\src\employees.json'); 
    $id   = htmlspecialchars($args["id"]);    
    $pre = json_decode($file);
    $count = count($pre);
    for($i=0; $i<$count; $i++):
        if($pre[$i]->id == $id):
            $jstr = $pre[$i];
            //echo var_dump($jstr);    exit();
        endif;
    endfor;
    
    return $this->renderer->render($response, 'ver.phtml', compact("jstr"));
});

$app->get('/range/', function ($request, $response) {
    $file = file_get_contents('C:\xampp\htdocs\slim\src\employees.json');
    $pre = json_decode($file);
    $count = count($pre);
    $jstr   = array();
    for($i=0; $i<$count; $i++):
        $premount = str_replace('$', "", $pre[$i]->salary);
        $premout  = str_replace(',', "", $premount);
        $mount = floatval($premout);        
        if(1000 <= $premout && 1500 >= $premout ):
            //echo var_dump($pre[$i]);
            array_push($jstr, $pre[$i]);
        endif;
        //echo ($premout. " ");
    endfor;
   
    return $this->renderer->render($response, 'range.phtml', compact("jstr"));
});
