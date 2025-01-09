@extends('admin-layouts.master')

@section('title', 'CMS Edit Testimony')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Edit Testimony
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                <li class="active"><i class="fa fa-uaser"></i> Edit Testimony</li>
            </ol>
        </section>
        <section class="content">
            <div class="box box-success">
                <!-- /.box-header -->
                <form enctype="multipart/form-data" action="{{ route('cms.update-testimony', $testimony->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <!-- text input -->
                        <div class="form-group">
                            @if ($testimony->client_photo)
                                <img src="{{ asset('storage/images/' . $testimony->client_photo) }}"
                                    class="img-thumbnail img-fluid mb-3" width="15%">
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" id="client_name" name="client_name" class="form-control"
                                placeholder="Enter ..." value="{{ $testimony->client_name }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" id="client_email" name="client_email" class="form-control"
                                placeholder="Enter ..." value="{{ $testimony->client_email }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Testimonial</label>
                            <textarea class="form-control" name="testimonial" id="testimonial" rows="3" placeholder="Enter ..." disabled>{{ $testimony->testimonial }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Boleh ditampilkan</label>
                            <select class="form-control" id="is_approved" name="is_approved">
                                <option value="0" {{ !$testimony->is_approved ? 'selected' : '' }}>Tidak ditampilkan</option>
                                <option value="1" {{ $testimony->is_approved ? 'selected' : '' }}>Tampilkan</option>
                            </select>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right" style="margin-right: 5px">Setujui</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
    <script>
        function previewImage() {
            const image = document.querySelector("#image");
            const imgPreview = document.querySelector(".img-preview");

            imgPreview.style.display = "block";

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@stop
