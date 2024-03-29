<script type="text/x-template" id="cart-btn-template">
    <button
        type="button"
        id="mini-cart"
        @click="toggleMiniCart"
        :class="`btn btn-link disable-box-shadow ${itemCount == 0 ? 'cursor-not-allowed' : ''}`">

        <div class="mini-cart-content">
            <i class="material-icons-outlined text-down-3">shopping_cart</i>
            <span class="badge" v-text="itemCount" v-if="itemCount != 0"></span>
            <span class="fs18 fw6 cart-text"><?php echo e(__('velocity::app.minicart.cart')); ?></span>
        </div>
        <div class="down-arrow-container">
            <span class="rango-arrow-down"></span>
        </div>
    </button>
</script>

<script type="text/x-template" id="close-btn-template">
    <button type="button" class="close disable-box-shadow">
        <span class="white-text fs20" @click="togglePopup">×</span>
    </button>
</script>

<script type="text/x-template" id="quantity-changer-template">
    <div :class="`quantity control-group ${errors.has(controlName) ? 'has-error' : ''}`">
        <label class="required"><?php echo e(__('shop::app.products.quantity')); ?></label>
        <button type="button" class="decrease" @click="decreaseQty()">-</button>

        <input
            :value="qty"
            class="control"
            :name="controlName"
            :v-validate="validations"
            data-vv-as="&quot;<?php echo e(__('shop::app.products.quantity')); ?>&quot;"
            readonly />

        <button type="button" class="increase" @click="increaseQty()">+</button>

        <span class="control-error" v-if="errors.has(controlName)">{{ errors.first(controlName) }}</span>
    </div>
</script>

