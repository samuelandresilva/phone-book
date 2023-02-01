<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= lang('General.siteTitle') ?></title>

    <!-- Import libraries -->
    <link rel="stylesheet" href="/libs/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/libs/datatables/css/datatables.min.css" />
    <link rel="stylesheet" href="/css/main.css" />

</head>

<body>
    <div class="loading">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <div class="main-content">
        <div class="container mt-3">
            <!-- Table -->
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row">
                                <h3 class="mb-0 col-9"><?= lang('General.siteTitle') ?></h3>
                                <div class="text-end col-3">
                                    <button class="btn btn-primary btn-sm btn-add-people"><?= lang('General.phonebook.addButton') ?></button>
                                    <a href="/signout" class="btn btn-danger btn-sm "><?= lang('General.phonebook.logoutButton') ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush datatable">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col"><?= lang('General.phonebook.columnName') ?></th>
                                        <th scope="col"><?= lang('General.phonebook.columnDesc') ?></th>
                                        <th scope="col"><?= lang('General.phonebook.columnPhones') ?></th>
                                        <th scope="col"><?= lang('General.phonebook.columnAction') ?></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
            <div class="col-xl-6 m-auto text-center">
                <div class="copyright">
                    <p style="font-size: 12px;">
                        <?= date('Y') . ' - ' . lang('General.copyright') ?><br>
                        Designed by <a href="http://samuelandresilva.github.io/">Samuel Silva</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Modal -->
    <div class="modal fade" id="modal-people" tabindex="-1" data-bs-backdrop="static" aria-labelledby="peopleLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="peopleLabel"><?= lang('General.modal.contact.title') ?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <div class="spinner-border spin-people d-none" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <div class="form-people">
                        <div class="form-group">
                            <label><?= lang('General.modal.contact.codeFiel') ?></label>
                            <input type="number" class="form-control" id="people_id" readonly style="width: 150px;cursor: not-allowed;">
                        </div>
                        <div class="form-group mt-3">
                            <label><?= lang('General.modal.contact.typeField') ?> <span class="text-danger">*</span></label>
                            <select class="form-select" aria-label="Default select" id="people_type" required>
                                <option value="0"><?= lang('General.modal.contact.typeLegal') ?></option>
                                <option value="1"><?= lang('General.modal.contact.typeNatural') ?></option>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label><?= lang('General.modal.contact.nameField') ?> <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="people_name" required>
                        </div>
                        <div class="form-group mt-3">
                            <label><?= lang('General.modal.contact.descrField') ?></label>
                            <input type="text" class="form-control" id="people_nickname">
                        </div>
                        <div class="form-group mt-3">
                            <label><?= lang('General.modal.contact.docField') ?></label>
                            <input type="text" class="form-control" id="people_inscnum">
                        </div>
                        <div class="form-group mt-3">
                            <label><?= lang('General.modal.contact.obsField') ?></label>
                            <textarea rows="4" class="form-control" id="people_obs" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><?= lang('General.modal.contact.cancelButton') ?></button>
                    <button type="button" class="btn btn-primary btn-sm btn-save-people"><?= lang('General.modal.contact.saveButton') ?></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="contacts" tabindex="-1" data-bs-backdrop="static" aria-labelledby="contactsLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="contactsLabel"><?= lang('General.modal.phone.title') ?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <div class="spinner-border spin" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <table class="table align-items-center table-flush d-none table-contacts">
                        <thead>
                            <th><?= lang('General.modal.phone.columnNumber') ?></th>
                            <th><?= lang('General.modal.phone.columnDescr') ?></th>
                            <th class="text-center"><?= lang('General.modal.phone.columnAction') ?></th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><?= lang('General.modal.phone.cancelButton') ?></button>
                    <button type="button" class="btn btn-primary btn-sm btn_add" data-id=""><?= lang('General.modal.phone.addButton') ?></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="add_contact" tabindex="-1" data-bs-backdrop="static" aria-labelledby="add_contactLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="add_contactLabel"><?= lang('General.modal.addphone.title') ?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <div class="spinner-border spin" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><?= lang('General.modal.addphone.numberField') ?></label>
                        <input type="tel" class="form-control" id="contact_number" required>
                    </div>
                    <div class="form-group mt-3">
                        <label><?= lang('General.modal.addphone.descrField') ?></label>
                        <input type="text" class="form-control" id="contact_descr" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><?= lang('General.modal.addphone.cancelButton') ?></button>
                    <button type="button" class="btn btn-primary btn-sm btn_save" data-id=""><?= lang('General.modal.addphone.saveButton') ?></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Import libraries -->
    <script src="/libs/jquery/js/jquery.min.js"></script>
    <script src="/libs/jquery/js/jquery.mask.js"></script>
    <script src="/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/libs/datatables/js/datatables.min.js"></script>
    <script src="/libs/sweetalert2/js/sweetalert2.min.js"></script>
    <script src="/js/main.js"></script>

</body>

</html>