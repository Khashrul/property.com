<?php
    $schemes = array("info", "warning", "primary", "success", "default", "danger");
?>

<nav class="navbar main-menu-cont">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar icon-bar1"></span>
                            <span class="icon-bar icon-bar2"></span>
                            <span class="icon-bar icon-bar3"></span>
                        </button>
                        <!--
                        <a href="index.html" title="" class="navbar-brand">
                            <img src="images/logo-dark.png" alt="Apartment - Premium Real Estate Template" />
                        </a>
                        -->
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="index.html" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dashboard</a>
                                <ul class="dropdown-menu">
                                    <li><a href="index.html">Homepage 1 - slider</a></li>
                                    <li><a href="index-map.html">Homepage 1 - map</a></li>
                                    <li><a href="index2.html">Homepage 2 - slider</a></li>
                                    <li><a href="index2-map.html">Homepage 2 - map</a></li>
                                    <li><a href="index3.html">One Page Single Propery - slider</a></li>
                                    <li><a href="index3-street-view.html">One Page Single Propery - panorama!</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Listings</a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-submenu">
                                        <a tabindex="-1" href="listing-grid-right-sidebar.html">Grid Listing</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="listing-grid-right-sidebar.html">Right Sidebar</a></li>
                                            <li><a href="listing-grid-left-sidebar.html">Left Sidebar</a></li>
                                            <li><a href="listing-grid-no-sidebar.html">No Sidebar</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu">
                                        <a tabindex="-1" href="listing-masonry-right-sidebar.html">Masonry Listing</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="listing-masonry-right-sidebar.html">Right Sidebar</a></li>
                                            <li><a href="listing-masonry-left-sidebar.html">Left Sidebar</a></li>
                                            <li><a href="listing-masonry-no-sidebar.html">No Sidebar</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu">
                                        <a tabindex="-1" href="listing-list-right-sidebar.html">Classic Listing</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="listing-list-right-sidebar.html">Right Sidebar</a></li>
                                            <li><a href="listing-list-left-sidebar.html">Left Sidebar</a></li>
                                            <li><a href="listing-list-no-sidebar.html">No Sidebar</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu">
                                        <a tabindex="-1" href="estate-details-right-sidebar.html">Single Property</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="estate-details-right-sidebar.html">Right Sidebar</a></li>
                                            <li><a href="estate-details-left-sidebar.html">Left Sidebar</a></li>
                                            <li><a href="estate-details-no-sidebar.html">No Sidebar</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Agencies</a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-submenu">
                                        <a tabindex="-1" href="agencies-listing-right-sidebar.html">Agencies Listing</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="agencies-listing-right-sidebar.html">Right Sidebar</a></li>
                                            <li><a href="agencies-listing-left-sidebar.html">Left Sidebar</a></li>
                                            <li><a href="agencies-listing-no-sidebar.html">No Sidebar</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu">
                                        <a tabindex="-1" href="agency-details-right-sidebar.html">Agency Details</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="agency-details-right-sidebar.html">Right Sidebar</a></li>
                                            <li><a href="agency-details-left-sidebar.html">Left Sidebar</a></li>
                                            <li><a href="agency-details-no-sidebar.html">No Sidebar</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu">
                                        <a tabindex="-1" href="agents-right-sidebar.html">Agents List</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="agents-right-sidebar.html">Right Sidebar</a></li>
                                            <li><a href="agents-left-sidebar.html">Left Sidebar</a></li>
                                            <li><a href="agents-no-sidebar.html">No Sidebar</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu">
                                        <a tabindex="-1" href="agent-right-sidebar.html">Agent Details</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="agent-right-sidebar.html">Right Sidebar</a></li>
                                            <li><a href="agent-left-sidebar.html">Left Sidebar</a></li>
                                            <li><a href="agent-no-sidebar.html">No Sidebar</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="/admin/logout" class="special-color">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </nav><!-- /.mani-menu-cont -->

<div class="row">
    <div class="col-sm-3 col-md-3 col-lg-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>::Left Menu</h4>
            </div>

            <div class="list-group">
                <?php for($i=0;$i<sizeof($schemes);$i++){ ?>
                    <a href="#" class="list-group-item list-group-item-<?=$schemes[$i]?>"><?=$schemes[$i]?></a>
                <?php } ?>
            </div>

        </div>
    </div>
    <div class="col-sm-9 col-md-9 col-lg-9">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
                        <h1>Dashboard</h1>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
                        <div style="margin-top: 5%;">
                            <form>
                                <div class="input-group">
                                    <input id="search" type="text" class="form-control" name="search" placeholder="Search">
                                    <div class="input-group-btn">
                                        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <?php for($i=0;$i<sizeof($schemes);$i++){ ?>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="panel panel-<?=$schemes[$i]?>">
                                <div class="panel-heading">
                                    <h4><?=$schemes[$i]?></h4>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-condensed table-responsive">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Firstname</th>
                                                    <th>Lastname</th>
                                                    <th>Age</th>
                                                    <th>City</th>
                                                    <th>Country</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Anna</td>
                                                    <td>Pitt</td>
                                                    <td>35</td>
                                                    <td>New York</td>
                                                    <td>USA</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Brad</td>
                                                    <td>Pitt</td>
                                                    <td>39</td>
                                                    <td>Dhaka</td>
                                                    <td>BD</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>SR</td>
                                                    <td>K</td>
                                                    <td>59</td>
                                                    <td>Mumbai</td>
                                                    <td>IN</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <a href="#" class="btn btn-<?=$schemes[$i]?> pull-right" role="button">More</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="panel-footer">&copy; Apartment <?=date('Y')?></div>
        </div>
    </div>
</div>
