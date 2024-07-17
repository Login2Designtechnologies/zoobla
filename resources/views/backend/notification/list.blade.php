@extends('backend.layouts.app')



@section('content')

  @if (session('status'))
    <h6 class="alert alert-success">{{ session('status') }}</h6>
  @endif

<div class="container">
 <div style="display:flex;justify-content: space-between;">
  <h2>All Notifications</h2>
  <p><a href="{{url('admin/add-notifications')}}" class="btn btn-danger">Add</a></p>  
  </div>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Subject</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @php
          $i = 1;
      @endphp
    	@foreach ($notifications as $value) 
	      <tr>
	        <td>{{$i;}}</td>
          <td>{{$value->name}}</td>
	        <td>{{$value->subject}}</td>
	        <td>
           @if($value->status == 1)
              Active
            @else
              Inactive
            @endif 
          </td>
          <td><a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{ url('admin/edit-notifications/'.$value->id) }}" title="Edit">
          <i class="las la-edit"></i></a>
         {{-- <a href="{{ url('admin/deletenotifications/'.$value->id) }}"  class="btn btn-soft-danger btn-icon btn-circle btn-sm"  onclick="return confirm('Are you sure you want to delete this item?');"><i class="las la-trash"></i></a>  --}}
         
        </td>
	      </tr>
            @php
              $i++;
          @endphp
      @endforeach
    </tbody>
  </table>
    {!! $notifications->render() !!}
</div>


@endsection


