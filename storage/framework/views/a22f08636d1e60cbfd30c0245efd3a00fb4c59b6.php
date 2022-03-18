<?php $__env->startSection('title','Track Order'); ?>

<?php $__env->startSection('main-content'); ?>
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="<?php echo e(route('home')); ?>">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0);">Order Track</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
<section class="tracking_box_area section_gap py-5">
    <div class="container">
        <div class="tracking_box_inner">
            <p>Untuk melacak pesanan Anda, silakan masukkan ID Pesanan Anda di kotak di bawah ini dan tekan tombol "Lacak". Ini diberikan kepada Anda pada tanda terima Anda dan dalam email konfirmasi yang seharusnya Anda terima.</p>
            <form class="row tracking_form my-4" action="<?php echo e(route('product.track.order')); ?>" method="post" novalidate="novalidate">
              <?php echo csrf_field(); ?>
                <div class="col-md-8 form-group">
                    <input type="text" class="form-control p-2"  name="order_number" placeholder="Enter your order number">
                </div>
                <div class="col-md-8 form-group">
                    <button type="submit" value="submit" class="btn submit_btn">Cek Pesanan</button>
                </div>
            </form>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\01. Advance-Ecommerce-in-laravel-7-pending\resources\views/frontend/pages/order-track.blade.php ENDPATH**/ ?>