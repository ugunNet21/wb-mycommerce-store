<?php $__env->startSection('title','Order Detail'); ?>

<?php $__env->startSection('main-content'); ?>
<div class="card">
<h5 class="card-header">Pemesanan<a href="<?php echo e(route('order.pdf',$order->id)); ?>" class=" btn btn-sm btn-primary shadow-sm float-right"><i class="fas fa-download fa-sm text-white-50"></i> Generate PDF</a>
  </h5>
  <div class="card-body">
    <?php if($order): ?>
    <table class="table table-striped table-hover">
      <thead>
        <tr>
            <th>S.N.</th>
            <th>Order No.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Banyak</th>
            <th>Biaya</th>
            <th>Jumlah Total</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr>
            <?php
                $shipping_charge=DB::table('shippings')->where('id',$order->shipping_id)->pluck('price');
            ?> 
            <td><?php echo e($order->id); ?></td>
            <td><?php echo e($order->order_number); ?></td>
            <td><?php echo e($order->first_name); ?> <?php echo e($order->last_name); ?></td>
            <td><?php echo e($order->email); ?></td>
            <td><?php echo e($order->quantity); ?></td>
            <td><?php $__currentLoopData = $shipping_charge; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> Rp. <?php echo e(number_format($data,2)); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></td>
            <td>Rp. <?php echo e(number_format($order->total_amount,2)); ?></td>
            <td>
                <?php if($order->status=='new'): ?>
                  <span class="badge badge-primary"><?php echo e($order->status); ?></span>
                <?php elseif($order->status=='process'): ?>
                  <span class="badge badge-warning"><?php echo e($order->status); ?></span>
                <?php elseif($order->status=='delivered'): ?>
                  <span class="badge badge-success"><?php echo e($order->status); ?></span>
                <?php else: ?>
                  <span class="badge badge-danger"><?php echo e($order->status); ?></span>
                <?php endif; ?>
            </td>
            <td>
                <form method="POST" action="<?php echo e(route('order.destroy',[$order->id])); ?>">
                  <?php echo csrf_field(); ?> 
                  <?php echo method_field('delete'); ?>
                      <button class="btn btn-danger btn-sm dltBtn" data-id=<?php echo e($order->id); ?> style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                </form>
            </td>
          
        </tr>
      </tbody>
    </table>

    <section class="confirmation_part section_padding">
      <div class="order_boxes">
        <div class="row">
          <div class="col-lg-6 col-lx-4">
            <div class="order-info">
              <h4 class="text-center pb-4">INFORMASI PEMESANAN</h4>
              <table class="table">
                    <tr class="">
                        <td>Nomor Pesanan</td>
                        <td> : <?php echo e($order->order_number); ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Pemesanan</td>
                        <td> : <?php echo e($order->created_at->format('D d M, Y')); ?> at <?php echo e($order->created_at->format('g : i a')); ?> </td>
                    </tr>
                    <tr>
                        <td>Banyak</td>
                        <td> : <?php echo e($order->quantity); ?></td>
                    </tr>
                    <tr>
                        <td>Status Pemesanan</td>
                        <td> : <?php echo e($order->status); ?></td>
                    </tr>
                    <tr>
                      <?php
                          $shipping_charge=DB::table('shippings')->where('id',$order->shipping_id)->pluck('price');
                      ?>
                        <td>Shipping Charge</td>
                        <td> : Rp. <?php echo e(number_format($shipping_charge[0],2)); ?></td>
                    </tr>
                    <tr>
                        <td>Jumlah Total</td>
                        <td> : Rp. <?php echo e(number_format($order->total_amount,2)); ?></td>
                    </tr>
                    <tr>
                      <td>Metode Pembayran</td>
                      <td> : <?php if($order->payment_method=='cod'): ?> Cash on Delivery <?php else: ?> BANK <?php endif; ?></td>
                    </tr>
                    <tr>
                        <td>Status Pembayaran</td>
                        <td> : <?php echo e($order->payment_status); ?></td>
                    </tr>
              </table>
            </div>
          </div>

          <div class="col-lg-6 col-lx-4">
            <div class="shipping-info">
              <h4 class="text-center pb-4">INFORMASI PENGIRIMAN</h4>
              <table class="table">
                    <tr class="">
                        <td>Nama</td>
                        <td> : <?php echo e($order->first_name); ?> <?php echo e($order->last_name); ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td> : <?php echo e($order->email); ?></td>
                    </tr>
                    <tr>
                        <td>Hp/Tlp</td>
                        <td> : <?php echo e($order->phone); ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td> : <?php echo e($order->address1); ?>, <?php echo e($order->address2); ?></td>
                    </tr>
                    <tr>
                        <td>Negara</td>
                        <td> : <?php echo e($order->country); ?></td>
                    </tr>
                    <tr>
                        <td>Kode POS</td>
                        <td> : <?php echo e($order->post_code); ?></td>
                    </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php endif; ?>

  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .order-info,.shipping-info{
        background:#ECECEC;
        padding:20px;
    }
    .order-info h4,.shipping-info h4{
        text-decoration: underline;
    }

</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('user.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\01. Advance-Ecommerce-in-laravel-7-pending\resources\views/user/order/show.blade.php ENDPATH**/ ?>