@extends('backend.layouts.app')



@section('content')

    <div class="aiz-titlebar text-left mt-2 mb-3">

        <div class="align-items-center">

            <h1 class="h3">{{ translate('Notifications') }}</h1>

        </div>

    </div>

    <div class="row">

        <div class="col-md-8 mx-auto">

            <div class="card">

                <form action="{{ url('admin/update-notifications/'.$notifications->id) }}" class="" id="sort_customers" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-header row gutters-5">

                        <div class="col">

                            <h5 class="mb-0 h6">{{ translate('Notifications') }}</h5>

                        </div>

                    </div>

                    <div class="card-body">

                        <div class="form-group mb-3">
                            <label for="">Name</label>
                            <input type="text" name="name" value="{{$notifications->name}}" class="form-control" required>
                        </div>
                         <div class="form-group mb-3">
                            <label for="">Subject</label>
                            <input type="text" name="subject" value="{{$notifications->subject}}" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Content</label>


                    <textarea

                        class="aiz-text-editor form-control"

                        placeholder="{{translate('Content..')}}"

                        data-buttons='[["font", ["bold", "underline", "italic", "clear"]],["para", ["ul", "ol", "paragraph"]],["style", ["style"]],["color", ["color"]],["table", ["table"]],["insert", ["link", "picture", "video"]],["view", ["fullscreen", "codeview", "undo", "redo"]]]'

                        data-min-height="300"

                        name="contant"

                        required  > {{$notifications->contant}} </textarea>

                        </div>

                        <div class="form-group mb-3">
                            <label for="">Status</label>
                           <select class="form-control" name="status">
                                <option value="1" {{ $notifications->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $notifications->status == 0 ? 'selected' : '' }}>Inactive</option>
                          </select>
                        </div>

                    </div>
                  <button type="submit" class="btn btn-danger">Submit</button>
                </form>

            </div>

        </div>

    </div>

@endsection

