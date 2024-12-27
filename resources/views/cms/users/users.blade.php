@extends('admin-layouts.master')

@section('title', 'CMS Users')

@section('content')
    <div class="content-wrapper" style="min-height: 1136.28px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Users
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                <li class="active"><a href="#"><i class="fa fa-users"></i> Users</a></li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <a href="{{ route('cms.add-user') }}" class="btn btn-success btn-flat btn-social">
                                <i class="fa fa-plus"></i> Tambah User
                            </a>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="users-table" class="table table-bordered table-hover dataTable"
                                            role="grid" aria-describedby="users_info">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting_asc" tabindex="0" rowspan="1" colspan="1">
                                                        ID</th>
                                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">
                                                        Username</th>
                                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">
                                                        Role user</th>
                                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">
                                                        Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-7">
                                        <div class="dataTables_info" id="users_info" role="status" aria-live="polite">
                                            Showing 1 to 10 of 57 entries</div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="dataTables_paginate paging_simple_numbers" id="users_paginate">
                                            <ul class="pagination"></ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
    </div>
    <script>
        $(document).ready(function () {
            // Fetch and display user data
            function fetchUserData(page = 1) {
                $.get(`/api/cms/users?page=${page}`, function (response) {
                    if (response.data && response.data.data) {
                        const users = response.data.data;
                        const tableBody = $("#users-table tbody");
                        tableBody.empty();
    
                        // Populate table rows
                        users.forEach((user, index) => {
                            tableBody.append(`
                                <tr>
                                    <td>${response.data.from + index}</td>
                                    <td>${user.username}</td>
                                    <td>${user.role_user}</td>
                                    <td>
                                        <button class="btn btn-sm btn-social btn-danger delete-user" data-id="${user.id}">
                                            <i class="fa fa-trash"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                            `);
                        });
    
                        $("#users_info").text(
                            `Showing ${response.data.from} to ${response.data.to} of ${response.data.total} entries`
                        );
    
                        const pagination = $("#users_paginate .pagination");
                        pagination.empty();
    
                        pagination.append(`
                            <li class="paginate_button previous ${response.data.current_page === 1 ? "disabled" : ""}">
                                <a href="#" data-page="${response.data.current_page - 1}" tabindex="0">Prev</a>
                            </li>
                        `);
    
                        for (let i = 1; i <= response.data.last_page; i++) {
                            pagination.append(`
                                <li class="paginate_button ${response.data.current_page === i ? "active" : ""}">
                                    <a href="#" data-page="${i}" tabindex="0">${i}</a>
                                </li>
                            `);
                        }

                        pagination.append(`
                            <li class="paginate_button next ${response.data.current_page === response.data.last_page ? "disabled" : ""}">
                                <a href="#" data-page="${response.data.current_page + 1}" tabindex="0">Next</a>
                            </li>
                        `);
                    } else {
                        console.error("No data found in the response.");
                    }
                }).fail(function (error) {
                    console.error("Error fetching data:", error);
                    alert("Failed to load data. Please try again.");
                });
            }
    
            // Initialize user data
            fetchUserData();
    
            // Handle pagination clicks
            $(document).on("click", "#users_paginate .pagination a", function (e) {
                e.preventDefault();
                const page = $(this).data("page");
                if (page && !$(this).parent().hasClass("disabled")) {
                    fetchUserData(page);
                }
            });
    
            // Handle user deletion
            $(document).on('click', '.delete-user', function() {
                const userId = $(this).data('id');
                if (confirm('Are you sure you want to delete this user?')) {
                    $.ajax({
                        url: '/api/cms/users/delete-user',
                        type: 'DELETE',
                        data: {
                            id: userId
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content')
                        },
                        success: function(response) {
                            alert(response.success);
                            fetchUserData();
                        },
                        error: function(error) {
                            alert('Error: ' + (error.responseJSON?.error ||
                                'An unknown error occurred.'));
                        }
                    });
                }
            });
        });
    </script>
    
    

@endsection
