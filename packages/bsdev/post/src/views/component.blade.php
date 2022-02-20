
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ Post::countTotalPost() }}</h3>

                <p>Total Post</p>
            </div>
            <div class="icon">
                <i class="ion ion-compose"></i>
            </div>
            <a href="{{ route('posts.index') }}" class="small-box-footer">More info <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ Post::countTotalType() }}</h3>
                <p>Post Types</p>
            </div>
            <div class="icon">
                <i class="ion ion-grid"></i>
            </div>
            <a href="{{ route('types.index') }}" class="small-box-footer">More info <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3>{{ Post::countTotalCategory() }}</h3>

                <p>Post Category</p>
            </div>
            <div class="icon">
                <i class="ion ion-levels"></i>
            </div>
            <a href="{{ route('categories.index') }}" class="small-box-footer">More info <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ Post::countComment() }}</h3>

                <p>Comments</p>
            </div>
            <div class="icon">
                <i class="ion ion-chatbubble-working"></i>
            </div>
            <a href="{{ route('postcomment.index') }}" class="small-box-footer">More info <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

