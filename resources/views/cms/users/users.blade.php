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
                                            role="grid" aria-describedby="example2_info">
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
                                        <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">
                                            Showing 1 to 10 of 57 entries</div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                            <ul class="pagination">
                                                <li class="paginate_button previous disabled" id="example2_previous"><a
                                                        href="#" aria-controls="example2" data-dt-idx="0"
                                                        tabindex="0">Previous</a></li>
                                                <li class="paginate_button active"><a href="#"
                                                        aria-controls="example2" data-dt-idx="1" tabindex="0">1</a>
                                                </li>
                                                <li class="paginate_button "><a href="#" aria-controls="example2"
                                                        data-dt-idx="2" tabindex="0">2</a></li>
                                                <li class="paginate_button "><a href="#" aria-controls="example2"
                                                        data-dt-idx="3" tabindex="0">3</a></li>
                                                <li class="paginate_button "><a href="#" aria-controls="example2"
                                                        data-dt-idx="4" tabindex="0">4</a></li>
                                                <li class="paginate_button "><a href="#" aria-controls="example2"
                                                        data-dt-idx="5" tabindex="0">5</a></li>
                                                <li class="paginate_button "><a href="#" aria-controls="example2"
                                                        data-dt-idx="6" tabindex="0">6</a></li>
                                                <li class="paginate_button next" id="example2_next"><a href="#"
                                                        aria-controls="example2" data-dt-idx="7" tabindex="0">Next</a>
                                                </li>
                                            </ul>
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
        $(document).ready(function() {
            function fetchUserData() {
                $.get('/api/cms/users', function(response) {
                    if (response.data && response.data.data) {
                        const users = response.data.data;
                        let tableBody = $('#users-table tbody');
                        tableBody.empty(); 

                        users.forEach((user, index) => {
                            tableBody.append(`
                        <tr>
                            <td>${index + 1}</td>
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

                        $('#example2_info').text(
                            `Showing ${response.data.from} to ${response.data.to} of ${response.data.total} entries`
                        );

                        let pagination = $('#example2_paginate .pagination');
                        pagination.empty();
                        for (let i = 1; i <= response.data.last_page; i++) {
                            pagination.append(`
                        <li class="paginate_button ${response.data.current_page === i ? 'active' : ''}">
                            <a href="#" data-page="${i}" tabindex="0">${i}</a>
                        </li>
                    `);
                        }
                    } else {
                        console.error('No data found in the response.');
                    }
                }).fail(function(error) {
                    console.error('Error fetching data:', error);
                });
            }

            fetchUserData();

            $(document).on('click', '#example2_paginate .pagination a', function(e) {
                e.preventDefault();
                const page = $(this).data('page');

                if (page) {
                    $.get(`/api/cms/users/data?page=${page}`, function(response) {
                        fetchUserData(response);
                    });
                }
            });

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
