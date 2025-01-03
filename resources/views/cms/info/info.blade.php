@extends('admin-layouts.master')

@section('title', 'CMS Info')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Informasi Perusahaan
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                <li class="active">Informasi Perusahaan</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-xs-6">
                                    @if ($companyInfos->isEmpty())
                                        <a href="{{ route('cms.add-info') }}" class="btn btn-success btn-flat btn-social">
                                            <i class="fa fa-plus"></i> Tambah Info
                                        </a>
                                    @endif
                                </div>
                                <div class="col-xs-6">
                                    @if (!$companyInfos->isEmpty())
                                        <a href="{{ route('cms.edit-info', $companyInfos->first()->id )}}" style="float: right"
                                            class="btn btn-primary btn-flat btn-social">
                                            <i class="fa fa-plus"></i> Ubah Info
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if (session('success'))
                            <div class="callout callout-success">
                                <p> {{ session('success') }}</p>
                            </div>
                        @endif
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Perusahaan</th>
                                        <th>Deskripsi</th>
                                        <th>Visi Perusahaan</th>
                                        <th>Misi Perusahaan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($companyInfos as $companyInfo)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $companyInfo->company_name }}</td>
                                            <td>{{ Str::limit($companyInfo->company_description, 50, '...') }}</td>
                                            <td>{{ Str::limit($companyInfo->company_vision, 50, '...') }}</td>
                                            <td>{{ Str::limit($companyInfo->company_mission, 50, '...') }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('cms.preview-info', $companyInfo->id) }}"
                                                    class="btn btn-info btn-center btn-flat btn-social">
                                                    <i class="fa fa-eye"></i> Preview
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="6">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
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