<?php echo $__env->make('velocity::UI.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script type="text/x-template" id="logo-template">
    <a
        :class="`left ${addClass}`"
        href="<?php echo e(route('shop.home.index')); ?>">

        <?php if($logo = core()->getCurrentChannel()->logo_url): ?>
            <img class="logo" src="<?php echo e($logo); ?>" />
        <?php else: ?>
            <img class="logo" src="<?php echo e(asset('themes/velocity/assets/images/logo-text.png')); ?>" />
        <?php endif; ?>
    </a>
</script>

<script type="text/x-template" id="searchbar-template">
    <div class="row no-margin right searchbar">
        <div class="col-lg-6 col-md-12 no-padding input-group">
            <form
                method="GET"
                role="search"
                id="search-form"
                action="<?php echo e(route('velocity.search.index')); ?>">

                <div
                    class="btn-toolbar full-width"
                    role="toolbar">

                    <div class="btn-group full-width">
                        <div class="selectdiv">
                            <select class="form-control fs13 styled-select" name="category" @change="focusInput($event)">
                                <option value="">
                                    <?php echo e(__('velocity::app.header.all-categories')); ?>

                                </option>

                                <template v-for="(category, index) in $root.sharedRootCategories">
                                    <option
                                        :key="index"
                                        selected="selected"
                                        :value="category.id"
                                        v-if="(category.id == searchedQuery.category)">
                                        {{ category.name }}
                                    </option>

                                    <option :key="index" :value="category.id" v-else>
                                        {{ category.name }}
                                    </option>
                                </template>
                            </select>

                            <div class="select-icon-container">
                                <span class="select-icon rango-arrow-down"></span>
                            </div>
                        </div>

                        <div class="full-width">

                            <input
                                required
                                name="term"
                                type="search"
                                class="form-control"
                                :value="searchedQuery.term ? searchedQuery.term.split('+').join(' ') : ''"
                                placeholder="<?php echo e(__('velocity::app.header.search-text')); ?>" />

                            <button class="btn" type="submit" id="header-search-icon">
                                <i class="fs16 fw6 rango-search"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>

        <div class="col-6">
            <?php echo view_render_event('bagisto.shop.layout.header.cart-item.before'); ?>

                <?php echo $__env->make('shop::checkout.cart.mini-cart', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo view_render_event('bagisto.shop.layout.header.cart-item.after'); ?>


            <?php echo view_render_event('bagisto.shop.layout.header.compare.before'); ?>

                <a
                    class="compare-btn unset"
                    <?php if(auth()->guard('customer')->check()): ?>
                        href="<?php echo e(route('velocity.customer.product.compare')); ?>"
                    <?php endif; ?>

                    <?php if(auth()->guard('customer')->guest()): ?>
                        href="<?php echo e(route('velocity.product.compare')); ?>"
                    <?php endif; ?>
                    >

                    <i class="material-icons">compare_arrows</i>
                    <div class="badge-container" v-if="compareCount > 0">
                        <span class="badge" v-text="compareCount"></span>
                    </div>
                    <span><?php echo e(__('velocity::app.customer.compare.text')); ?></span>
                </a>
            <?php echo view_render_event('bagisto.shop.layout.header.compare.after'); ?>


            <?php echo view_render_event('bagisto.shop.layout.header.wishlist.before'); ?>

                <a class="wishlist-btn unset" :href="`${isCustomer ? '<?php echo e(route('customer.wishlist.index')); ?>' : '<?php echo e(route('velocity.product.guest-wishlist')); ?>'}`">
                    <i class="material-icons">favorite_border</i>
                    <div class="badge-container" v-if="wishlistCount > 0">
                        <span class="badge" v-text="wishlistCount"></span>
                    </div>
                    <span><?php echo e(__('shop::app.layouts.wishlist')); ?></span>
                </a>
            <?php echo view_render_event('bagisto.shop.layout.header.wishlist.after'); ?>

        </div>
    </div>
</script>

<script type="text/x-template" id="sidebar-categories-template">
    <div class="wrapper" v-if="rootCategories">
        Hello World
    </div>

    <div class="wrapper" v-else-if="subCategory">
        Hello World 2
    </div>
</script>

<script type="text/javascript">
    (() => {
        Vue.component('cart-btn', {
            template: '#cart-btn-template',

            props: ['itemCount'],

            methods: {
                toggleMiniCart: function () {
                    let modal = $('#cart-modal-content')[0];
                    if (modal)
                        modal.classList.toggle('hide');

                    let accountModal = $('.account-modal')[0];
                    if (accountModal)
                        accountModal.classList.add('hide');

                    event.stopPropagation();
                }
            }
        });

        Vue.component('close-btn', {
            template: '#close-btn-template',

            methods: {
                togglePopup: function () {
                    $('#cart-modal-content').hide();
                }
            }
        });

        Vue.component('quantity-changer', {
            template: '#quantity-changer-template',
            inject: ['$validator'],
            props: {
                controlName: {
                    type: String,
                    default: 'quantity'
                },

                quantity: {
                    type: [Number, String],
                    default: 1
                },

                minQuantity: {
                    type: [Number, String],
                    default: 1
                },

                validations: {
                    type: String,
                    default: 'required|numeric|min_value:1'
                }
            },

            data: function() {
                return {
                    qty: this.quantity
                }
            },

            watch: {
                quantity: function (val) {
                    this.qty = val;

                    this.$emit('onQtyUpdated', this.qty)
                }
            },

            methods: {
                decreaseQty: function() {
                    if (this.qty > this.minQuantity)
                        this.qty = parseInt(this.qty) - 1;

                    this.$emit('onQtyUpdated', this.qty)
                },

                increaseQty: function() {
                    this.qty = parseInt(this.qty) + 1;

                    this.$emit('onQtyUpdated', this.qty)
                }
            }
        });

        Vue.component('logo-component', {
            template: '#logo-template',
            props: ['addClass'],
        });

        Vue.component('searchbar-component', {
            template: '#searchbar-template',
            data: function () {
                return {
                    compareCount: 0,
                    wishlistCount: 0,
                    searchedQuery: [],
                    isCustomer: '<?php echo e(auth()->guard('customer')->user() ? "true" : "false"); ?>' == "true",
                }
            },

            watch: {
                '$root.headerItemsCount': function () {
                    this.updateHeaderItemsCount();
                }
            },

            created: function () {
                let searchedItem = window.location.search.replace("?", "");
                searchedItem = searchedItem.split('&');

                let updatedSearchedCollection = {};

                searchedItem.forEach(item => {
                    let splitedItem = item.split('=');
                    updatedSearchedCollection[splitedItem[0]] = splitedItem[1];
                });

                this.searchedQuery = updatedSearchedCollection;

                this.updateHeaderItemsCount();
            },

            methods: {
                'focusInput': function (event) {
                    $(event.target.parentElement.parentElement).find('input').focus();
                },

                'updateHeaderItemsCount': function () {
                    if (! this.isCustomer) {
                        let comparedItems = this.getStorageValue('compared_product');
                        let wishlistedItems = this.getStorageValue('wishlist_product');

                        if (wishlistedItems) {
                            this.wishlistCount = wishlistedItems.length;
                        }

                        if (comparedItems) {
                            this.compareCount = comparedItems.length;
                        }
                    } else {
                        this.$http.get(`${this.$root.baseUrl}/items-count`)
                            .then(response => {
                                this.compareCount = response.data.compareProductsCount;
                                this.wishlistCount = response.data.wishlistedProductsCount;
                            })
                            .catch(exception => {
                                console.log(this.__('error.something_went_wrong'));
                            });
                    }
                }
            }
        });
    })()
</script><?php /**PATH C:\wamp64\www\handloomlk/resources/themes/velocity/views/UI/particals.blade.php ENDPATH**/ ?>