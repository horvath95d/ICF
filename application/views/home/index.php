<section>
    <div class="container my-3">
        <div><?=$data['user']['username']?></div>
        <div>Felhasználó csoportjait:</div>
        <ul>
            <?php foreach ($data['groups'] as $group): ?>
                <li><?=$group['name']?></li>
            <?php endforeach ?>
        </ul>
        <div>Utolsó bejelentkezés: <br><?=date("Y-m-d H:i:s", $data['user']['last_login'])?></div>
    <div>
</section>