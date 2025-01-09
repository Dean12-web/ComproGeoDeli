@extends('admin-layouts.master')

@section('title', 'CMS Testimony')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Testimony
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                <li class="active"><i class="fa fa-paw"></i> Testimony</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <a href="{{ route('cms.add-testimony') }}" class="btn btn-success btn-flat btn-social">
                                <i class="fa fa-plus"></i> Tambah Testimoni
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
                                        <table id="testimonies-table" class="table table-bordered table-hover dataTable"
                                            role="grid" aria-describedby="testimonies_info">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting_asc" tabindex="0" rowspan="1" colspan="1">
                                                        ID</th>
                                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">
                                                        Email client</th>
                                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">
                                                        Nama client</th>
                                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">
                                                        Testimony</th>
                                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">
                                                        Status</th>
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
                                        <div class="dataTables_info" id="testimony_info" role="status" aria-live="polite">
                                            Showing 1 to 10 of 57 entries
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="dataTables_paginate paging_simple_numbers" id="testimonies_paginate">
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
        $(document).ready(function() {
            function fetchUserData(page = 1) {
                $.get(`/api/show-testimony?page=${page}`, function(resp) {
                    if (resp.data && resp.data.data) {
                        const testimonies = resp.data.data;
                        let tableBody = $("#testimonies-table tbody");
                        tableBody.empty();

                        if (testimonies.length === 0) {
                            tableBody.append(`
                                <tr>
                                    <td colspan="4" class="text-center">No Data Found</td>
                                </tr>
                            `);
                        } else {
                            testimonies.forEach((testimony, index) => {
                                tableBody.append(`
                                    <tr>
                                        <td>${index + 1}</td>
                                        <td>${testimony.client_email}</td>
                                        <td>${testimony.client_name}</td>
                                        <td>${testimony.testimonial}</td>
                                        <td>${testimony.is_approved ? 'Tampilkan' : 'Tidak ditampilkan' }</td>
                                        <td>
                                            <button class="btn btn-sm btn-social btn-info edit-testimony" data-id="${testimony.id}">
                                                <i class="fa fa-pencil"></i> Edit
                                            </button>
                                            <button class="btn btn-sm btn-social btn-danger delete-testimony" data-id="${testimony.id}">
                                                <i class="fa fa-trash"></i> Hapus
                                            </button>
                                        </td>
                                    </tr>
                                `);
                            });
                        }
                        $("#testimonies_info").text(
                            `Showing ${resp.data.from} to ${resp.data.to} of ${resp.data.total} entries`
                        );

                        let pagination = $("#testimonies_paginate .pagination");
                        pagination.empty();

                        pagination.append(`
                            <li class="paginate_button previous ${resp.data.current_page === 1 ? "disabled" : ""}">
                                <a href="#" data-page="${resp.data.current_page - 1}" tabIndex="0">Prev</a>
                            </li>
                        `);

                        for (let i = 1; i <= resp.data.last_page; i++) {
                            pagination.append(`
                                <li class="paginate_button ${resp.data.current_page === i ? "active" : ""}">
                                    <a href="#" data-page="${i}">${i}</a>
                                </li>
                            `);
                        }

                        pagination.append(`
                            <li class="paginate_button next ${resp.data.current_page === resp.data.last_page ? "disabled" : ""}">
                                <a href="#" data-page="${resp.data.current_page + 1}">Next</a>
                            </li>
                        `)
                    } else {
                        console.error("No data found in the response");
                    }
                }).fail(function(error) {
                    console.error("Error fetching data", error);
                    alert("Failed to fetch data. Please try again.");
                });
            }

            fetchUserData();

            $(document).on("click", ".edit-testimony", function() {
                const testimonyId = $(this).data('id');
                window.location.href = `/cms/testimony/preview-testimony/${testimonyId}`;
            })
            $(document).on("click", "#testimonies_paginate .pagination a", function(e) {
                e.preventDefault();
                const page = $(this).data('page');
                if (page) {
                    fetchUserData(page);
                }
            });

            $(document).on("click", ".delete-service", function() {
                const serviceId = $(this).data("id");
                if (confirm("Apa kamu yakin ingin menghapus layanan ini?")) {
                    $.ajax({
                        url: `/api/cms/testimonies/delete-service`,
                        type: 'DELETE',
                        data: {
                            id: serviceId
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content'
                            )
                        },
                        success: function(resp) {
                            alert(resp.success);
                            fetchUserData()
                        },
                        error: function(err) {
                            alert("Error " + (err.responseJSON?.error) ||
                                "An unknown error occured.");
                        }
                    });
                }
            });
        });
    </script>
@stop
