@extends('admin-layouts.master')

@section('title', 'CMS Tambah Info')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Edit Kontak Perusahaan
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                <li class="active"><i class="fa fa-uaser"></i> Edit Kontak Perusahaan</li>
            </ol>
        </section>
        <section class="content">
            <div class="box box-success">
                <!-- /.box-header -->
                <form enctype="multipart/form-data" action="{{ route('cms.update-contact', $contacts->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="box-body">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Email Perusahaan</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="Enter ..." value="{{ $contacts->email }}">
                        </div>
                        <div class="form-group">
                            <label>Nomor Telepon Perusahaan</label>
                            <input type="text" id="phone_number" name="phone_number" class="form-control"
                                placeholder="Enter ..." value="{{ $contacts->phone_number }}">
                        </div>
                        <div class="form-group">
                            <label>Instagram</label>
                            <input type="text" id="instagram" name="instagram" class="form-control"
                                placeholder="Enter ..." value="{{ $contacts->instagram }}">
                        </div>
                        <div class="form-group">
                            <label>Facebook Perusahaan</label>
                            <input type="text" id="facebook" name="facebook" class="form-control"
                                placeholder="Enter ..." value="{{ $contacts->facebook }}">
                        </div>
                        <div class="form-group">
                            <label>Twitter Perusahaan</label>
                            <input type="text" id="twitter" name="twitter" class="form-control"
                                placeholder="Enter ..." value="{{ $contacts->twitter }}">
                        </div>
                        <div class="form-group">
                            <label>Whatsapp Perusahaan</label>
                            <input type="text" id="whatsapp" name="whatsapp" class="form-control"
                                placeholder="Enter ..." value="{{ $contacts->whatsapp }}">
                        </div>
                        <div class="form-group">
                            <label>Alamat Perusahaan</label>
                            <textarea class="form-control" name="address" id="address" rows="3" placeholder="Enter ...">{{ $contacts->address }}</textarea>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right" style="margin-right: 5px">Simpan
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
