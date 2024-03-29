<?php
    $count = $velocityMetaData ? $velocityMetaData->new_products_count : 10;
?>

<new-products></new-products>

<?php $__env->startPush('scripts'); ?>
    <script type="text/x-template" id="new-products-template">
        <div class="container-fluid">
            <shimmer-component v-if="isLoading && !isMobileView"></shimmer-component>

            <template v-else-if="newProducts.length > 0">
                <card-list-header heading="<?php echo e(__('shop::app.home.new-products')); ?>">
                </card-list-header>

                <?php echo view_render_event('bagisto.shop.new-products.before'); ?>


                    <?php if($showRecentlyViewed): ?>
                        <?php $__env->startPush('css'); ?>
                            <style>
                                .recently-viewed {
                                    padding-right: 0px;
                                }
                            </style>
                        <?php $__env->stopPush(); ?>

                        <div class="row ltr">
                            <div class="col-9 no-padding carousel-products vc-full-screen with-recent-viewed" v-if="!isMobileView">
                                <carousel-component
                                    slides-per-page="5"
                                    navigation-enabled="hide"
                                    pagination-enabled="hide"
                                    id="new-products-carousel"
                                    :slides-count="newProducts.length">

                                    <slide
                                        :key="index"
                                        :slot="`slide-${index}`"
                                        v-for="(product, index) in newProducts">
                                        <product-card
                                            :list="list"
                                            :product="product">
                                        </product-card>
                                    </slide>
                                </carousel-component>
                            </div>

                            <div class="col-12 no-padding carousel-products vc-small-screen" v-else>
                                <carousel-component
                                    slides-per-page="2"
                                    navigation-enabled="hide"
                                    pagination-enabled="hide"
                                    id="new-products-carousel"
                                    :slides-count="newProducts.length">

                                    <slide
                                        :key="index"
                                        :slot="`slide-${index}`"
                                        v-for="(product, index) in newProducts">
                                        <product-card
                                            :list="list"
                                            :product="product">
                                        </product-card>
                                    </slide>
                                </carousel-component>
                            </div>

                            <?php echo $__env->make('shop::products.list.recently-viewed', [
                                'quantity'          => 3,
                                'addClass'          => 'col-lg-3 col-md-12',
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    <?php else: ?>
                        <div class="carousel-products vc-full-screen" v-if="!isMobileView">
                            <carousel-component
                                slides-per-page="6"
                                navigation-enabled="hide"
                                pagination-enabled="hide"
                                id="new-products-carousel"
                                :slides-count="newProducts.length">

                                <slide
                                    :key="index"
                                    :slot="`slide-${index}`"
                                    v-for="(product, index) in newProducts">
                                    <product-card
                                        :list="list"
                                        :product="product">
                                    </product-card>
                                </slide>
                            </carousel-component>
                        </div>

                        <div class="carousel-products vc-small-screen" v-else>
                            <carousel-component
                                slides-per-page="2"
                                navigation-enabled="hide"
                                pagination-enabled="hide"
                                id="new-products-carousel"
                                :slides-count="newProducts.length">

                                <slide
                                    :key="index"
                                    :slot="`slide-${index}`"
                                    v-for="(product, index) in newProducts">
                                    <product-card
                                        :list="list"
                                        :product="product">
                                    </product-card>
                                </slide>
                            </carousel-component>
                        </div>
                    <?php endif; ?>

                <?php echo view_render_event('bagisto.shop.new-products.after'); ?>

            </template>
        </div>
    </script>

    <script type="text/javascript">
        (() => {
            Vue.component('new-products', {
                'template': '#new-products-template',
                data: function () {
                    return {
                        'list': false,
                        'isLoading': true,
                        'newProducts': [],
                        'isMobileView': this.$root.isMobile(),
                    }
                },

                mounted: function () {
                    this.getNewProducts();
                },

                methods: {
                    'getNewProducts': function () {
                        this.$http.get(`${this.baseUrl}/category-details?category-slug=new-products&count=<?php echo e($count); ?>`)
                        .then(response => {
                            if (response.data.status)
                                this.newProducts = response.data.products;

                            this.isLoading = false;
                        })
                        .catch(error => {
                            this.isLoading = false;
                            console.log(this.__('error.something_went_wrong'));
                        })
                    }
                }
            })
        })()
    </script>
<?php $__env->stopPush(); ?><?php /**PATH C:\wamp64\www\handloomlk/resources/themes/velocity/views/home/new-products.blade.php ENDPATH**/ ?>