<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('admin::app.settings.locales.title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1><?php echo e(__('admin::app.settings.locales.title')); ?></h1>
            </div>

            <div class="page-action">
                <a href="<?php echo e(route('admin.locales.create')); ?>" class="btn btn-lg btn-primary">
                    <?php echo e(__('admin::app.settings.locales.add-title')); ?>

                </a>
            </div>
        </div>

        <div class="page-content">

            <?php $locales = app('Webkul\Admin\DataGrids\LocalesDataGrid'); ?>
            <?php echo $locales->render(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\weavers-v1\vendor\bagisto\bagisto\packages\Webkul\Admin\src\Providers/../Resources/views/settings/locales/index.blade.php ENDPATH**/ ?>