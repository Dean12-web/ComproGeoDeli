@extends('admin-layouts.master')

@section('title', 'CMS Edit info')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Ubah Informasi Perusahaan
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                <li class="active"><i class="fa fa-uaser"></i> Ubah Informasi Perusahaan</li>
            </ol>
        </section>
        <section class="content">
            <div class="box box-success">
                <!-- /.box-header -->
                <form enctype="multipart/form-data" action="{{ route('cms.update-info', $companyInfo->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="box-body">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Nama Perusahaan</label>
                            <input type="text" id="company_name" name="company_name" class="form-control"
                                placeholder="Enter ..." value="{{ $companyInfo->company_name }}">
                        </div>
                        <div class="form-group">
                            <label>Deskripsi Perusahaan</label>
                            <textarea class="form-control" name="company_description" id="company_description" rows="3"
                                placeholder="Enter ...">{{ $companyInfo->company_description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Visi Perusahaan</label>
                            <textarea class="form-control" name="company_vision" id="company_vision" rows="3" placeholder="Enter ...">{{ $companyInfo->company_vision }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Misi Perusahaan</label>
                            <textarea class="form-control" name="company_mission" id="company_mission" rows="3" placeholder="Enter ...">{{ $companyInfo->company_mission }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Logo Perushaan</label>
                            <input type="file" id="company_logo" name="company_logo" class="form-control" style="margin-bottom: 12px"
                                onchange="previewImage()">
                            @if ($companyInfo->company_logo)
                                <img src="{{ asset('storage/images/' . $companyInfo->company_logo) }}"
                                    class="img-preview img-fluid mb-3" width="30%">
                            @endif
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right" style="margin-right: 5px">Ubah
                            Data</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
    <script>
        function previewImage() {
            const image = document.querySelector("#company_logo");
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
