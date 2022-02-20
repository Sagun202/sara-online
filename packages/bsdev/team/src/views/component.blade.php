
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ Team::countTeam() }}</h3>

                <p>Teams</p>
            </div>
            <div class="icon">
                <i class="ion ion-briefcase"></i>
            </div>
            <a href="{{ route('teams.index') }}" class="small-box-footer">More info <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ Team::countDesignations() }}</h3>

                <p>Designations</p>
            </div>
            <div class="icon">
                <i class="ion ion-medkit"></i>
            </div>
            <a href="{{ route('designations.index') }}" class="small-box-footer">More info <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
