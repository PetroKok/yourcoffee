@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-4 text-gray-800">{{trans('admin.menu.categories')}}</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-download fa-sm text-white-50"></i>
                {{trans('admin.actions.add_new')}}
            </a>
        </div>

        <table>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Centro comercial Moctezuma</td>
                <td>
                    <a href="#" class="btn btn-info btn-circle btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" class="btn btn-danger btn-circle btn-sm">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            <tr>
                <td>1</td>
                <td>Centro comercial Moctezuma</td>
                <td>
                    <a href="#" class="btn btn-info btn-circle btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" class="btn btn-danger btn-circle btn-sm">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            <tr>
                <td>1</td>
                <td>Centro comercial Moctezuma</td>
                <td>
                    <a href="#" class="btn btn-info btn-circle btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" class="btn btn-danger btn-circle btn-sm">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            <tr>
                <td>1</td>
                <td>Centro comercial Moctezuma</td>
                <td>
                    <a href="#" class="btn btn-info btn-circle btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" class="btn btn-danger btn-circle btn-sm">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>

        </table>


    </div>
@endsection
