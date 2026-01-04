<?php /** @var string $template */ ?>
<!doctype html>
<html lang="uk">
<head>
  <meta charset="utf-8">
  <title><?= htmlspecialchars($title ?? 'CRUD') ?></title>
  <style>
    body { font-family: Arial, sans-serif; max-width: 1100px; margin: 20px auto; padding: 0 12px; }
    nav a { margin-right: 10px; }
    table { border-collapse: collapse; width: 100%; }
    th, td { border: 1px solid #ddd; padding: 8px; vertical-align: top; }
    .btn { display:inline-block; padding:6px 10px; border:1px solid #333; text-decoration:none; margin-right:6px; }
    .error { background:#ffe5e5; padding:10px; margin:10px 0; }
    input, select, textarea { width: 100%; padding: 6px; }
    textarea { min-height: 80px; }
  </style>
</head>
<body>
  <nav>
    <a href="/?entity=client&action=index">Client</a>
    <a href="/?entity=reservation&action=index">Reservation</a>
    <a href="/?entity=payment&action=index">Payment</a>
    <a href="/?entity=service&action=index">Service</a>
    <a href="/?entity=useofservice&action=index">UseOfService</a>
  </nav>

  <h2><?= htmlspecialchars($title ?? '') ?></h2>

  <?php if (!empty($error)): ?>
    <div class="error"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <?php require __DIR__ . '/' . $template; ?>
</body>
</html>
