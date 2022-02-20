<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-danger">
        <div class="inner">
            <h3>{{ count(Ecommerce::pendingOrderCount()) }}</h3>

            <p>Pending Orders</p>
        </div>
        <div class="icon">
            <i class="ion ion-bag"></i>
        </div>
        <a href="{{ route('orders.index') }}" class="small-box-footer">More info <i
                class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
        <div class="inner">
            <h3>{{ count(Ecommerce::confirmOrderCount()) }}</h3>

            <p>Confirmed Orders</p>
        </div>
        <div class="icon">
            <i class="ion ion-bag"></i>
        </div>
        <a href="{{ route('orders.index') }}" class="small-box-footer">More info <i
                class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
        <div class="inner">
            <h3>{{ count(Ecommerce::packedOrderCount()) }}</h3>

            <p>Packed Orders</p>
        </div>
        <div class="icon">
            <i class="ion ion-bag"></i>
        </div>
        <a href="{{ route('orders.index') }}" class="small-box-footer">More info <i
                class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-blue">
        <div class="inner">
            <h3>{{ count(Ecommerce::deliveredOrderCount()) }}</h3>

            <p>Delivered Orders</p>
        </div>
        <div class="icon">
            <i class="ion ion-bag"></i>
        </div>
        <a href="{{ route('orders.index') }}" class="small-box-footer">More info <i
                class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-red">
        <div class="inner">
            <h3>{{ count(Ecommerce::cancelledOrderCount()) }}</h3>

            <p>Cancelled Orders</p>
        </div>
        <div class="icon">
            <i class="ion ion-bag"></i>
        </div>
        <a href="{{ route('orders.index') }}" class="small-box-footer">More info <i
                class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>