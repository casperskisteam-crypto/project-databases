<?php
$isEdit = !empty($row[$pk]);
$action = $isEdit ? "edit&id=".(int)$row[$pk] : "create";
?>

<form method="post" action="/?entity=<?= urlencode($entity) ?>&action=<?= $action ?>">
  <table>
    <?php foreach ($fields as $f): ?>
      <tr>
        <th style="width:260px;"><?= htmlspecialchars($f) ?></th>
        <td>
          <?php
            // FK dropdowns
            if ($f === 'id_Client') {
              echo '<select name="id_Client" required>';
              foreach (($fk['clients'] ?? []) as $c) {
                $sel = ((string)$row['id_Client'] === (string)$c['id_client']) ? 'selected' : '';
                echo '<option value="'.(int)$c['id_client'].'" '.$sel.'>'.(int)$c['id_client'].' — '.htmlspecialchars($c['PIB']).'</option>';
              }
              echo '</select>';
            } elseif ($f === 'id_Reservation') {
              echo '<select name="id_Reservation" required>';
              foreach (($fk['reservations'] ?? []) as $r) {
                $val = (int)$r['id_Reservation'];
                $sel = ((string)$row['id_Reservation'] === (string)$val) ? 'selected' : '';
                echo '<option value="'.$val.'" '.$sel.'>'.$val.'</option>';
              }
              echo '</select>';
            } elseif ($f === 'id_Service') {
              echo '<select name="id_Service" required>';
              foreach (($fk['services'] ?? []) as $s) {
                $val = (int)$s['id_Service'];
                $sel = ((string)$row['id_Service'] === (string)$val) ? 'selected' : '';
                echo '<option value="'.$val.'" '.$sel.'>'.$val.' — '.htmlspecialchars($s['name']).'</option>';
              }
              echo '</select>';
            } else {
              // description -> textarea
              if ($f === 'description') {
                echo '<textarea name="description">'.htmlspecialchars((string)($row[$f] ?? '')).'</textarea>';
              } else {
                // PK редагувати НЕ забороняємо, але зазвичай краще не міняти: при edit зробимо readonly
                $readonly = ($isEdit && $f === $pk) ? 'readonly' : '';
                echo '<input name="'.htmlspecialchars($f).'" value="'.htmlspecialchars((string)($row[$f] ?? '')).'" '.$readonly.' required>';
              }
            }
          ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
  <br>
  <button type="submit">Save</button>
  <a class="btn" href="/?entity=<?= urlencode($entity) ?>&action=index">Cancel</a>
</form>
