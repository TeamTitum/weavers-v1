<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('admin::app.settings.exchange_rates.title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1><?php echo e(__('admin::app.settings.exchange_rates.title')); ?></h1>
            </div>

            <div class="page-action">
                <a href="<?php echo e(route('admin.exchange_rates.update_rates')); ?>" class="btn btn-lg btn-primary">
                    <?php echo e(__('admin::app.settings.exchange_rates.update-rates')); ?>

                </a>

                <a href="<?php echo e(route('admin.exchange_rates.create')); ?>" class="btn btn-lg btn-primary">
                    <?php echo e(__('admin::app.settings.exchange_rates.add-title')); ?>

                </a>
            </div>
        </div>

        <div class="page-content">

            <?php echo app('Webkul\Admin\DataGrids\ExchangeRatesDataGrid')->render(); ?>

            
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\weavers-v1\vendor\bagisto\bagisto\packages\Webkul\Admin\src\Providers/../Resources/views/settings/exchange_rates/index.blade.php ENDPATH**/ ?>