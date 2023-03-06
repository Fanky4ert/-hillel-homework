<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Додати завдання</h1>
                </div>
                <div class="col-sm-6 d-none d-sm-block">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Додати завдання</li>
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
                                <input type="text" id="inputName" name="inputName" required class="form-control<?=!empty($errors['inputName']) ? ' is-invalid' : ''?>">
                                <?php if (!empty($errors['inputName'])) : ?>
                                    <span id="Name-error" class="error invalid-feedback"><?= htmlspecialchars($errors['inputName']) ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Опис задачі</label>
                                <textarea id="inputDescription" name="inputDescription" class="form-control<?=!empty($errors['inputDescription']) ? ' is-invalid' : ''?>" rows="4"></textarea>
                                <?php if (!empty($errors['inputDescription'])) : ?>
                                    <span id="Description-error" class="error invalid-feedback"><?= htmlspecialchars($errors['inputDescription']) ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="selectProject">Оберіть проект</label>
                                <select required id="selectProject" name="selectProject" class="form-control<?=!empty($errors['selectProject']) ? ' is-invalid' : ''?>">
                                    <option></option>
                                    <?php foreach ($projects as $project) : ?>
                                        <option value="<?= $project['id'] ?>"><?= $project['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (!empty($errors['selectProject'])) : ?>
                                    <span id="Project-error" class="error invalid-feedback"><?= htmlspecialchars($errors['selectProject']) ?></span>
                                <?php endif; ?>
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
                                <input type="date" id="inputDate" name="inputDate" class="form-control<?= !empty($errors['inputDate']) ? ' is-invalid' : '' ?>">
                                <?= !empty($errors['inputDate']) ?
                                    '<span id="inputDateEr" class="error invalid-feedback">' .
                                    htmlspecialchars($errors['inputDate']) . '</span>'
                                    : ''?>
                            </div>
                            <div class="form-group">
                                <label for="inputTaskFile">Прикріпити файл</label>
                                <input type="file" id="inputTaskFile" class="form-control">
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

