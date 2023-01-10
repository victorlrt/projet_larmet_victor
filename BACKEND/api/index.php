<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Tuupola\Middleware\HttpBasicAuthentication;
use \Firebase\JWT\JWT;
require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../bootstrap.php';
require_once __DIR__ . '/model.php';
 

$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);
const JWT_SECRET = "makey1234567";

function createJwT (Response $response, $login, $password) : Response {

    $issuedAt = time();
    $expirationTime = $issuedAt + 700;
    $payload = array(
    'login' => $login,
    'password' => $password,
    'iat' => $issuedAt,
    'exp' => $expirationTime
    );

    $token_jwt = JWT::encode($payload,JWT_SECRET, "HS256");
    $response = $response->withHeader("Authorization", "Bearer {$token_jwt}");
    return $response;
}

$options = [
    "attribute" => "token",
    "header" => "Authorization",
    "regexp" => "/Bearer\s+(.*)$/i",
    "secure" => false,
    "algorithm" => ["HS256"],
    "secret" => JWT_SECRET,
    "path" => ["/api"],
    "ignore" => ["/api/signin", "/api/client"],
    "error" => function ($response, $arguments) {
        $data = array('ERREUR' => 'Connexion', 'ERREUR' => 'JWT Non valide');
        $response = $response->withStatus(401);
        return $response->withHeader("Content-Type", "application/json")->getBody()->write(json_encode($data));
    }
];

function  addHeaders (Response $response) : Response {
    $response = $response
    ->withHeader("Content-Type", "application/json")
    ->withHeader('Access-Control-Allow-Origin', ('https://met02web.onrender.com'))
    ->withHeader('Access-Control-Allow-Headers', 'Content-Type,  Authorization')
    ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS')
    ->withHeader('Access-Control-Expose-Headers', 'Authorization');
    return $response;
}


// --- Region CATALOGUE --- //
$app->post('/api/catalogue', function (Request $request, Response $response, $args) {
    $inputJSON = file_get_contents('php://input');
    $body = json_decode( $inputJSON, true ); 

    $name = $body['name'] ; 
    $edible = $body['edible'] ;
    $poisonous = $body['poisonous'] ;
    $img = $body['img'] ;
    $description = $body['description'] ;
    $toxicity = $body['toxicity'] ;
    $err=false;

    if ($err == false) {
        global $entityManager;
        $mushroom = new Mushroom;
        $mushroom->setName($name);
        $mushroom->setEdible($edible);
        $mushroom->setPoisonous($poisonous);
        $mushroom->setImg($img);
        $mushroom->setDescription($description);
        $mushroom->setToxicity($toxicity);
        $entityManager->persist($mushroom);
        $entityManager->flush();
        $response = addHeaders($response);
        $response->getBody()->write(json_encode ($mushroom));
        return $response;
    }
});

$app->get('/api/catalogue', function (Request $request, Response $response, $args) {
    global $entityManager;
    $mushroom = $entityManager->getRepository('mushroom')->findAll();
    $response = addHeaders($response);
    $response->getBody()->write(json_encode ($mushroom));
    return $response;
});

$app->get('/api/catalogue/{id}', function (Request $request, Response $response, $args) {
    global $entityManager;
    $mushroom = $entityManager->getRepository('mushroom')->find($args['id']);
    $response = addHeaders($response);
    $response->getBody()->write(json_encode ($mushroom));
    return $response;
});

$app->get('/api/search/{name}', function (Request $request, Response $response, $args) {
    global $entityManager;
    $mushroom = $entityManager->getRepository('mushroom')->find($args['name']);
    $response = addHeaders($response);
    $response->getBody()->write(json_encode ($mushroom));
    return $response;
});

$app->put('/api/catalogue/{id}', function (Request $request, Response $response, $args) {
    $inputJSON = file_get_contents('php://input');
    $body = json_decode( $inputJSON, true ); 

    $name = $body['name'] ; 
    $edible = $body['edible'] ;
    $poisonous = $body['poisonous'] ;
    $img = $body['img'] ;
    $description = $body['description'] ;
    $toxicity = $body['toxicity'] ;

    $err=false;

    if ($err == false) {
        global $entityManager;
        $mushroom = $entityManager->getRepository('mushroom')->find($args['id']);
        $mushroom->setName($name);
        $mushroom->setEdible($edible);
        $mushroom->setPoisonous($poisonous);
        $mushroom->setImg($img);
        $mushroom->setDescription($description);
        $mushroom->setToxicity($toxicity);

        $entityManager->persist($mushroom);
        $entityManager->flush();
        $response = addHeaders($response);
        $response->getBody()->write(json_encode ($mushroom));
        return $response;
    }
});

