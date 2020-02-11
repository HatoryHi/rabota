<?php use application\models\Admin;

require_once(BACK_END_STYLES) ?>
<body id="page-top">

<div id="wrapper">

    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3"><?php echo BACK_TITLE ?></div>
        </a>
        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="#">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Edit</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
    </ul>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
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
                <?php $getform = new Admin();
                $id = htmlspecialchars(trim($_POST['edit']));
                $edit_data = $getform->getItembyId($id);
                var_dump($edit_data);
                ?>
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Edit</h1>
                </div>
                <form action="<?php echo UPDATE_URL ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" value="<?php echo $_SESSION['csrf_token'] ?>">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="id"
                               placeholder="Enter title" name="id" value="<?php echo $edit_data[0]['id'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Title</label>
                        <input type="text" class="form-control" id="exampleInputEmail1"
                               placeholder="Enter title" name="name"
                               value="<?php echo $edit_data[0]['name'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control-file" id="image" name="image"
                               value="<?php echo $edit_data[0]['img'] ?>">
                        <br>
                        <td><?php echo '<img src ="'.htmlspecialchars($edit_data[0]['img']).'" width="250" height="250" />'; ?></td>

                    </div>

                    <div class="form-group">
                        <label for="link">Link</label>
                        <input type="text" class="form-control" id="link" placeholder="Enter link" name="link"
                               value="<?php echo $edit_data[0]['link'] ?>">
                    </div>
                    <?php
                    if ($edit_data[0]['status'] == 1) {
                        echo 'Current status is : Active';

                    } else {
                        echo 'Current status is : Not Active';
                    } ?>
                    <div class="form-group">

                        <label for="status"></label><select class="form-control" name="status" id="status">
                            <option value="1">Active</option>
                            <option value="0">Not Active</option>

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="position">Позиция в слайдере</label>
                        <input type="number" class="form-control" id="position" placeholder="Enter number"
                               name="position" min="0"
                               value="<?php echo $edit_data[0]['pos'] ?>">
                    </div>
                    <button name="upd" type="submit" class="btn btn-primary">Submit</button>
                    <button type="submit" class="btn btn-dark" onclick="history.back()">Back to Dashboard</button>
                </form>
                <br>
            </div>
        </div>
        <?php include_once(FOOTER) ?>
    </div>
</div>
</body>