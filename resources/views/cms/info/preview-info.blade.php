@extends('admin-layouts.master')

@section('title', 'CMS Detail Info')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Detail Informasi Perusahaan
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                <li class="active">Detail Informasi Perusahaan</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-xs-12">
                                    <a href="{{ route('cms.info') }}" class="btn btn-success btn-flat btn-social">
                                        <i class="fa fa-arrow-left"></i> Kembali
                                    </a>
                                    <a href="{{ route('cms.edit-info', $companyInfo->id) }}" class="btn btn-warning btn-flat btn-social">
                                        <i class="fa fa-pencil-square-o"></i> Ubah Informasi
                                    </a>
                                    <form action="{{ route('cms.delete-info', $companyInfo->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-flat btn-social" onclick="return confirm('Apakah Anda yakin ingin menghapus informasi ini?')">
                                            <i class="fa fa-trash"></i> Hapus Informasi
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="box-body">
                            @if ($companyInfo->company_logo)
                                <div class="text-center my-4">
                                    <img src="{{ asset('storage/images/' . $companyInfo->company_logo) }}"
                                        class="img-fluid img-thumbnail shadow-sm" alt="Company Logo" style="max-width: 30%;">
                                </div>
                            @endif
                            <h1 class="text-center">{{ $companyInfo->company_name }}</h1>
                            <p class="text-secondary text-justify">{{ $companyInfo->company_description }}</p>
                            <div class="mt-4">
                                <h2>Visi Perusahaan</h2>
                                <p class="text-dark">{{ $companyInfo->company_vision }}</p>
                            </div>
                            <div class="mt-4">
                                <h2>Misi Perusahaan</h2>
                                <p class="text-dark">{{ $companyInfo->company_mission }}</p>
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
@stop
