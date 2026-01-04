<?php
declare(strict_types=1);

require __DIR__ . '/../src/Db.php';
require __DIR__ . '/../src/ClientDao.php';
require __DIR__ . '/../src/ReservationDao.php';
require __DIR__ . '/../src/PaymentDao.php';
require __DIR__ . '/../src/ServiceDao.php';
require __DIR__ . '/../src/UseOfServiceDao.php';

$pdo = Db::pdo();

$daos = [
  'client' => ['dao' => new ClientDao($pdo), 'pk' => 'id_client', 'table' => 'Client',
      'fields' => ['id_client','PIB','pasportni_dani','telephone','email1']],
  'reservation' => ['dao' => new ReservationDao($pdo), 'pk' => 'id_Reservation', 'table' => 'Reservation',
      'fields' => ['id_Reservation','id_Client','data_zaizdu','data_vyizdu']],
  'payment' => ['dao' => new PaymentDao($pdo), 'pk' => 'id_Payment', 'table' => 'Payment',
      'fields' => ['id_Payment','id_Reservation','summa','method','data_payment']],
  'service' => ['dao' => new ServiceDao($pdo), 'pk' => 'id_Service', 'table' => 'Service',
      'fields' => ['id_Service','name','price','description']],
  'useofservice' => ['dao' => new UseOfServiceDao($pdo), 'pk' => 'id_UseOfService', 'table' => 'UseOfService',
      'fields' => ['id_UseOfService','id_Reservation','id_Service','amount','total_amount']],
];

$entity = strtolower($_GET['entity'] ?? 'client');
$action = strtolower($_GET['action'] ?? 'index');

if (!isset($daos[$entity])) { http_response_code(404); exit('Unknown entity'); }

$cfg = $daos[$entity];
$dao = $cfg['dao'];
$pk  = $cfg['pk'];
$fields = $cfg['fields'];
$titleEntity = $cfg['table'];

function render(string $template, array $vars): void {
  extract($vars);
  require __DIR__ . '/../views/layout.php';
  exit;
}
function redirectTo(string $url): void { header("Location: $url"); exit; }

// helper: lists for FK dropdowns
function options(PDO $pdo, string $entity): array {
  if ($entity === 'client') {
    return $pdo->query("SELECT id_client, PIB FROM Client ORDER BY id_client")->fetchAll();
  }
  if ($entity === 'reservation') {
    return $pdo->query("SELECT id_Reservation FROM Reservation ORDER BY id_Reservation")->fetchAll();
  }
  if ($entity === 'service') {
    return $pdo->query("SELECT id_Service, name FROM Service ORDER BY id_Service")->fetchAll();
  }
  return [];
}

if ($action === 'index') {
  $rows = $dao->all();
  render('table/index.php', compact('rows','fields','entity','titleEntity') + ['title' => "List: $titleEntity"]);
}

if ($action === 'show') {
  $id = (int)($_GET['id'] ?? 0);
  $row = $dao->find($id);
  render('table/show.php', compact('row','fields','entity','pk','titleEntity') + ['title' => "View: $titleEntity"]);
}

if ($action === 'create' && $_SERVER['REQUEST_METHOD'] === 'GET') {
  $row = array_fill_keys($fields, '');
  $fk = [
    'clients' => options($pdo,'client'),
    'reservations' => options($pdo,'reservation'),
    'services' => options($pdo,'service'),
  ];
  render('table/form.php', compact('row','fields','entity','pk','titleEntity','fk') + ['title' => "Create: $titleEntity"]);
}

if ($action === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = [];
  foreach ($fields as $f) $data[$f] = trim((string)($_POST[$f] ?? ''));
  try {
    $dao->create($data);
    redirectTo("/?entity=$entity&action=index");
  } catch (Throwable $e) {
    $fk = [
      'clients' => options($pdo,'client'),
      'reservations' => options($pdo,'reservation'),
      'services' => options($pdo,'service'),
    ];
    $error = $e->getMessage();
    $row = $data;
    render('table/form.php', compact('row','fields','entity','pk','titleEntity','fk','error') + ['title' => "Create: $titleEntity"]);
  }
}

if ($action === 'edit' && $_SERVER['REQUEST_METHOD'] === 'GET') {
  $id = (int)($_GET['id'] ?? 0);
  $row = $dao->find($id);
  $fk = [
    'clients' => options($pdo,'client'),
    'reservations' => options($pdo,'reservation'),
    'services' => options($pdo,'service'),
  ];
  render('table/form.php', compact('row','fields','entity','pk','titleEntity','fk') + ['title' => "Edit: $titleEntity"]);
}

if ($action === 'edit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = (int)($_GET['id'] ?? 0);
  $data = [];
  foreach ($fields as $f) $data[$f] = trim((string)($_POST[$f] ?? ''));
  try {
    $dao->update($id, $data);
    redirectTo("/?entity=$entity&action=show&id=$id");
  } catch (Throwable $e) {
    $fk = [
      'clients' => options($pdo,'client'),
      'reservations' => options($pdo,'reservation'),
      'services' => options($pdo,'service'),
    ];
    $error = $e->getMessage();
    $row = $data;
    render('table/form.php', compact('row','fields','entity','pk','titleEntity','fk','error') + ['title' => "Edit: $titleEntity"]);
  }
}

if ($action === 'delete' && $_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = (int)($_GET['id'] ?? 0);
  $dao->delete($id);
  redirectTo("/?entity=$entity&action=index");
}

http_response_code(404);
echo "Not found";
