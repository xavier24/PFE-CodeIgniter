<section class="content">
    <div class="row-fluid accueil">
        <h1><?php echo $titre ?></h1>
        <?php if($conversations){
            foreach($conversations as $conversation): ?>
                <div class="conversation">
                    <p><?php echo $conversation->correspondant->username ?></p>
                    <p>dernier message : <?php echo $conversation->message ?></p>
                    <p>id convers: <?php echo $conversation->id_convers ?></p>
                    <a href="<?php echo base_url() ?>message/voir/<?php echo $conversation->correspondant->user_id ?>">voir</a>
                </div>
            <?php endforeach; 
        }?>
    </div>
</section>
