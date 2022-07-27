<div class="col-12 col-sm-6 col-lg-12" id="viewMessage">
    <div class="card chat-box">
        <div class="card-header">
        <?php if ($user == 'online') { ?>
            <h4><i class="fas fa-circle text-success mr-2" data-toggle="tooltip"></i> <?= $user['first_name']; ?> <?= $last_name; ?></h4>
        <?php } else if ($user == 'offline') { ?>
            <h4><i class="fas fa-circle text-muted mr-2" data-toggle="tooltip"></i> <?= $user['first_name']; ?> <?= $last_name; ?></h4>
            <div class="text-muted text-small font-600-bold"></i> Offline</div>
        <?php } ?>
        </div>
        <div class="card-body chat-content">
            <?php foreach($chat as $c){ ?>
                <?php if($c['sender_id'] != 1) { ?>
                <div class="chat-item chat-left">
                    <img src="<?= site_url('/img/avatar/'.$c['image']) ?>" alt="avatar">
                    <div class="chat-details">
                        <div class="chat-text"><?= $c['message'] ?></div>
                        <div class="chat-time"><?= date('H:i', strtotime($c['time'])) ?></div>
                    </div>
                </div>
                <?php } ?>
                <?php if($c['sender_id'] == 1) { ?>
                <div class="chat-item chat-right">
                    <img src="<?= site_url('/img/avatar/'.$c['image']) ?>" class="rounded-circle" width="50" alt="avatar">
                    <div class="chat-details">
                        <div class="chat-text"><?= $c['message'] ?></div>
                        <div class="chat-time"><?= date('H:i', strtotime($c['time'])) ?></div>
                    </div>
                </div>
                <?php } ?>
            <?php } ?>
        </div>
        <div class="card-footer chat-form">
            <form action="send" method="post">
                <input type="hidden" name="sender_id" id="sender_id" value="<?= session('id') ?>">
                <input type="text" name="message" class="form-control" placeholder="Ketik pesan">
                <button type="submit" class="btn btn-primary">
                    <i class="far fa-paper-plane"></i>
                </button>
            </form>
        </div>
    </div>
</div>