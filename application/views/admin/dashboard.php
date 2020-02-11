<?php include_once(BACK_END_STYLES);
$token = $_SESSION['csrf_token'] ?>
<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3"><?php echo BACK_TITLE ?></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

    </ul>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">Hi,<?php echo $_SESSION['user'] ?></span>
                        </a>
                    </li>
                    <div class="topbar-divider d-none d-sm-block"></div>
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">

                            <form action="<?php echo LOGOUT_URL ?>" method="post">
                                <button class="btn btn-light">Logout</button>
                            </form>

                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"> </span>
                        </a>
                </ul>
            </nav>
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                </div>
                <form action="<?php echo ADD_URL ?>" method="post">
                    <input type="hidden" name="token" value="<?php echo $token ?>">
                    <button class="btn btn-success">Add banner</button>
                </form>
                <br>
                <?php var_dump($token = $_SESSION['csrf_token']); ?>
                <table class="table table-striped table-bordered table-sm" id="example">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Image</th>
                        <th scope="col">Link</th>
                        <th scope="col">Status</th>
                        <th scope="col">Position</th>
                        <th scope="col">Created_at</th>
                        <th scope="col">Updated_at</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php use application\models\Admin;

                    $banners = new Admin();
                    $allBanners = $banners->getBanners(); ?>
                    <?php foreach ($allBanners as $item => $value) : ?>

                        <tr>
                            <th><?php echo htmlspecialchars($value['id']); ?></th>
                            <td><?php echo htmlspecialchars($value['name']) ?></td>
                            <td><?php echo '<img src ="'.htmlspecialchars($value['img']).'" width="250" height="250" />'; ?></td>
                            <td><?php echo htmlspecialchars($value['link']); ?></td>
                            <td><?php echo htmlspecialchars($value['status']); ?></td>
                            <td><?php echo htmlspecialchars($value['pos']); ?></td>
                            <td><?php echo htmlspecialchars($value['created_at']); ?></td>
                            <td><?php echo htmlspecialchars($value['updated_at']); ?></td>
                            <td>
                                <form action="
                                <?php echo DELETE_URL ?>" method="post">
                                    <input type="hidden" name="csrf_token" value=" <?php echo $token ?>">
                                    <button name="delete"
                                            onclick="return confirm('Are you sure you want to delete this item?');"
                                            class="btn btn-danger"
                                            value="<?php echo $value['id'] ?>">
                                        DELETE
                                    </button>
                                </form>

                                <form action="<?php echo EDIT_URL ?>" method="post">
                                    <input type="hidden" name="token" value="<?php echo$token ?>">
                                    <button name="edit" class="btn btn-primary" value="<?php echo $value['id'] ?>">
                                        Edit
                                    </button>
                                </form>
                            </td>

                        </tr>

                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#">1</a></li>
            </ul>
        </nav>
        <?php include_once(FOOTER) ?>

    </div>
</div>

</body>