<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('velocity::app.admin.meta-data.title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content">
        <form
            method="POST"
            @submit.prevent="onSubmit"
            enctype="multipart/form-data"
            <?php if($metaData): ?>
                action="<?php echo e(route('velocity.admin.store.meta-data', ['id' => $metaData->id])); ?>"
            <?php else: ?>
                action="<?php echo e(route('velocity.admin.store.meta-data', ['id' => 'new'])); ?>"
            <?php endif; ?>
            >

            <?php echo csrf_field(); ?>

            <div class="page-header">
                <div class="page-title">
                    <h1><?php echo e(__('velocity::app.admin.meta-data.title')); ?></h1>
                </div>
                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        <?php echo e(__('velocity::app.admin.meta-data.update-meta-data')); ?>

                    </button>
                </div>
            </div>

            <accordian :title="'<?php echo e(__('velocity::app.admin.meta-data.general')); ?>'" :active="true">
                <div slot="body">
                    <div class="control-group">
                        <label><?php echo e(__('velocity::app.admin.meta-data.activate-slider')); ?></label>

                        <label class="switch">
                            <input
                                id="slides"
                                name="slides"
                                type="checkbox"
                                class="control"
                                data-vv-as="&quot;slides&quot;"
                                <?php echo e($metaData && $metaData->slider ? 'checked' : ''); ?> />
                                
                            <span class="slider round"></span>
                        </label>
                    </div>

                    <div class="control-group">
                        <label><?php echo e(__('velocity::app.admin.meta-data.sidebar-categories')); ?></label>

                        <input
                            type="text"
                            class="control"
                            id="sidebar_category_count"
                            name="sidebar_category_count"
                            value="<?php echo e($metaData ? $metaData->sidebar_category_count : '10'); ?>" />
                    </div>

                    <div class="control-group">
                        <label><?php echo e(__('shop::app.home.featured-products')); ?></label>

                        <input
                            type="text"
                            class="control"
                            id="featured_product_count"
                            name="featured_product_count"
                            value="<?php echo e($metaData ? $metaData->featured_product_count : 10); ?>" />
                    </div>

                    <div class="control-group">
                        <label><?php echo e(__('shop::app.home.new-products')); ?></label>

                        <input
                            type="text"
                            class="control"
                            id="new_products_count"
                            name="new_products_count"
                            value="<?php echo e($metaData ? $metaData->new_products_count : 10); ?>" />
                    </div>

                    <div class="control-group">
                        <label><?php echo e(__('velocity::app.admin.meta-data.home-page-content')); ?></label>

                        <textarea
                            class="control"
                            id="home_page_content"
                            name="home_page_content">
                            <?php echo e($metaData ? $metaData->home_page_content : ''); ?>

                        </textarea>
                    </div>

                    <div class="control-group">
                        <label><?php echo e(__('velocity::app.admin.meta-data.product-policy')); ?></label>

                        <textarea
                            class="control"
                            id="product-policy"
                            name="product_policy">
                            <?php echo e($metaData ? $metaData->product_policy : ''); ?>

                        </textarea>
                    </div>

                </div>
            </accordian>

            <accordian :title="'<?php echo e(__('velocity::app.admin.meta-data.images')); ?>'" :active="false">
                <div slot="body">
                    <div class="control-group">
                        <label><?php echo e(__('velocity::app.admin.meta-data.advertisement-four')); ?></label>

                        <?php
                            $images = [
                                4 => [],
                                3 => [],
                                2 => [],
                            ];
                            $advertisement = json_decode($metaData->get('advertisement')->all()[0]->advertisement, true);
                        ?>

                        <?php if(! isset($advertisement[4])): ?>
                            <image-wrapper
                                input-name="images[4]"
                                :button-label="'<?php echo e(__('velocity::app.admin.meta-data.add-image-btn-title')); ?>'">
                            </image-wrapper>
                        <?php else: ?>
                            <?php $__currentLoopData = $advertisement[4]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $images[4][] = [
                                        'id' => 'image_' . $index,
                                        'url' => asset('/storage/' . $image),
                                    ];
                                ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <image-wrapper
                                :multiple="true"
                                input-name="images[4]"
                                :images='<?php echo json_encode($images[4], 15, 512) ?>'
                                :button-label="'<?php echo e(__('velocity::app.admin.meta-data.add-image-btn-title')); ?>'">
                            </image-wrapper>
                        <?php endif; ?>
                    </div>

                    <div class="control-group">
                        <label><?php echo e(__('velocity::app.admin.meta-data.advertisement-three')); ?></label>
                        <?php if(! isset($advertisement[3])): ?>
                            <image-wrapper
                                :button-label="'<?php echo e(__('velocity::app.admin.meta-data.add-image-btn-title')); ?>'"
                                input-name="images[3]">
                            </image-wrapper>
                        <?php else: ?>
                            <?php $__currentLoopData = $advertisement[3]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $images[3][] = [
                                        'id' => 'image_' . $index,
                                        'url' => asset('/storage/' . $image),
                                    ];
                                ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <image-wrapper
                                input-name="images[3]"
                                :images='<?php echo json_encode($images[3], 15, 512) ?>'
                                :button-label="'<?php echo e(__('velocity::app.admin.meta-data.add-image-btn-title')); ?>'">
                            </image-wrapper>
                        <?php endif; ?>
                    </div>

                    <div class="control-group">
                        <label><?php echo e(__('velocity::app.admin.meta-data.advertisement-two')); ?></label>

                        <?php if(! isset($advertisement[2])): ?>
                            <image-wrapper
                                :button-label="'<?php echo e(__('velocity::app.admin.meta-data.add-image-btn-title')); ?>'"
                                input-name="images[2]">
                            </image-wrapper>
                        <?php else: ?>
                            <?php $__currentLoopData = $advertisement[2]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $images[2][] = [
                                        'id' => 'image_' . $index,
                                        'url' => asset('/storage/' . $image),
                                    ];
                                ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <image-wrapper
                                input-name="images[2]"
                                :images='<?php echo json_encode($images[2], 15, 512) ?>'
                                :button-label="'<?php echo e(__('velocity::app.admin.meta-data.add-image-btn-title')); ?>'">
                            </image-wrapper>
                        <?php endif; ?>
                    </div>
                </div>
            </accordian>

            <accordian :title="'<?php echo e(__('velocity::app.admin.meta-data.footer')); ?>'" :active="false">
                <div slot="body">
                    <div class="control-group">
                        <label><?php echo e(__('velocity::app.admin.meta-data.subscription-content')); ?></label>

                        <textarea
                            class="control"
                            id="subscription_bar_content"
                            name="subscription_bar_content">
                            <?php echo e($metaData ? $metaData->subscription_bar_content : ''); ?>

                        </textarea>
                    </div>

                    <div class="control-group">
                        <label><?php echo e(__('velocity::app.admin.meta-data.footer-left-content')); ?></label>

                        <textarea
                            class="control"
                            id="footer_left_content"
                            name="footer_left_content">
                            <?php echo e($metaData ? $metaData->footer_left_content : ''); ?>

                        </textarea>
                    </div>

                    <div class="control-group">
                        <label><?php echo e(__('velocity::app.admin.meta-data.footer-middle-content')); ?></label>

                        <textarea
                            class="control"
                            id="footer_middle_content"
                            name="footer_middle_content">
                            <?php echo e($metaData ? $metaData->footer_middle_content : ''); ?>

                        </textarea>
                    </div>
                </div>
            </accordian>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('vendor/webkul/admin/assets/js/tinyMCE/tinymce.min.js')); ?>"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            tinymce.init({
                height: 200,
                width: "100%",
                image_advtab: true,
                valid_elements : '*[*]',
                selector: 'textarea#home_page_content,textarea#footer_left_content,textarea#subscription_bar_content,textarea#footer_middle_content,textarea#product-policy',
                plugins: 'image imagetools media wordcount save fullscreen code',
                toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat | code',
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin::layouts.content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/suhailinfo/domains/suhail.info/public_html/vendor/bagisto/bagisto/packages/Webkul/Velocity/src/Providers/../Resources/views/admin/meta-info/meta-data.blade.php ENDPATH**/ ?>