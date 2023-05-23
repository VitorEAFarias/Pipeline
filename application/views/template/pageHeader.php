<section class="content-header">
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1><?= (isset($title)) ? $title : "" ?></h1>
        </div>
        <div class="col-sm-6">
        <?php if(isset($breadcrumb) && is_array($breadcrumb)): ?>      
            <ol class="breadcrumb float-sm-right">
                <?php foreach($breadcrumb as $item): ?>
                    <li class="breadcrumb-item"><a href="#"><?= $item ?></a></li>
                <?php endforeach; ?>
            </ol>
            <?php endif; ?>
        </div>
    </div>
</div><!-- /.container-fluid -->
</section>