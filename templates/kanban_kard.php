<div class="card card-info card-outline" data-task-id=<?=$task['id']?>>
    <div class="card-header">
        <h5 class="card-title"><?=htmlentities($task['title'])?></h5>
        <div class="card-tools">
            <a href="#" class="btn btn-tool btn-link">#3</a>
            <a href="#" class="btn btn-tool">
                <i class="fas fa-pen"></i>
            </a>
        </div>
    </div>
    <div class="card-body">
        <p>
        <?=htmlentities($task['description']);?>
        </p>
        <?php if(!empty($task['due_date'])):?>
           <small class="<?=daytime($task['due_date']) ? 'badge-success' : 'badge-danger';?>">
               <?=hourCard($task['due_date']);?>
               <i class="far fa-clock">hours</i>
           </small>
        <?php endif; ?>
    </div>
</div>

