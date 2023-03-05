    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1>Додати проект</h1>
                    </div>
                    <div class="col-sm-6 d-none d-sm-block">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Додати проект</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <form action="add.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Основні</h3>

                                <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputName">Назва задачі</label>
                                    <input type="text" id="inputName" name="inputName" required class="form-control
                                        <?=!empty($errors['inputName']) ? ' is-invalid' : ''?>"
                                        "<?=!empty($errors['inputName']) ?
                                        '<span id="Name-error" class="error invalid-feedback">' .
                                        htmlspecialchars($errors['inputName']) . '</span>' : ''?>
                                </div>
                                <div class="form-group">
                                    <label for="inputDescription">Опис задачі</label>
                                    <textarea id="inputDescription" name="inputDescription" class="form-control
                                         <?=!empty($errors['inputDescription']) ? ' is-invalid' : ''?>" rows="4">
                                    </textarea>
                                        <?=!empty($errors['inputDescription']) ?
                                        '<span id="Name-error" class="error invalid-feedback">' .
                                        htmlspecialchars($errors['inputDescription']) . '</span>'  : ''?>

                                </div>
                                <div class="form-group">
                                    <label for="selectProject">Оберіть проект</label>
                                    <select required id="selectProject" name="selectProject" class="form-control
                                        <?=!empty($errors['selectProject']) ? ' is-invalid' : ''?>"
                                    <option></option>
                                        <?php foreach ($projects as $project) : ?>
                                    <option value="<?=$project['id']?>"><?=($project['name'])?></option>
                                        <?php endforeach;?>
                                    </select>
                                        <?=!empty($errors['selectProject']) ?
                                        '<span id="Name-error" class="error invalid-feedback">' .
                                        htmlspecialchars($errors['selectProject']) . '</span>'  : ''?>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-6">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Додаткові</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputDate">Дата виконання</label>
                                    <input type="date" id="inputDate"  name="inputDate" class="form-control
                                        <?=!empty($errors['inputDate']) ? ' is-invalid' : ''?>">
                                         <?=!empty($errors['inputDate']) ?
                                        '<span id="Name-error" class="error invalid-feedback">' .
                                        htmlspecialchars($errors['inputDate']) . '</span>' : ''?>
                                </div>
                                <div class="form-group">
                                    <label for="inputTaskFile">Прикріпити файл</label>
                                    <input type="file" id="inputTaskFile" class="form-control" name="inputTaskFile">
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <a href="#" class="btn btn-secondary">Відміна</a>
                        <input type="submit" value="Створити новий проект" class="btn btn-success" name="btn-add">
                    </div>
                </div>
            </form>
        </section>
    </div>

    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 0.1.0
        </div>
        <strong>Copyright &copy; 2023 <a href="https://ithillel.ua/">Комп'ютерна школа Hillel</a>.</strong> All rights
        reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="static/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="static/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap -->
<script src="static/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Ekko Lightbox -->
<script src="static/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<!-- overlayScrollbars -->
<script src="static/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="static/js/adminlte.min.js"></script>
<!-- Filterizr-->
<script src="static/plugins/filterizr/jquery.filterizr.min.js"></script>
<!-- Page specific script -->
<script src="static/js/kanban.js"></script>
</body>

</html>
