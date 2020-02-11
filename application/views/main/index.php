<?php
require_once(FRONT_END_STYLES);
use application\models\Admin;
$banners = new Admin();
$listBanners = $banners->getBanners(); ?>

<div id="wrapper">

    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3"><?php echo FRONT_TITLE ?></div>
        </a>

        <hr class="sidebar-divider my-0">

    </ul>

    <div id="content-wrapper" class="d-flex flex-column">

        <div id="content">

            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <ul class="navbar-nav ml-auto">

                    <form action="admin/index/" method="post">
                        <button class="btn btn-light">Sign in</button>
                    </form>

                </ul>

            </nav>

            <div class="container-fluid ">
                <div class="flexslider" id="flexslider-basic">
                    <ul class="slides">
                        <?php foreach ($listBanners as $data => $bannerData) : ?>
                            <?php if ($bannerData['status'] == true) { ?>
                                <li>
                                    <?php echo $bannerData['name']; ?>
                                    <a href="<?php echo $bannerData['link'] ?>"><img
                                                src="<?php echo $bannerData['img'] ?>" alt="">
                                    </a>
                                </li>
                            <?php } ?>
                        <?php endforeach; ?>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once(FOOTER); ?>