$app->delete('/api/catalogue/{id}', function (Request $request, Response $response, $args) {
    global $entityManager;
    $mushroom = $entityManager->getRepository('mushroom')->find($args['id']);
    $entityManager->remove($mushroom);
    $entityManager->flush();
    $response = addHeaders($response);
    $response->getBody()->write(json_encode ($mushroom));
    return $response;
});



// --- Region CLIENT --- //


//login
$app->post('/api/signin', function (Request $request, Response $response, $args) {   
    $err=false;
    $inputJSON = file_get_contents('php://input');
    $body = json_decode( $inputJSON, TRUE ); 
    $login = $body['login'] ?? ""; 
    $password = $body['password'] ?? "";

    if (empty($login) || empty($password)|| !preg_match("/^[a-zA-Z0-9]+$/", $login) || !preg_match("/^[a-zA-Z0-9]+$/", $password)) {
        $err=true;
    }

    global $entityManager;
    $client = $entityManager->getRepository('client')->findOneBy(array('login' => $login, 'password' => $password));
    $id = $client->getId();

    if (!$err && $client) {
        $response = createJwT($response, $login, $password);
        $response = addHeaders($response);
        $data = array('login' => $login, 'id' => $id);
        $response->getBody()->write(json_encode($data));
    }
    else{          
        $response = $response->withStatus(401);
    }
    return $response;
});


$app->post('/api/client', function (Request $request, Response $response, $args) {
    $inputJSON = file_get_contents('php://input');
    $body = json_decode( $inputJSON, true ); 

    $lastname = $body['lastname'] ; 
    $firstname = $body['firstname'] ;
    $zipcode= $body['zipcode'] ;
    $tel = $body['tel'] ;
    $email = $body['email'] ;
    $gender = $body['gender'] ;
    $login = $body['login'] ;
    $password = $body['password'] ;
    $err=false;

    if ($err == false) {
        global $entityManager;
        $client = new Client;
        
        $client->setlastname($lastname);
        $client->setfirstname($firstname);
        $client->setZipcode($zipcode);
        $client->setTel($tel);
        $client->setEmail($email);
        $client->setGender($gender);
        $client->setLogin($login);
        $client->setPassword($password);

        $entityManager->persist($client);
        $entityManager->flush();
        
        $response = addHeaders($response);
        $response->getBody()->write(json_encode ($client));
    }
    else{          
        $response = $response->withStatus(401);
    }
    return $response;
});

$app->get('/api/client', function (Request $request, Response $response, $args) {
    global $entityManager;
    $client = $entityManager->getRepository('client')->findAll();
    $response = addHeaders($response);
    $response->getBody()->write(json_encode ($client));
    return $response;
});

$app->get('/api/client/{id}', function (Request $request, Response $response, $args) {
    global $entityManager;
    $id = $args ['id'];

    $client = $entityManager->getRepository('client')->findOneBy(array('id' => $id));
    $response = addHeaders($response);
    $response->getBody()->write(json_encode ($client));
    return $response;
});

$app->put('/api/client/{id}', function (Request $request, Response $response, $args) {
    $inputJSON = file_get_contents('php://input');
    $body = json_decode( $inputJSON, true ); 
    
    $lastname = $body['lastname'] ; 
    $firstname = $body['firstname'] ;
    $zipcode= $body['zipcode'] ;
    $tel = $body['tel'] ;
    $email = $body['email'] ;
    $gender = $body['gender'] ;
    $login = $body['login'] ;
    $password = $body['password'] ;
    $err=false;

    if (!$err) {
        $id = $args ['id'];
        global $entityManager;
        $client = $entityManager->find('client', $id);
        $client->setlastname($lastname);
        $client->setfirstname($firstname);
        $client->setZipcode($zipcode);
        $client->setTel($tel);
        $client->setEmail($email);
        $client->setGender($gender);
        $client->setLogin($login);
        $client->setPassword($password);

        $entityManager->persist($client);
        $entityManager->flush();
        
        $response = addHeaders($response);
        $response->getBody()->write(json_encode ($client));
    }
    else{          
        $response = $response->withStatus(401);
    }
    return $response;
});

$app->delete('/api/client/{id}', function (Request $request, Response $response, $args) {
    $id = $args ['id'];
    global $entityManager;
    $client = $entityManager->find('client', $id);
    $entityManager->remove($client);
    $entityManager->flush();
    $response = addHeaders($response);
    $response->getBody()->write(json_encode ($client));
    return $response;
});


$app->add(new Tuupola\Middleware\JwtAuthentication($options));
$app->run ();