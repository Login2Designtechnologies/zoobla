@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">

	<div class="row align-items-center">
        <div class="col-md-9">
            <h1 class="h3">{{translate('Sales Comparison Report')}}</h1> 
        </div>

        <div class="col-md-3 text-md-right">
            <div class="select-filter mb-2">
                <select name="filter" id="filter" class="form-control" onchange="showInput()">
                    <option value="">-- Filter Options --</option>
                    <option value="day">Days</option>
                    <option value="week">Weeks</option>
                    <option value="month">Months</option>
                    <option value="year">Years</option>
                </select>
            </div>

            <div id="dayInput" class="input-box" style="display:none;">
                <div class="form-row">
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="Start Day">
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="End Day">
                    </div>
                </div>
            </div>

            <div id="weekInput" class="input-box" style="display:none;">
                <div class="form-row">
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="Start Week">
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="End Week">
                    </div>
                </div>
            </div>

            <div id="monthInput" class="input-box" style="display:none;">
                <div class="form-row">
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="Start Month">
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="End Month">
                    </div>
                </div>
            </div>

            <div id="yearInput" class="input-box" style="display:none;">
                <div class="form-row">
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="Start Year">
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="End Year">
                    </div>
                </div>
            </div>
        </div>

	</div>

</div>



<div class="row">

    <div class="col-md-12">

        <div class="card">

            <!--card body-->

            <div class="card-body">

              

                <div class="table-responsive">
                    <table class="table table-bordered aiz-table mb-0">
                        <thead>
                            <tr>
                                <th>Info</th>
                                <th>Start Date<br>(03-04-2024)</th>
                                <th>End Date<br>(03-04-2024) </th>
                                <th>Day +/-</th>
                                <th>Start Week<br>(01-03-2024)</th>
                                <th>End Week<br>(07-03-2024) </th>
                                <th>Week +/-</th>
                                <th>Start Month<br>(01-03-2024)</th>
                                <th>End Month<br>(31-03-2024) </th>
                                <th>Month +/-</th>
                                <th>Start Year<br>(01-01-2023)</th>
                                <th>End Month<br>(31-12-2024) </th>
                                <th>Year +/-</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Sales Amount</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td>Sales %</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td>Average Sales</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td>Profit</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td>Loss</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

              

            </div>

        </div>

    </div>

</div>

<script>
      function showInput() {
    var selectBox = document.getElementById("filter");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;

    // Hide all input boxes
    var inputBoxes = document.getElementsByClassName("input-box");
    for (var i = 0; i < inputBoxes.length; i++) {
      inputBoxes[i].style.display = "none";
    }

    // Show the selected input box
    document.getElementById(selectedValue + "Input").style.display = "block";
  }
</script>

@endsection







