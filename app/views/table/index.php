<a class="btn" href="/?entity=<?= urlencode($entity) ?>&action=create">+ Create</a>
<br><br>

<table>
  <tr>
    <?php foreach ($fields as $f): ?><th><?= htmlspecialchars($f) ?></th><?php endforeach; ?>
    <th>Actions</th>
  </tr>
  <?php foreach ($rows as $r): ?>
    <tr>
      <?php foreach ($fields as $f): ?>
        <td><?= htmlspecialchars((string)($r[$f] ?? '')) ?></td>
      <?php endforeach; ?>
      <td>
        <a href="/?entity=<?= urlencode($entity) ?>&action=show&id=<?= (int)$r[$fields[0]] ?>">view</a> |
        <a href="/?entity=<?= urlencode($entity) ?>&action=edit&id=<?= (int)$r[$fields[0]] ?>">edit</a>
      </td>
    </tr>
  <?php endforeach; ?>
</table>
