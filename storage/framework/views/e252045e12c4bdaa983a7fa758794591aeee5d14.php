<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('admin::app.settings.currencies.title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1><?php echo e(__('admin::app.settings.currencies.title')); ?></h1>
            </div>

            <div class="page-action">
                <a href="<?php echo e(route('admin.currencies.create')); ?>" class="btn btn-lg btn-primary">
                    <?php echo e(__('admin::app.settings.currencies.add-title')); ?>

                </a>
            </div>
        </div>

        <div class="page-content">
            <?php $currencies = app('Webkul\Admin\DataGrids\CurrencyDataGrid'); ?>
            <?php echo $currencies->render(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\handloomlk\vendor\bagisto\bagisto\packages\Webkul\Admin\src\Providers/../Resources/views/settings/currencies/index.blade.php ENDPATH**/ ?>