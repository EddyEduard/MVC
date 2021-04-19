<section class="my-5">

    <div class="text-center">
        <h2 class="h1-responsive font-weight-bold my-5">What can this template to do?</h2>
        <p class="dark-grey-text w-responsive mx-auto mb-5">Let's talk about the Web APIs.Four methods (GET, POST, PUT and DELETE) for request a Web API
            are implemented below.These methods allow you to access data form a database and manipulate them.Try it!</p>
    </div>

    <div class="modal fade" id="form" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle"></h5>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3" id="viewUsers">
                            <ul class="list-group" id="usersList"></ul>
                        </div>
                        <div class="mb-3" id="viewSelectUsers">
                            <label for="users" class="col-form-label">User:</label>
                            <select id="users" class="bs-select"></select>
                        </div>
                        <div id="viewInputsForm">
                            <div class="mb-3">
                                <label for="username" class="col-form-label">Username:</label>
                                <input type="text" class="form-control" id="username">
                                <small id="errorUsername" class="text-danger"></small>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="col-form-label">Email:</label>
                                <input type="text" class="form-control" id="email">
                                <small id="errorEmail" class="text-danger"></small>
                            </div>
                            <div class="mb-3">
                                <label for="age" class="col-form-label">Age:</label>
                                <input type="number" class="form-control" id="age" min="0" max="99">
                                <small id="errorAge" class="text-danger"></small>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <small id="successMessage" class="text-success"></small>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="send" class="btn btn-primary">Send</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md">
            <ul class="list-group">
                <li class="list-group-item">
                    <button type="button" id="getMethod" class="btn btn-primary btn-sm" style="width: 90px"
                            data-toggle="modal"
                            data-target="#form">GET
                    </button>
                    <span class="text-center font-weight-bold">/MVC/API/Get</span>
                </li>
                <li class="list-group-item">
                    <button type="button" id="selectPostMethod" class="btn btn-success btn-sm" style="width: 90px"
                            data-toggle="modal"
                            data-target="#form">POST
                    </button>
                    <span class="text-center font-weight-bold">/MVC/API/Post</span>
                </li>
                <li class="list-group-item">
                    <button type="button" id="selectPutMethod" class="btn btn-warning btn-sm" style="width: 90px"
                            data-toggle="modal"
                            data-target="#form">PUT
                    </button>
                    <span class="text-center font-weight-bold">/MVC/API/Put/{id}</span>
                </li>
                <li class="list-group-item">
                    <button type="button" id="selectDeleteMethod" class="btn btn-danger btn-sm" style="width: 90px"
                            data-toggle="modal"
                            data-target="#form">DELETE
                    </button>
                    <span class="text-center font-weight-bold">/MVC/API/Delete/{id}</span>
                </li>
            </ul>
        </div>
    </div>

</section>
