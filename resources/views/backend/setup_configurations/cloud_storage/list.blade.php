@extends('backend.layouts.app')



@section('content')



<div class="aiz-titlebar text-left mt-2 mb-3">

    <div class="row align-items-center">

        <div class="col-md-6">

            <h1 class="h3">{{translate('Cloud Storage')}}</h1>

        </div>

        <div class="col-md-6 text-md-right">

            <a href="{{route('tax.cloud_create')}}" class="btn btn-circle btn-info">

                <span>{{translate('Add Cloud Storage')}}</span>

            </a>

        </div>

    </div>

</div>



<div class="card">

    <div class="card-header row gutters-5">

        <div class="col text-center text-md-left">

            <h5 class="mb-md-0 h6">{{ translate('All Cloud Storage') }}</h5>

        </div>

    </div>

    <div class="card-body">

        <table class="table aiz-table mb-0">

            <thead>

                <tr>

                    <th>#</th>

                    <th>{{translate('Days')}}</th>

                    <th>{{translate('Amount')}}</th>

                    <th>{{translate('status')}}</th>

                    <th class="text-right">{{translate('Options')}}</th>

                </tr>

            </thead>

            <tbody>

                @foreach($cloud_list as $key => $list)

                <tr>

                    <td>{{ $key+1 }}</td>

                    <td>{{ $list->days }}</td>

                    <td>{{ $list->amount }}</td>

                    <td>@if($list->status == 1) Active @else In Active @endif</td>

                    <td class="text-right">

                        <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('tax.cloud_edit', $list->id )}}" title="{{ translate('Edit') }}">

                            <i class="las la-edit"></i>

                        </a>

                        <a href="{{route('tax.cloud_delete', $list->id)}}" class="btn btn-soft-danger btn-icon btn-circle btn-sm " onclick="return confirm('Are You Sure to delete?')" title="{{ translate('Delete') }}">

                            <i class="las la-trash"></i>

                        </a>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

        

    </div>

</div>



@endsection

