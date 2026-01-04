<?php if (!$row): ?>
  <p>Not found</p>
<?php else: ?>
  <table>
    <?php foreach ($fields as $f): ?>
      <tr>
        <th style="width:260px;"><?= htmlspecialchars($f) ?></th>
        <td><?= htmlspecialchars((string)($row[$f] ?? '')) ?></td>
      </tr>
    <?php endforeach; ?>
  </table>

  <br>
  <a class="btn" href="/?entity=<?= urlencode($entity) ?>&action=edit&id=<?= (int)$row[$pk] ?>">Edit</a>

  <form method="post" action="/?entity=<?= urlencode($entity) ?>&action=delete&id=<?= (int)$row[$pk] ?>" style="display:inline">
    <button type="submit" onclick="return confirm('Delete?')">Delete</button>
  </form>

  <a class="btn" href="/?entity=<?= urlencode($entity) ?>&action=index">Back</a>
<?php endif; ?>
