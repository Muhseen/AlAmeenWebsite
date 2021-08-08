extends(layouts.soft)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-3">
                <a href="{{route('Students.create')}}">
                    <div class="card">
                        <div class="h6 card-title card-header">
                            Add Student to Scholarship List
                        </div>
                        <div class="card-body" height=500>
                            <div class="card-image col-">
                                <img src="{{asset('assets/img/student.png')}}" alt="student Icon"
                                    class="card-image h-25 w-100">
                            </div>
                        </div>
                      </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-3">
                <a  href="/viewScholarshipList"><div class="card">
                    <div class="h6 card-title card-header">
                        View Scholarship Students
                    </div>
                    <div class="card-body" height=500>
                        <div class="card-image col-">
                            <img src="{{asset('assets/img/student.png')}}" alt="student Icon" class="card-image h-50 w-100">
                        </div>
                    </div>

                </div>
            </a>
            </div>
           </div>
    
    </div>
@endsection